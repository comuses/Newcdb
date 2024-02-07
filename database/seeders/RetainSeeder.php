<?php

namespace Database\Seeders;

use App\Models\Retain;
use Illuminate\Database\Seeder;

class RetainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Retain::factory()
            ->count(5)
            ->create();
    }
}
