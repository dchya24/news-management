<?php

namespace App\Http\Resources\News;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = $this->whenLoaded('user');
        return [
            "id" => $this->id,
            "comment" => $this->comment,
            "user_id" => $this->user_id,
            'user' => [
                'id' => $user->id,
                'name' => $user->name
            ],
            "created_at" => $this->created_at,
        ];
    }
}
