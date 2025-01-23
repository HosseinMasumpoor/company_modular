<?php

namespace Modules\Role\Models;

use Modules\Role\Models\AdminRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admin\Models\Admin;

class Role extends Model
{
    use SoftDeletes;
    protected $guarded=['id'];

    public function rolePermission():HasMany
    {
        return $this->hasMany(PermissionRole::class);
    }

    public function admin(): HasManyThrough
    {
        return $this->HasManyThrough(Admin::class,AdminRole::class,"role_id","id");
    }

    public function permissions(): HasManyThrough
    {
        return $this->hasManyThrough(Permission::class,PermissionRole::class,"role_id","id");
    }

}
