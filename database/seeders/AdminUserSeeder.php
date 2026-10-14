<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => env('ADMIN_EMAIL', 'mio@mio,mio')], // 登录邮箱
            [
                'name' => env('ADMIN_NAME', 'mio'),
                'password' => Hash::make(env('ADMIN_PASSWORD', '123456789')), // 登录密码 (设为你喜欢的密码)
                'email_verified_at' => now(),
            ]
        );
    }
}
