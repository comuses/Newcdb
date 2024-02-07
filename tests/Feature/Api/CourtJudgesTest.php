<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Court;
use App\Models\Judge;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourtJudgesTest extends TestCase
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
    public function it_gets_court_judges(): void
    {
        $court = Court::factory()->create();
        $judges = Judge::factory()
            ->count(2)
            ->create([
                'court_id' => $court->id,
            ]);

        $response = $this->getJson(route('api.courts.judges.index', $court));

        $response->assertOk()->assertSee($judges[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_court_judges(): void
    {
        $court = Court::factory()->create();
        $data = Judge::factory()
            ->make([
                'court_id' => $court->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.courts.judges.store', $court),
            $data
        );

        $this->assertDatabaseHas('judges', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $judge = Judge::latest('id')->first();

        $this->assertEquals($court->id, $judge->court_id);
    }
}
