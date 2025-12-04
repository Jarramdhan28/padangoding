<?php

namespace App\Http\Resources\Creator;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'profile' => $this->profile ?? null,
            'username' => $this->username,
            'name' => $this->name,
            'email' => $this->email,
            'bio' => $this->bio,
        ];
    }
}
