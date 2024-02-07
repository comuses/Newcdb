<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Party;

use App\Models\Case1;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PartyControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_parties(): void
    {
        $parties = Party::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('parties.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.parties.index')
            ->assertViewHas('parties');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_party(): void
    {
        $response = $this->get(route('parties.create'));

        $response->assertOk()->assertViewIs('app.parties.create');
    }

    /**
     * @test
     */
    public function it_stores_the_party(): void
    {
        $data = Party::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('parties.store'), $data);

        $this->assertDatabaseHas('parties', $data);

        $party = Party::latest('id')->first();

        $response->assertRedirect(route('parties.edit', $party));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_party(): void
    {
        $party = Party::factory()->create();

        $response = $this->get(route('parties.show', $party));

        $response
            ->assertOk()
            ->assertViewIs('app.parties.show')
            ->assertViewHas('party');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_party(): void
    {
        $party = Party::factory()->create();

        $response = $this->get(route('parties.edit', $party));

        $response
            ->assertOk()
            ->assertViewIs('app.parties.edit')
            ->assertViewHas('party');
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

        $response = $this->put(route('parties.update', $party), $data);

        $data['id'] = $party->id;

        $this->assertDatabaseHas('parties', $data);

        $response->assertRedirect(route('parties.edit', $party));
    }

    /**
     * @test
     */
    public function it_deletes_the_party(): void
    {
        $party = Party::factory()->create();

        $response = $this->delete(route('parties.destroy', $party));

        $response->assertRedirect(route('parties.index'));

        $this->assertModelMissing($party);
    }
}
