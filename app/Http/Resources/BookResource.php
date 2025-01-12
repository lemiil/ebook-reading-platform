<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Kiwilan\Ebook\Ebook;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $coverBASE64 = null;
        $reader = $this->files->firstWhere('format', 'fb2') !== null;
        try {
            $path = storage_path('app/' . $this->files->firstWhere('format', 'epub')->file_path);
            if (file_exists($path)) {
                $ebook = Ebook::read($path);
                $cover = $ebook->getCover();
                if ($cover) {
                    $coverBASE64 = $cover->getContents(true);
                }
            }
        } catch (\Exception $e) {
            $path = null;
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'authors' => $this->authors()->pluck('name'),
            'genres' => $this->genres()->pluck('name'),
            'year' => $this->year,
            'formats' => $this->files->pluck('format'),
            'reader' => $reader,
            'tags' => $this->tags()->pluck('name'),
            'coverBASE64' => $coverBASE64,
            'cover' => $this->cover_path,
            'description' => $this->description,
            'rating' => $this->rating,
            'reviews' => $this->reviews()
                ->where('content', '!=', '')
                ->limit(5)
                ->get()
                ->map(function ($review) {
                    return [
                        'id' => $review->id,
                        'content' => $review->content,
                        'rating' => $review->rating,
                        'created_at' => $review->created_at->format('d.m.Y'),
                        'name' => $review->user->name,
                        'likes' => $review->likers()->count(),
                    ];
                }),
        ];
    }
}
