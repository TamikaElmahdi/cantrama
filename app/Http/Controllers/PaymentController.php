<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentInitiateRequest;
use App\Models\Contract;
use App\Models\Payment;
use App\Models\Template;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function initiate(PaymentInitiateRequest $request): JsonResponse
    {
        $template = Template::findOrFail($request->template_id);
        $user = $request->user();

        $amount = $request->plan === 'pro' ? 99.00 : 9.00;

        $contract = Contract::create([
            'user_id' => $user?->id,
            'template_id' => $template->id,
            'filled_data' => $request->data,
            'pdf_path' => null,
            'payment_status' => 'free',
        ]);

        $payment = Payment::create([
            'user_id' => $user?->id,
            'contract_id' => $contract->id,
            'amount' => $amount,
            'provider' => 'mock',
            'transaction_id' => null,
            'status' => 'pending',
        ]);

        $callbackUrl = route('payment.callback', [
            'payment_id' => $payment->id,
            'simulate' => 'paid',
        ]);

        return response()->json([
            'payment_id' => $payment->id,
            'amount' => $amount,
            'currency' => 'MAD',
            'mock_payment_url' => $callbackUrl,
            'message' => 'Simulation de paiement — cliquez sur mock_payment_url pour simuler un paiement réussi.',
        ]);
    }

    public function callback(Request $request): JsonResponse
    {
        $payment = Payment::with(['contract.template'])->findOrFail($request->payment_id);

        if ($request->simulate !== 'paid') {
            $payment->update(['status' => 'failed']);
            return response()->json(['message' => 'Paiement annulé.'], 400);
        }

        $payment->update([
            'status' => 'completed',
            'transaction_id' => 'MOCK-' . strtoupper(Str::random(10)),
        ]);

        $contract = $payment->contract;
        $template = $contract->template;

        $pdf = Pdf::loadView($template->pdf_blade_path, [
            'data' => $contract->filled_data,
            'watermark' => false,
            'template' => $template,
        ])->setPaper('a4');

        $filename = Str::slug($template->name_fr) . '-' . now()->format('Ymd-His') . '.pdf';
        $path = 'contracts/' . $filename;

        Storage::disk('local')->put($path, $pdf->output());

        $contract->update([
            'pdf_path' => $path,
            'payment_status' => 'paid',
        ]);

        if ($payment->user_id) {
            $payment->user->update(['plan' => 'pro']);
        }

        return response()->json([
            'message' => 'Paiement validé. PDF généré.',
            'contract_id' => $contract->id,
            'download_url' => route('contracts.download-by-id', $contract->id),
        ]);
    }

    public function downloadById(Request $request, int $id): \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
    {
        $contract = Contract::findOrFail($id);

        if (!$contract->pdf_path || !Storage::disk('local')->exists($contract->pdf_path)) {
            return response()->json(['message' => 'PDF non disponible.'], 404);
        }

        if ($contract->user_id && $contract->user_id !== $request->user()?->id) {
            return response()->json(['message' => 'Accès refusé.'], 403);
        }

        $pdf = Storage::disk('local')->get($contract->pdf_path);
        $filename = basename($contract->pdf_path);

        return response($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
