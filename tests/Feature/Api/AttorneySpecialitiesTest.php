<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Attorney;
use App\Models\Speciality;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttorneySpecialitiesTest extends TestCase
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
    public function it_gets_attorney_specialities(): void
    {
        $attorney = Attorney::factory()->create();
        $specialities = Speciality::factory()
            ->count(2)
            ->create([
                'attorney_id' => $attorney->id,
            ]);

        $response = $this->getJson(
            route('api.attorneys.specialities.index', $attorney)
        );

        $response->assertOk()->assertSee($specialities[0]->attorneyID);
    }

    /**
     * @test
     */
    public function it_stores_the_attorney_specialities(): void
    {
        $attorney = Attorney::factory()->create();
        $data = Speciality::factory()
            ->make([
                'attorney_id' => $attorney->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.attorneys.specialities.store', $attorney),
            $data
        );

        $this->assertDatabaseHas('specialities', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $speciality = Speciality::latest('id')->first();

        $this->assertEquals($attorney->id, $speciality->attorney_id);
    }
}
