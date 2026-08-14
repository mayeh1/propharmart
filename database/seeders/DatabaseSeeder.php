<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@propharmat.com');
        $password = env('ADMIN_PASSWORD');

        if (! $password) {
            $password = Str::random(20);
            $this->command?->warn("No ADMIN_PASSWORD set in .env — generated one-time admin password for {$email}: {$password}");
        }

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Admin User',
                'password' => bcrypt($password),
                'is_admin' => true,
            ]
        );

        $this->call([
            SiteSettingSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
