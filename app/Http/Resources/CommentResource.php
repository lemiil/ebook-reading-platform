<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'parent_comment_id' => $this->parent_comment_id,
            'content' => $this->content,
            'created_at' => $this->created_at->format('d.m.Y'),
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            'children' => CommentResource::collection($this->whenLoaded('children')),
        ];
    }
}
