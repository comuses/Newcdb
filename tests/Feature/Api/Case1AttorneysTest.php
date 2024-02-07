<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Case1;
use App\Models\Attorney;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Case1AttorneysTest extends TestCase
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
    public function it_gets_case1_attorneys(): void
    {
        $case1 = Case1::factory()->create();
        $attorneys = Attorney::factory()
            ->count(2)
            ->create([
                'case1_id' => $case1->id,
            ]);

        $response = $this->getJson(route('api.case1s.attorneys.index', $case1));

        $response->assertOk()->assertSee($attorneys[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_case1_attorneys(): void
    {
        $case1 = Case1::factory()->create();
        $data = Attorney::factory()
            ->make([
                'case1_id' => $case1->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.case1s.attorneys.store', $case1),
            $data
        );

        $this->assertDatabaseHas('attorneys', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $attorney = Attorney::latest('id')->first();

        $this->assertEquals($case1->id, $attorney->case1_id);
    }
}
