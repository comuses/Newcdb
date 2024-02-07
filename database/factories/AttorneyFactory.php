<?php

namespace Database\Factories;

use App\Models\Attorney;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttorneyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attorney::class;

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
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'zipcode' => $this->faker->text(255),
            'case1_id' => \App\Models\Case1::factory(),
        ];
    }
}
