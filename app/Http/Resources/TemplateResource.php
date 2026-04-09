<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TemplateResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name_fr' => $this->name_fr,
            'name_ar' => $this->name_ar,
            'slug' => $this->slug,
            'category' => $this->category,
            'description_fr' => $this->description_fr,
            'fields' => $this->fields,
            'is_active' => $this->is_active,
        ];
    }
}
