<?php

namespace Tests\Feature\Api;

use App\Models\Bar;
use App\Models\User;
use App\Models\Attorney;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttorneyBarsTest extends TestCase
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
    public function it_gets_attorney_bars(): void
    {
        $attorney = Attorney::factory()->create();
        $bars = Bar::factory()
            ->count(2)
            ->create([
                'attorney_id' => $attorney->id,
            ]);

        $response = $this->getJson(
            route('api.attorneys.bars.index', $attorney)
        );

        $response->assertOk()->assertSee($bars[0]->attorneyID);
    }

    /**
     * @test
     */
    public function it_stores_the_attorney_bars(): void
    {
        $attorney = Attorney::factory()->create();
        $data = Bar::factory()
            ->make([
                'attorney_id' => $attorney->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.attorneys.bars.store', $attorney),
            $data
        );

        $this->assertDatabaseHas('bars', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $bar = Bar::latest('id')->first();

        $this->assertEquals($attorney->id, $bar->attorney_id);
    }
}
