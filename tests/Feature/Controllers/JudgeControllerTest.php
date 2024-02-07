<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Judge;

use App\Models\Court;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JudgeControllerTest extends TestCase
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
    public function it_displays_index_view_with_judges(): void
    {
        $judges = Judge::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('judges.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.judges.index')
            ->assertViewHas('judges');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_judge(): void
    {
        $response = $this->get(route('judges.create'));

        $response->assertOk()->assertViewIs('app.judges.create');
    }

    /**
     * @test
     */
    public function it_stores_the_judge(): void
    {
        $data = Judge::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('judges.store'), $data);

        $this->assertDatabaseHas('judges', $data);

        $judge = Judge::latest('id')->first();

        $response->assertRedirect(route('judges.edit', $judge));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_judge(): void
    {
        $judge = Judge::factory()->create();

        $response = $this->get(route('judges.show', $judge));

        $response
            ->assertOk()
            ->assertViewIs('app.judges.show')
            ->assertViewHas('judge');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_judge(): void
    {
        $judge = Judge::factory()->create();

        $response = $this->get(route('judges.edit', $judge));

        $response
            ->assertOk()
            ->assertViewIs('app.judges.edit')
            ->assertViewHas('judge');
    }

    /**
     * @test
     */
    public function it_updates_the_judge(): void
    {
        $judge = Judge::factory()->create();

        $court = Court::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'years' => $this->faker->year(),
            'courtID' => $this->faker->text(255),
            'court_id' => $court->id,
        ];

        $response = $this->put(route('judges.update', $judge), $data);

        $data['id'] = $judge->id;

        $this->assertDatabaseHas('judges', $data);

        $response->assertRedirect(route('judges.edit', $judge));
    }

    /**
     * @test
     */
    public function it_deletes_the_judge(): void
    {
        $judge = Judge::factory()->create();

        $response = $this->delete(route('judges.destroy', $judge));

        $response->assertRedirect(route('judges.index'));

        $this->assertModelMissing($judge);
    }
}
