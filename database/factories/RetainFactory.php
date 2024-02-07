<?php

namespace Database\Factories;

use App\Models\Retain;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RetainFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Retain::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'attorneyID' => $this->faker->text(255),
            'caseID' => $this->faker->text(255),
            'emplooyID' => $this->faker->text(255),
            'date' => $this->faker->date(),
            'case1_id' => \App\Models\Case1::factory(),
            'attorney_id' => \App\Models\Attorney::factory(),
            'employee_id' => \App\Models\Employee::factory(),
        ];
    }
}
