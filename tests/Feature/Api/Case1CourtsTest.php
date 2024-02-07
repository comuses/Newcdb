<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Case1;
use App\Models\Court;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Case1CourtsTest extends TestCase
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
    public function it_gets_case1_courts(): void
    {
        $case1 = Case1::factory()->create();
        $courts = Court::factory()
            ->count(2)
            ->create([
                'case1_id' => $case1->id,
            ]);

        $response = $this->getJson(route('api.case1s.courts.index', $case1));

        $response->assertOk()->assertSee($courts[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_case1_courts(): void
    {
        $case1 = Case1::factory()->create();
        $data = Court::factory()
            ->make([
                'case1_id' => $case1->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.case1s.courts.store', $case1),
            $data
        );

        $this->assertDatabaseHas('courts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $court = Court::latest('id')->first();

        $this->assertEquals($case1->id, $court->case1_id);
    }
}
