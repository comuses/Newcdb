<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Case1;
use App\Models\Employee;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Case1EmployeesTest extends TestCase
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
    public function it_gets_case1_employees(): void
    {
        $case1 = Case1::factory()->create();
        $employees = Employee::factory()
            ->count(2)
            ->create([
                'case1_id' => $case1->id,
            ]);

        $response = $this->getJson(route('api.case1s.employees.index', $case1));

        $response->assertOk()->assertSee($employees[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_case1_employees(): void
    {
        $case1 = Case1::factory()->create();
        $data = Employee::factory()
            ->make([
                'case1_id' => $case1->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.case1s.employees.store', $case1),
            $data
        );

        unset($data['case1_id']);

        $this->assertDatabaseHas('employees', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $employee = Employee::latest('id')->first();

        $this->assertEquals($case1->id, $employee->case1_id);
    }
}
