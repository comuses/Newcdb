<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        $this->call(AttorneySeeder::class);
        $this->call(BarSeeder::class);
        $this->call(Case1Seeder::class);
        $this->call(CourtSeeder::class);
        $this->call(DocumentSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(JudgeSeeder::class);
        $this->call(PartySeeder::class);
        $this->call(RetainSeeder::class);
        $this->call(SpecialitySeeder::class);
        $this->call(UserSeeder::class);
    }
}
