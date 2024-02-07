<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Court;

use App\Models\Case1;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourtControllerTest extends TestCase
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
    public function it_displays_index_view_with_courts(): void
    {
        $courts = Court::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('courts.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.courts.index')
            ->assertViewHas('courts');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_court(): void
    {
        $response = $this->get(route('courts.create'));

        $response->assertOk()->assertViewIs('app.courts.create');
    }

    /**
     * @test
     */
    public function it_stores_the_court(): void
    {
        $data = Court::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('courts.store'), $data);

        $this->assertDatabaseHas('courts', $data);

        $court = Court::latest('id')->first();

        $response->assertRedirect(route('courts.edit', $court));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_court(): void
    {
        $court = Court::factory()->create();

        $response = $this->get(route('courts.show', $court));

        $response
            ->assertOk()
            ->assertViewIs('app.courts.show')
            ->assertViewHas('court');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_court(): void
    {
        $court = Court::factory()->create();

        $response = $this->get(route('courts.edit', $court));

        $response
            ->assertOk()
            ->assertViewIs('app.courts.edit')
            ->assertViewHas('court');
    }

    /**
     * @test
     */
    public function it_updates_the_court(): void
    {
        $court = Court::factory()->create();

        $case1 = Case1::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'zipcode' => $this->faker->randomNumber(0),
            'case1_id' => $case1->id,
        ];

        $response = $this->put(route('courts.update', $court), $data);

        $data['id'] = $court->id;

        $this->assertDatabaseHas('courts', $data);

        $response->assertRedirect(route('courts.edit', $court));
    }

    /**
     * @test
     */
    public function it_deletes_the_court(): void
    {
        $court = Court::factory()->create();

        $response = $this->delete(route('courts.destroy', $court));

        $response->assertRedirect(route('courts.index'));

        $this->assertModelMissing($court);
    }
}
