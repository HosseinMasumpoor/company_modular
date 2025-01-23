<?php

namespace Modules\Role\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionRoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "permission_id" => $this->permission_id,
            "role_id" => $this->role_id,
            "title" => $this->permission()->first()->title,
        ];
    }
}
