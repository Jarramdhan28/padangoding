<?php

namespace App\Http\Resources;

use App\Http\Resources\Admin\Referensi\CategoryResource;
use App\Http\Resources\Creator\AuthorResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'slug' => $this->slug,
            'title' => $this->title,
            'content' => $this->content,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail ? '/storage/article/thumbnail/' . $this->thumbnail : '/assets/images/no-thumb.png',
            'category' => new CategoryResource($this->category),
            'author' => new AuthorResource($this->author),
            'status' => $this->status,
            'status_label' => $this->status->label(),
            'status_color' => $this->status->getColor(),
            'is_publish' => $this->is_publish,
            'created_at' => $this->updated_at ? $this->created_at : $this->updated_at,
        ];
    }
}
