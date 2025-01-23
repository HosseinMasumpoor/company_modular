<?php

namespace Modules\Role\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

trait CheckPermission
{
    public function can($key)
    {
        return true;
        $query = "SELECT permissions.key
        From
            permissions
            INNER JOIN permission_roles on permissions.id=permission_roles.permission_id
            INNER JOIN roles on permission_roles.role_id=roles.id
            INNER JOIN admin_roles on roles.id=admin_roles.role_id
            INNER JOIN admins on admin_roles.admin_id=admins.id

            where admins.id='" . auth("admin")->user()->id . "'";

        $keys = Arr::pluck(DB::select($query), 'key');

        return in_array($key, $keys);
    }
}
