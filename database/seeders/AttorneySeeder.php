<?php

namespace Database\Seeders;

use App\Models\Attorney;
use Illuminate\Database\Seeder;

class AttorneySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Attorney::factory()
            ->count(5)
            ->create();
    }
}
