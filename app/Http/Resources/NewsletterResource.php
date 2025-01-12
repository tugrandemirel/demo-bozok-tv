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
            'publish_date' => Carbon::parse($this->publish_date)->locale('tr')->isoFormat('D MMMM YYYY HH:mm'),
            'created_at' => Carbon::parse($this->created_at)->locale('tr')->isoFormat('D MMMM YYYY HH:mm'),
            'image' => MorphImageResource::make($this->whenLoaded('image')),
            'images' => MorphImageResource::collection($this->whenLoaded('images')),
            'category' => CategoryResource::make($this->whenLoaded('category')),
            "seo" => SeoSettingResource::make($this->whenLoaded("seoSetting")),
            "source" => NewsletterSourceResource::make($this->whenLoaded("source"))
        ];
    }
}
