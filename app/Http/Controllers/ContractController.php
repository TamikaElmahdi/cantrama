<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContractDownloadRequest;
use App\Http\Requests\ContractPreviewRequest;
use App\Http\Resources\ContractResource;
use App\Models\Contract;
use App\Models\Template;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContractController extends Controller
{
    public function preview(ContractPreviewRequest $request): JsonResponse
    {
        $template = Template::findOrFail($request->template_id);

        $user = $request->user();
        $watermark = !$user || $user->plan === 'free';

        $pdf = Pdf::loadView($template->pdf_blade_path, [
            'data' => $request->data,
            'watermark' => $watermark,
            'template' => $template,
        ])->setPaper('a4');

        $base64 = base64_encode($pdf->output());

        return response()->json(['pdf' => $base64]);
    }

    public function download(ContractDownloadRequest $request): Response|JsonResponse
    {
        $template = Template::findOrFail($request->template_id);
        $user = $request->user();

        $watermark = false;
        $paymentStatus = 'paid';

        if ($user->hasActiveSubscription()) {
            $paymentStatus = 'subscription';
        } else {
            $user->decrement('credits');
        }

        $pdf = Pdf::loadView($template->pdf_blade_path, [
            'data' => $request->data,
            'watermark' => $watermark,
            'template' => $template,
        ])->setPaper('a4');

        $filename = Str::slug($template->name_fr) . '-' . now()->format('Ymd-His') . '.pdf';
        $path = 'contracts/' . $filename;

        Storage::disk('local')->put($path, $pdf->output());

        $contract = Contract::create([
            'user_id' => $user->id,
            'template_id' => $template->id,
            'filled_data' => $request->data,
            'pdf_path' => $path,
            'payment_status' => $paymentStatus,
        ]);

        return response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function history(Request $request): JsonResponse
    {
        $contracts = $request->user()
            ->contracts()
            ->with('template')
            ->latest()
            ->get();

        return response()->json(ContractResource::collection($contracts));
    }
}
