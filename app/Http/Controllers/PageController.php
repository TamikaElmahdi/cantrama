<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function home(): Response
    {
        $templates = Template::where('is_active', true)->get(['id', 'name_fr', 'name_ar', 'slug']);

        return Inertia::render('Home', [
            'templates' => $templates,
        ]);
    }

    public function contractBuilder(string $slug): Response
    {
        $template = Template::where('slug', $slug)->where('is_active', true)->firstOrFail();

        return Inertia::render('ContractBuilder', [
            'template' => $template,
        ]);
    }

    public function history(): Response
    {
        return Inertia::render('ContractHistory');
    }
}
