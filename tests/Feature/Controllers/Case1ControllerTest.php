<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Case1;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Case1ControllerTest extends TestCase
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
    public function it_displays_index_view_with_case1s(): void
    {
        $case1s = Case1::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('case1s.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.case1s.index')
            ->assertViewHas('case1s');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_case1(): void
    {
        $response = $this->get(route('case1s.create'));

        $response->assertOk()->assertViewIs('app.case1s.create');
    }

    /**
     * @test
     */
    public function it_stores_the_case1(): void
    {
        $data = Case1::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('case1s.store'), $data);

        unset($data['attorneyID']);
        unset($data['emplooyID']);

        $this->assertDatabaseHas('case1s', $data);

        $case1 = Case1::latest('id')->first();

        $response->assertRedirect(route('case1s.edit', $case1));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_case1(): void
    {
        $case1 = Case1::factory()->create();

        $response = $this->get(route('case1s.show', $case1));

        $response
            ->assertOk()
            ->assertViewIs('app.case1s.show')
            ->assertViewHas('case1');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_case1(): void
    {
        $case1 = Case1::factory()->create();

        $response = $this->get(route('case1s.edit', $case1));

        $response
            ->assertOk()
            ->assertViewIs('app.case1s.edit')
            ->assertViewHas('case1');
    }

    /**
     * @test
     */
    public function it_updates_the_case1(): void
    {
        $case1 = Case1::factory()->create();

        $data = [
            'partyID' => $this->faker->text(255),
            'Action' => $this->faker->text(255),
            'courtID' => $this->faker->text(255),
            'attorneyID' => $this->faker->text(255),
            'judgeID' => $this->faker->text(255),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'caseTyep' => $this->faker->text(255),
            'caseStatus' => $this->faker->text(255),
            'emplooyID' => $this->faker->text(255),
        ];

        $response = $this->put(route('case1s.update', $case1), $data);

        unset($data['attorneyID']);
        unset($data['emplooyID']);

        $data['id'] = $case1->id;

        $this->assertDatabaseHas('case1s', $data);

        $response->assertRedirect(route('case1s.edit', $case1));
    }

    /**
     * @test
     */
    public function it_deletes_the_case1(): void
    {
        $case1 = Case1::factory()->create();

        $response = $this->delete(route('case1s.destroy', $case1));

        $response->assertRedirect(route('case1s.index'));

        $this->assertModelMissing($case1);
    }
}
