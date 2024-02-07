<?php

namespace Database\Seeders;

use App\Models\Case1;
use Illuminate\Database\Seeder;

class Case1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Case1::factory()
            ->count(5)
            ->create();
    }
}
