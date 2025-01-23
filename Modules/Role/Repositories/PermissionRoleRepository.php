<?php

namespace Modules\Role\Repositories;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Repositories\Repository;
use Modules\Role\Models\PermissionRole;

class PermissionRoleRepository extends Repository
{
    public string|Model $model = PermissionRole::class;
}
