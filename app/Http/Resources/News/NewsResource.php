<?php

namespace App\Http\Resources\News;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $response = [
            "id" => $this->id,
            "title" => $this->title,
            "slug" => $this->slug,
            "content" => $this->content,
            "image" => $this->image,
            "author" => [
                'id' => $this->user_id,
                'name' => $this->user_name,
            ],
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            // "comments" => CommentsResource::collection($this->whenLoaded('comment'))
        ];

        if(get_class($this->resource) === "App\Models\News"){
            $response['author']['name'] = $this->author->name;
            $response['comment'] = CommentsResource::collection($this->whenLoaded('comment'));
        }

        return $response;       
    }
}
