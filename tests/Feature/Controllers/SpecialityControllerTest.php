<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Speciality;

use App\Models\Attorney;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpecialityControllerTest extends TestCase
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
    public function it_displays_index_view_with_specialities(): void
    {
        $specialities = Speciality::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('specialities.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.specialities.index')
            ->assertViewHas('specialities');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_speciality(): void
    {
        $response = $this->get(route('specialities.create'));

        $response->assertOk()->assertViewIs('app.specialities.create');
    }

    /**
     * @test
     */
    public function it_stores_the_speciality(): void
    {
        $data = Speciality::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('specialities.store'), $data);

        $this->assertDatabaseHas('specialities', $data);

        $speciality = Speciality::latest('id')->first();

        $response->assertRedirect(route('specialities.edit', $speciality));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_speciality(): void
    {
        $speciality = Speciality::factory()->create();

        $response = $this->get(route('specialities.show', $speciality));

        $response
            ->assertOk()
            ->assertViewIs('app.specialities.show')
            ->assertViewHas('speciality');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_speciality(): void
    {
        $speciality = Speciality::factory()->create();

        $response = $this->get(route('specialities.edit', $speciality));

        $response
            ->assertOk()
            ->assertViewIs('app.specialities.edit')
            ->assertViewHas('speciality');
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

        $response = $this->put(
            route('specialities.update', $speciality),
            $data
        );

        $data['id'] = $speciality->id;

        $this->assertDatabaseHas('specialities', $data);

        $response->assertRedirect(route('specialities.edit', $speciality));
    }

    /**
     * @test
     */
    public function it_deletes_the_speciality(): void
    {
        $speciality = Speciality::factory()->create();

        $response = $this->delete(route('specialities.destroy', $speciality));

        $response->assertRedirect(route('specialities.index'));

        $this->assertModelMissing($speciality);
    }
}
