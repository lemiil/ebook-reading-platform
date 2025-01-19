<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    // ReviewResource.php
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'rating' => $this->rating,
            'created_at' => $this->created_at->format('d.m.Y'),
            'name' => $this->user->name,
            'likes' => $this->likers()->count(),
        ];
    }


}
