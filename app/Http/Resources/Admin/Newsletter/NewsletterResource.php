<?php

namespace App\Http\Resources\Admin\Newsletter;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsletterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'publish_date' => $this->publish_date,
            'uuid' => $this->uuid,
            'category_name' => $this->category_name,
            'status' => [
                'name' => $this->status_name,
                'code' => $this->status_code,
            ],
            'images' => [
                'cover' => new NewsletterImageResource($this->image_cover),
                'inside' => new NewsletterImageResource($this->image_inside),
                'featured' => new NewsletterImageResource($this->image_featured),
            ],
            'tags' => NewsletterTagResource::collection($this->tags),
            'tag_count' => $this->tag_count,
            'image_count' => $this->image_count,
        ];
    }
}
