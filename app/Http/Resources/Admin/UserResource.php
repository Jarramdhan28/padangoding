<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'name' => $this->name,
            'email' => $this->email,
            'profile' => $this->profile,
            'roles' => $this->roles->pluck('name'),
            'role_id' => $this->roles->pluck('uuid'),
            'email_verified_at' => $this->email_verified_at,
            'last_login' => $this->last_login,
        ];
    }
}
