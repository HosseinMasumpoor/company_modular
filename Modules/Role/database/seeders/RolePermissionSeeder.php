<?php

namespace Modules\Role\database\seeders;

use Modules\Role\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions=Permission::all();
        foreach($permissions as $permission){
            DB::table('permission_roles')->insert(['permission_id' => $permission->id,"role_id"=>1 ]);

        }


    }
}
