<?php

namespace Database\Factories;

use App\Models\Case1;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class Case1Factory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Case1::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'partyID' => $this->faker->text(255),
            'Action' => $this->faker->text(255),
            'courtID' => $this->faker->text(255),
            'attorneyID' => $this->faker->text(255),
            'judgeID' => $this->faker->text(255),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'caseTyep' => $this->faker->text(255),
            'caseStatus' => $this->faker->text(255),
            'emplooyID' => $this->faker->text(255),
        ];
    }
}
