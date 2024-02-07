<?php

namespace Database\Factories;

use App\Models\Court;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourtFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Court::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'zipcode' => $this->faker->randomNumber(0),
            'case1_id' => \App\Models\Case1::factory(),
        ];
    }
}
