<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Retain;

use App\Models\Case1;
use App\Models\Attorney;
use App\Models\Employee;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RetainTest extends TestCase
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
    public function it_gets_retains_list(): void
    {
        $retains = Retain::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.retains.index'));

        $response->assertOk()->assertSee($retains[0]->attorneyID);
    }

    /**
     * @test
     */
    public function it_stores_the_retain(): void
    {
        $data = Retain::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.retains.store'), $data);

        $this->assertDatabaseHas('retains', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(route('api.retains.update', $retain), $data);

        $data['id'] = $retain->id;

        $this->assertDatabaseHas('retains', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_retain(): void
    {
        $retain = Retain::factory()->create();

        $response = $this->deleteJson(route('api.retains.destroy', $retain));

        $this->assertModelMissing($retain);

        $response->assertNoContent();
    }
}
