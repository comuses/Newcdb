<?php

namespace Tests\Feature\Controllers;

use App\Models\Bar;
use App\Models\User;

use App\Models\Attorney;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BarControllerTest extends TestCase
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
    public function it_displays_index_view_with_bars(): void
    {
        $bars = Bar::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('bars.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.bars.index')
            ->assertViewHas('bars');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_bar(): void
    {
        $response = $this->get(route('bars.create'));

        $response->assertOk()->assertViewIs('app.bars.create');
    }

    /**
     * @test
     */
    public function it_stores_the_bar(): void
    {
        $data = Bar::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('bars.store'), $data);

        $this->assertDatabaseHas('bars', $data);

        $bar = Bar::latest('id')->first();

        $response->assertRedirect(route('bars.edit', $bar));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_bar(): void
    {
        $bar = Bar::factory()->create();

        $response = $this->get(route('bars.show', $bar));

        $response
            ->assertOk()
            ->assertViewIs('app.bars.show')
            ->assertViewHas('bar');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_bar(): void
    {
        $bar = Bar::factory()->create();

        $response = $this->get(route('bars.edit', $bar));

        $response
            ->assertOk()
            ->assertViewIs('app.bars.edit')
            ->assertViewHas('bar');
    }

    /**
     * @test
     */
    public function it_updates_the_bar(): void
    {
        $bar = Bar::factory()->create();

        $attorney = Attorney::factory()->create();

        $data = [
            'attorneyID' => $this->faker->text(255),
            'bar' => $this->faker->text(255),
            'attorney_id' => $attorney->id,
        ];

        $response = $this->put(route('bars.update', $bar), $data);

        $data['id'] = $bar->id;

        $this->assertDatabaseHas('bars', $data);

        $response->assertRedirect(route('bars.edit', $bar));
    }

    /**
     * @test
     */
    public function it_deletes_the_bar(): void
    {
        $bar = Bar::factory()->create();

        $response = $this->delete(route('bars.destroy', $bar));

        $response->assertRedirect(route('bars.index'));

        $this->assertModelMissing($bar);
    }
}
