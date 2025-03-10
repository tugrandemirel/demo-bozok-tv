<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsletterResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'title' => $this?->title,
            'slug' => $this?->slug,
            'spot' => $this?->spot,
            'content' => $this?->content,
            'is_main_headline' => $this?->is_main_headline,
            'is_five_cuff' => $this?->is_five_cuff,
            'publish_date' => $this->publish_date,
            'created_at' => $this->created_at,
            'image' => MorphImageResource::make($this->whenLoaded('image')),
            'images' => MorphImageResource::collection($this->whenLoaded('images')),
            'category' => CategoryResource::make($this->whenLoaded('category')),
            "seo" => SeoSettingResource::make($this->whenLoaded("seoSetting")),
            "source" => NewsletterSourceResource::make($this->whenLoaded("source"))
        ];
    }
}
