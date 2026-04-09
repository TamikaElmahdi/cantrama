<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Template;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    public function dashboard(): Response
    {
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'users' => User::count(),
                'templates' => Template::count(),
                'contracts' => Contract::count(),
                'paid_contracts' => Contract::where('payment_status', '!=', 'free')->count(),
                'revenue_mad' => Contract::where('payment_status', 'paid')->count() * 9,
                'pro_users' => User::whereIn('plan', ['pro', 'agency'])->count(),
            ],
            'recent_contracts' => Contract::with(['user', 'template'])
                ->latest()
                ->take(8)
                ->get()
                ->map(fn($c) => [
                    'id' => $c->id,
                    'user_name' => $c->user?->name ?? 'Invité',
                    'template_name' => $c->template->name_fr,
                    'payment_status' => $c->payment_status,
                    'created_at' => $c->created_at->toISOString(),
                ]),
        ]);
    }

    // ─── Templates ───────────────────────────────────────────────

    public function templates(): Response
    {
        return Inertia::render('Admin/Templates', [
            'templates' => Template::orderBy('category')->orderBy('name_fr')->get(),
        ]);
    }

    public function templateCreate(): Response
    {
        return Inertia::render('Admin/TemplateForm', ['template' => null]);
    }

    public function templateStore(\Illuminate\Http\Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'name_fr' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:100', 'unique:templates,slug'],
            'category' => ['required', 'string', 'max:50'],
            'description_fr' => ['nullable', 'string'],
            'pdf_blade_path' => ['required', 'string', 'max:100'],
            'is_active' => ['boolean'],
            'fields' => ['required', 'json'],
        ]);

        $data['fields'] = json_decode($data['fields'], true);
        Template::create($data);

        return redirect()->route('admin.templates')->with('success', 'Modèle créé.');
    }

    public function templateEdit(Template $template): Response
    {
        return Inertia::render('Admin/TemplateForm', ['template' => $template]);
    }

    public function templateUpdate(\Illuminate\Http\Request $request, Template $template): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'name_fr' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:100', 'unique:templates,slug,' . $template->id],
            'category' => ['required', 'string', 'max:50'],
            'description_fr' => ['nullable', 'string'],
            'pdf_blade_path' => ['required', 'string', 'max:100'],
            'is_active' => ['boolean'],
            'fields' => ['required', 'json'],
        ]);

        $data['fields'] = json_decode($data['fields'], true);
        $template->update($data);

        return redirect()->route('admin.templates')->with('success', 'Modèle mis à jour.');
    }

    public function templateToggle(Template $template): \Illuminate\Http\JsonResponse
    {
        $template->update(['is_active' => !$template->is_active]);
        return response()->json(['is_active' => $template->is_active]);
    }

    // ─── Contracts ────────────────────────────────────────────────

    public function contracts(): Response
    {
        $contracts = Contract::with(['user', 'template'])
            ->latest()
            ->paginate(20)
            ->through(fn($c) => [
                'id' => $c->id,
                'user_name' => $c->user?->name ?? 'Invité',
                'user_email' => $c->user?->email ?? '—',
                'template_name' => $c->template->name_fr,
                'payment_status' => $c->payment_status,
                'has_pdf' => !is_null($c->pdf_path),
                'created_at' => $c->created_at->toISOString(),
            ]);

        return Inertia::render('Admin/Contracts', ['contracts' => $contracts]);
    }

    // ─── Users ────────────────────────────────────────────────────

    public function users(): Response
    {
        $users = User::withCount('contracts')
            ->latest()
            ->paginate(20)
            ->through(fn($u) => [
                'id' => $u->id,
                'name' => $u->name,
                'email' => $u->email,
                'plan' => $u->plan,
                'credits' => $u->credits,
                'is_admin' => $u->is_admin,
                'contracts_count' => $u->contracts_count,
                'created_at' => $u->created_at->toISOString(),
            ]);

        return Inertia::render('Admin/Users', ['users' => $users]);
    }

    public function userUpdate(\Illuminate\Http\Request $request, User $user): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'plan' => ['sometimes', 'in:free,pro,agency'],
            'credits' => ['sometimes', 'integer', 'min:0'],
            'is_admin' => ['sometimes', 'boolean'],
        ]);

        $user->update($data);
        return response()->json(['message' => 'Utilisateur mis à jour.', 'user' => $user->fresh()]);
    }
}
