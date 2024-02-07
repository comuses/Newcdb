<?php

namespace Database\Factories;

use App\Models\Speciality;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecialityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Speciality::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'attorneyID' => $this->faker->text(255),
            'speciality' => $this->faker->text(255),
            'attorney_id' => \App\Models\Attorney::factory(),
        ];
    }
}
