<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, check if the 'role' column exists, if not, add it
        if (!Schema::hasColumn('users', 'role')) {
            DB::statement("ALTER TABLE users ADD COLUMN role ENUM('admin', 'organizer', 'student') NOT NULL DEFAULT 'student' AFTER password");
            $this->command->info("Added 'role' column to users table");
        }

        // Create admin user
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        $this->command->info('Admin user created successfully:');
        $this->command->info('Email: admin@example.com');
        $this->command->info('Password: admin123');
    }
}
