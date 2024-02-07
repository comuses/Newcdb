<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Case1;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Case1Test extends TestCase
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
    public function it_gets_case1s_list(): void
    {
        $case1s = Case1::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.case1s.index'));

        $response->assertOk()->assertSee($case1s[0]->partyID);
    }

    /**
     * @test
     */
    public function it_stores_the_case1(): void
    {
        $data = Case1::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.case1s.store'), $data);

        unset($data['attorneyID']);
        unset($data['emplooyID']);

        $this->assertDatabaseHas('case1s', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(route('api.case1s.update', $case1), $data);

        unset($data['attorneyID']);
        unset($data['emplooyID']);

        $data['id'] = $case1->id;

        $this->assertDatabaseHas('case1s', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_case1(): void
    {
        $case1 = Case1::factory()->create();

        $response = $this->deleteJson(route('api.case1s.destroy', $case1));

        $this->assertModelMissing($case1);

        $response->assertNoContent();
    }
}
