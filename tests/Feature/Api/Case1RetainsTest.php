<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Case1;
use App\Models\Retain;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Case1RetainsTest extends TestCase
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
    public function it_gets_case1_retains(): void
    {
        $case1 = Case1::factory()->create();
        $retains = Retain::factory()
            ->count(2)
            ->create([
                'case1_id' => $case1->id,
            ]);

        $response = $this->getJson(route('api.case1s.retains.index', $case1));

        $response->assertOk()->assertSee($retains[0]->attorneyID);
    }

    /**
     * @test
     */
    public function it_stores_the_case1_retains(): void
    {
        $case1 = Case1::factory()->create();
        $data = Retain::factory()
            ->make([
                'case1_id' => $case1->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.case1s.retains.store', $case1),
            $data
        );

        $this->assertDatabaseHas('retains', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $retain = Retain::latest('id')->first();

        $this->assertEquals($case1->id, $retain->case1_id);
    }
}
