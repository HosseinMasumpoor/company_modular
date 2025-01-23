<?php

namespace Database\Seeders;

use Modules\Role\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public static array $seeders = [];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(self::$seeders);
    }
}
