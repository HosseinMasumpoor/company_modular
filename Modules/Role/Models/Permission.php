<?php

namespace Modules\Role\Models;

use Modules\Role\Models\PermissionRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Permission extends Model
{
    protected $guarded=['id'];

    public function permissionRole()
    {
        return $this->hasMany(PermissionRole::class);
    }


}
