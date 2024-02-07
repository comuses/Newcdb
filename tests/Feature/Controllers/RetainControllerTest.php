<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Retain;

use App\Models\Case1;
use App\Models\Attorney;
use App\Models\Employee;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RetainControllerTest extends TestCase
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
    public function it_displays_index_view_with_retains(): void
    {
        $retains = Retain::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('retains.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.retains.index')
            ->assertViewHas('retains');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_retain(): void
    {
        $response = $this->get(route('retains.create'));

        $response->assertOk()->assertViewIs('app.retains.create');
    }

    /**
     * @test
     */
    public function it_stores_the_retain(): void
    {
        $data = Retain::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('retains.store'), $data);

        $this->assertDatabaseHas('retains', $data);

        $retain = Retain::latest('id')->first();

        $response->assertRedirect(route('retains.edit', $retain));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_retain(): void
    {
        $retain = Retain::factory()->create();

        $response = $this->get(route('retains.show', $retain));

        $response
            ->assertOk()
            ->assertViewIs('app.retains.show')
            ->assertViewHas('retain');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_retain(): void
    {
        $retain = Retain::factory()->create();

        $response = $this->get(route('retains.edit', $retain));

        $response
            ->assertOk()
            ->assertViewIs('app.retains.edit')
            ->assertViewHas('retain');
    }

    /**
     * @test
     */
    public function it_updates_the_retain(): void
    {
        $retain = Retain::factory()->create();

        $case1 = Case1::factory()->create();
        $attorney = Attorney::factory()->create();
        $employee = Employee::factory()->create();

        $data = [
            'attorneyID' => $this->faker->text(255),
            'caseID' => $this->faker->text(255),
            'emplooyID' => $this->faker->text(255),
            'date' => $this->faker->date(),
            'case1_id' => $case1->id,
            'attorney_id' => $attorney->id,
            'employee_id' => $employee->id,
        ];

        $response = $this->put(route('retains.update', $retain), $data);

        $data['id'] = $retain->id;

        $this->assertDatabaseHas('retains', $data);

        $response->assertRedirect(route('retains.edit', $retain));
    }

    /**
     * @test
     */
    public function it_deletes_the_retain(): void
    {
        $retain = Retain::factory()->create();

        $response = $this->delete(route('retains.destroy', $retain));

        $response->assertRedirect(route('retains.index'));

        $this->assertModelMissing($retain);
    }
}
