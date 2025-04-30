<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {name?} {email?} {password?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name') ?? $this->ask('Enter admin name', 'Admin User');
        $email = $this->argument('email') ?? $this->ask('Enter admin email', 'admin@example.com');
        $password = $this->argument('password') ?? $this->secret('Enter admin password (min 8 characters)') ?? 'password123';

        // Check if the user already exists
        if (User::where('email', $email)->exists()) {
            $this->error("A user with email {$email} already exists!");
            
            // Ask if the user should be updated to admin role
            if ($this->confirm('Do you want to update this user to admin role?')) {
                User::where('email', $email)->update(['role' => 'admin']);
                $this->info("User {$email} has been updated to admin role!");
                return;
            }
            
            return;
        }

        // Create the admin user
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
        ]);

        $this->info("Admin user {$email} created successfully!");
    }
}
