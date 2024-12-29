<?php

namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MorphImageResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'image_name' => $this?->image_name ?? null,
            'path' => $this?->path ?? null,
            'alt_text' => $this?->alt_text ?? null,
            'width' => $this?->width ?? null,
            'height' => $this?->height ?? null,
            'image_type' => $this?->image_type ?? null,
        ];
    }
}
