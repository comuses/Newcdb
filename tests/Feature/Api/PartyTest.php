<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Party;

use App\Models\Case1;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PartyTest extends TestCase
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
    public function it_gets_parties_list(): void
    {
        $parties = Party::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.parties.index'));

        $response->assertOk()->assertSee($parties[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_party(): void
    {
        $data = Party::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.parties.store'), $data);

        $this->assertDatabaseHas('parties', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_party(): void
    {
        $party = Party::factory()->create();

        $case1 = Case1::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'attonery' => $this->faker->text(255),
            'case1_id' => $case1->id,
        ];

        $response = $this->putJson(route('api.parties.update', $party), $data);

        $data['id'] = $party->id;

        $this->assertDatabaseHas('parties', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_party(): void
    {
        $party = Party::factory()->create();

        $response = $this->deleteJson(route('api.parties.destroy', $party));

        $this->assertModelMissing($party);

        $response->assertNoContent();
    }
}
