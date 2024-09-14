<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'asmaa',
            'email' => 'asmaa@gmail.com',
            'phone' => '01111111111',
            'type' => 'admin',
            'password' => '12345678',
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'phone' => '01111111111',
            'type' => 'user',
            'password' => '12345678',
        ]);

        $user->assignRole('user');

        $revision = User::create([
            'name' => 'revision',
            'email' => 'revision@gmail.com',
            'phone' => '01111111111',
            'type' => 'revision',
            'password' => '12345678',
        ]);

        $revision->assignRole('revision');
    }
}
