<?php

namespace Database\Factories;

use App\Models\Bar;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bar::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'attorneyID' => $this->faker->text(255),
            'bar' => $this->faker->text(255),
            'attorney_id' => \App\Models\Attorney::factory(),
        ];
    }
}
