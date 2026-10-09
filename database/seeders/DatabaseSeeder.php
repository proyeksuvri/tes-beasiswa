<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('BOOTSTRAP_ADMIN_EMAIL');
        $password = env('BOOTSTRAP_ADMIN_PASSWORD');

        if (! $email && ! $password) {
            return;
        }

        if (! $email || ! $password || strlen($password) < 12) {
            throw new RuntimeException(
                'Set both BOOTSTRAP_ADMIN_EMAIL and BOOTSTRAP_ADMIN_PASSWORD (minimum 12 characters), or leave both unset.'
            );
        }

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => env('BOOTSTRAP_ADMIN_NAME', 'Administrator'),
                'password' => Hash::make($password),
                'roles' => ['admin'],
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}
