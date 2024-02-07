<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'caseID' => $this->faker->text(255),
            'eventType' => $this->faker->text(255),
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'location' => $this->faker->text(255),
            'outcome' => $this->faker->text(255),
            'case1_id' => \App\Models\Case1::factory(),
        ];
    }
}
