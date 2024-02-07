<?php

namespace Database\Factories;

use App\Models\Party;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Party::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'attonery' => $this->faker->text(255),
            'case1_id' => \App\Models\Case1::factory(),
        ];
    }
}
