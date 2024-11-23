<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Add this line
use App\Models\User; // Add this line

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'badr',
            'email' => 'k.bouchehboun@aljisr.ma',
            'password' => Hash::make('Aljisr.ma'),
            'phone' => '123456789',
            'is_admin' => true,
        ]);
    }
}
