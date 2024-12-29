<?php

namespace App\Http\Resources;

use App\Models\Ads;
use App\Models\Newsletter;
use Illuminate\Http\Resources\Json\JsonResource;

class MainHeadlineResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "uuid" => $this?->uuid,
            'headlineable_type' => $this?->headlineable_type,
            'headlineable_id' => $this?->headlineable_id,
            'order' => $this?->order,
            'headlineable' => $this->whenLoaded('headlineable', function () use ($request) {
                if ($this->headlineable_type == Newsletter::class) {
                    return new NewsletterResource($this->headlineable);
                } elseif ($this->headlineable_type == Ads::class) {
                    return new AdsResource($this->headlineable);
                }
                return null;
            }),
        ];
    }
}
