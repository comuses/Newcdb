<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Attorney;

use App\Models\Case1;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttorneyTest extends TestCase
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
    public function it_gets_attorneys_list(): void
    {
        $attorneys = Attorney::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.attorneys.index'));

        $response->assertOk()->assertSee($attorneys[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_attorney(): void
    {
        $data = Attorney::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.attorneys.store'), $data);

        $this->assertDatabaseHas('attorneys', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_attorney(): void
    {
        $attorney = Attorney::factory()->create();

        $case1 = Case1::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'zipcode' => $this->faker->text(255),
            'case1_id' => $case1->id,
        ];

        $response = $this->putJson(
            route('api.attorneys.update', $attorney),
            $data
        );

        $data['id'] = $attorney->id;

        $this->assertDatabaseHas('attorneys', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_attorney(): void
    {
        $attorney = Attorney::factory()->create();

        $response = $this->deleteJson(
            route('api.attorneys.destroy', $attorney)
        );

        $this->assertModelMissing($attorney);

        $response->assertNoContent();
    }
}
