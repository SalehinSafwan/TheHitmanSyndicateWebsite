<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $staffRole = Role::firstOrCreate(['name' => 'Staff']);
        $hitmanRole = Role::firstOrCreate(['name' => 'Hitman']);

        $admin = User::firstOrCreate(
            ['email' => 'admin@hitmansyndicate.test'],
            [
                'codename' => 'High Table',
                'specialty' => 'Administration',
                'role' => 'Admin',
                'name' => 'The Administrator',
                'password' => Hash::make('password'),
            ]
        );

        $staff = User::firstOrCreate(
            ['email' => 'staff@hitmansyndicate.test'],
            [
                'codename' => 'Cleaner-01',
                'specialty' => 'Cleanup',
                'role' => 'Staff',
                'name' => 'Cleanup Staff',
                'password' => Hash::make('password'),
            ]
        );

        $hitman = User::firstOrCreate(
            ['email' => 'hitman@hitmansyndicate.test'],
            [
                'codename' => 'Ghost-47',
                'specialty' => 'Infiltration',
                'role' => 'Hitman',
                'name' => 'Ghost-47',
                'password' => Hash::make('password'),
            ]
        );

        $admin->roles()->syncWithoutDetaching($adminRole->id);
        $staff->roles()->syncWithoutDetaching($staffRole->id);
        $hitman->roles()->syncWithoutDetaching($hitmanRole->id);
    }
}
