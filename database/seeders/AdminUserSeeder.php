<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $adminEmail = 'admin@admin.com';
        $adminPassword = 'admin@123';

        $adminUser = User::where('email', $adminEmail)->first();

        if(!$adminUser)
        {
            $adminUser = User::create([
                'name' => 'admin',
                'email' =>$adminEmail,
                'password'=>bcrypt($adminPassword),
                'user_type' => 'admin',
            ]);
        }
    }

}
