<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Speciality;

use App\Models\Attorney;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpecialityTest extends TestCase
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
    public function it_gets_specialities_list(): void
    {
        $specialities = Speciality::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.specialities.index'));

        $response->assertOk()->assertSee($specialities[0]->attorneyID);
    }

    /**
     * @test
     */
    public function it_stores_the_speciality(): void
    {
        $data = Speciality::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.specialities.store'), $data);

        $this->assertDatabaseHas('specialities', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_speciality(): void
    {
        $speciality = Speciality::factory()->create();

        $attorney = Attorney::factory()->create();

        $data = [
            'attorneyID' => $this->faker->text(255),
            'speciality' => $this->faker->text(255),
            'attorney_id' => $attorney->id,
        ];

        $response = $this->putJson(
            route('api.specialities.update', $speciality),
            $data
        );

        $data['id'] = $speciality->id;

        $this->assertDatabaseHas('specialities', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_speciality(): void
    {
        $speciality = Speciality::factory()->create();

        $response = $this->deleteJson(
            route('api.specialities.destroy', $speciality)
        );

        $this->assertModelMissing($speciality);

        $response->assertNoContent();
    }
}
