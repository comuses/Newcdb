<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Retain;
use App\Models\Attorney;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttorneyRetainsTest extends TestCase
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
    public function it_gets_attorney_retains(): void
    {
        $attorney = Attorney::factory()->create();
        $retains = Retain::factory()
            ->count(2)
            ->create([
                'attorney_id' => $attorney->id,
            ]);

        $response = $this->getJson(
            route('api.attorneys.retains.index', $attorney)
        );

        $response->assertOk()->assertSee($retains[0]->attorneyID);
    }

    /**
     * @test
     */
    public function it_stores_the_attorney_retains(): void
    {
        $attorney = Attorney::factory()->create();
        $data = Retain::factory()
            ->make([
                'attorney_id' => $attorney->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.attorneys.retains.store', $attorney),
            $data
        );

        $this->assertDatabaseHas('retains', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $retain = Retain::latest('id')->first();

        $this->assertEquals($attorney->id, $retain->attorney_id);
    }
}
