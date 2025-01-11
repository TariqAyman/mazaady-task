<?php

use App\Models\Employee;

test('can list all employees', function () {
    $employees = Employee::factory()->count(3)->create();

    $response = $this->get('/employees');

    $response->assertStatus(200);
    $response->assertJsonCount(3);
});

test('can create an employee', function () {
    $employeeData = [
        'name' => 'John Doe',
        'departments' => [1, 2]
    ];

    $response = $this->post('/employees', $employeeData);

    $response->assertStatus(201);
    $response->assertJsonFragment(['name' => 'John Doe']);
});

test('can show single employee', function () {
    $employee = Employee::factory()->create();

    $response = $this->get("/employees/{$employee->id}");

    $response->assertStatus(200);
    $response->assertJsonFragment(['id' => $employee->id]);
});

test('can update employee', function () {
    $employee = Employee::factory()->create();

    $response = $this->put("/employees/{$employee->id}", [
        'name' => 'Updated Name'
    ]);

    $response->assertStatus(200);
    $response->assertJsonFragment(['name' => 'Updated Name']);
});

test('can delete employee', function () {
    $employee = Employee::factory()->create();

    $response = $this->delete("/employees/{$employee->id}");

    $response->assertStatus(204);
    $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
});
