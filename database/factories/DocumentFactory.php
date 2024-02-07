<?php

namespace Database\Factories;

use App\Models\Document;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Document::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'caseID' => $this->faker->text(255),
            'documentType' => $this->faker->text(),
            'dateFiled' => $this->faker->date(),
            'description' => $this->faker->sentence(15),
            'case1_id' => \App\Models\Case1::factory(),
        ];
    }
}
