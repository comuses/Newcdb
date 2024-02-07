<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Judge;

use App\Models\Court;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JudgeTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_judges_list(): void
    {
        $judges = Judge::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.judges.index'));

        $response->assertOk()->assertSee($judges[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_judge(): void
    {
        $data = Judge::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.judges.store'), $data);

        $this->assertDatabaseHas('judges', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_judge(): void
    {
        $judge = Judge::factory()->create();

        $court = Court::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'years' => $this->faker->year(),
            'courtID' => $this->faker->text(255),
            'court_id' => $court->id,
        ];

        $response = $this->putJson(route('api.judges.update', $judge), $data);

        $data['id'] = $judge->id;

        $this->assertDatabaseHas('judges', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_judge(): void
    {
        $judge = Judge::factory()->create();

        $response = $this->deleteJson(route('api.judges.destroy', $judge));

        $this->assertModelMissing($judge);

        $response->assertNoContent();
    }
}
