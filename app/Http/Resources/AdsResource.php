<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'ad_type_id' => $this?->ad_type_id,
            'placement_id' => $this?->placement_id,
            'url' => $this?->url,
            'ad_code' => $this?->ad_code,
            'image' => MorphImageResource::make($this->whenLoaded('image'))
        ];
    }
}
