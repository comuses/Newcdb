<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Employee;

use App\Models\Case1;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeTest extends TestCase
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
    public function it_gets_employees_list(): void
    {
        $employees = Employee::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.employees.index'));

        $response->assertOk()->assertSee($employees[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_employee(): void
    {
        $data = Employee::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.employees.store'), $data);

        unset($data['case1_id']);

        $this->assertDatabaseHas('employees', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_employee(): void
    {
        $employee = Employee::factory()->create();

        $user = User::factory()->create();
        $case1 = Case1::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'zipcode' => $this->faker->text(255),
            'telephone' => $this->faker->text(255),
            'dob' => $this->faker->date(),
            'user_id' => $user->id,
            'case1_id' => $case1->id,
        ];

        $response = $this->putJson(
            route('api.employees.update', $employee),
            $data
        );

        unset($data['case1_id']);

        $data['id'] = $employee->id;

        $this->assertDatabaseHas('employees', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_employee(): void
    {
        $employee = Employee::factory()->create();

        $response = $this->deleteJson(
            route('api.employees.destroy', $employee)
        );

        $this->assertModelMissing($employee);

        $response->assertNoContent();
    }
}
