<?php

namespace App\Http\Resources;

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
            'full_name' => $this->full_name,
            'email' => $this->email,
            'role' => $this->whenLoaded('roles', $this->roles->pluck('name')->all()),
            'permissions' => $this->whenLoaded('permissions', $this->getAllPermissions()->pluck('name')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
