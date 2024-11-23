<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
// In database/seeders/DatabaseSeeder.php

public function run()
{
    $this->call([
        RolePermissionSeeder::class,
        AdminUserSeeder::class,
    ]);
}

}
