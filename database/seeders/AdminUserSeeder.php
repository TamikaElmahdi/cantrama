<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@contratma.ma'],
            [
                'name' => 'Admin ContratMA',
                'password' => Hash::make('admin123!'),
                'plan' => 'agency',
                'credits' => 999,
                'is_admin' => true,
            ]
        );
    }
}
