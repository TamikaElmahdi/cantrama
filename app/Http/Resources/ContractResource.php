<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'template' => [
                'id' => $this->template->id,
                'name_fr' => $this->template->name_fr,
                'name_ar' => $this->template->name_ar,
                'slug' => $this->template->slug,
            ],
            'payment_status' => $this->payment_status,
            'has_pdf' => !is_null($this->pdf_path),
            'created_at' => $this->created_at->toISOString(),
        ];
    }
}
