<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetUserPermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->user->id,
            'full_name' => $this->user->full_name,
            'email' => $this->user->email,
            'role' => $this->user->roles->first()->name ?? null,
            'permission' => $this->permission,
            'created_at' => $this->user->created_at,
            'updated_at' => $this->user->updated_at
        ];
    }
}
