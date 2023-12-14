<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class CreateNewToDoListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_store_a_task()
    {
        // Create a user
        $user = User::factory()->create();

        // Simulate a logged-in user
        $this->actingAs($user);

        // Send a POST request to store a task
        $response = $this->post('/tasks', [
            'name' => 'Test Task',
            'completed' => false,
        ]);

        // Assert the response status
        $response->assertStatus(201);

        // Assert that the task was stored in the database
        $this->assertDatabaseHas('tasks', [
            'name' => 'Test Task',
            'completed' => false,
            'user_id' => $user->id,
        ]);
    }
}

