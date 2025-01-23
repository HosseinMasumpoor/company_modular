<?php

namespace Modules\Role\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class PermissionRole extends Model
{
    protected $guarded=['id'];

    public function permission() : BelongsTo {
        return $this->belongsTo(Permission::class,"permission_id");
    }

    public function role() : BelongsTo {
        return $this->belongsTo(Role::class,"role_id");
    }


}
