<?php

namespace Modules\Role\database\seeders;

use Illuminate\Database\Seeder;

class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $this->call([
             PermissionSeeder::class,
             AdminRoleSeeder::class,
             RolePermissionSeeder::class,
         ]);
    }
}
