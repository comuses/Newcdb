<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Retain;
use App\Models\Employee;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeRetainsTest extends TestCase
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
    public function it_gets_employee_retains(): void
    {
        $employee = Employee::factory()->create();
        $retains = Retain::factory()
            ->count(2)
            ->create([
                'employee_id' => $employee->id,
            ]);

        $response = $this->getJson(
            route('api.employees.retains.index', $employee)
        );

        $response->assertOk()->assertSee($retains[0]->attorneyID);
    }

    /**
     * @test
     */
    public function it_stores_the_employee_retains(): void
    {
        $employee = Employee::factory()->create();
        $data = Retain::factory()
            ->make([
                'employee_id' => $employee->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.employees.retains.store', $employee),
            $data
        );

        $this->assertDatabaseHas('retains', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $retain = Retain::latest('id')->first();

        $this->assertEquals($employee->id, $retain->employee_id);
    }
}
