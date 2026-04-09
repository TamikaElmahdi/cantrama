<?php

namespace App\Http\Controllers;

use App\Http\Resources\TemplateResource;
use App\Models\Template;
use Illuminate\Http\JsonResponse;

class TemplateController extends Controller
{
    public function index(): JsonResponse
    {
        $templates = Template::where('is_active', true)->get();

        return response()->json(TemplateResource::collection($templates));
    }

    public function show(string $slug): JsonResponse
    {
        $template = Template::where('slug', $slug)->where('is_active', true)->firstOrFail();

        return response()->json(new TemplateResource($template));
    }
}
