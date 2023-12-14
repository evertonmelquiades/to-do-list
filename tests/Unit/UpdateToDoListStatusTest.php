<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;

class UpdateToDoListStatusTest extends TestCase
{
    use RefreshDatabase;

    public function it_can_update_the_status_of_a_task()
    {
        // Create a user
        $user = User::factory()->create();

        // Simulate a logged-in user
        $this->actingAs($user);

        // Create a task
        $task = Task::factory()->create([
            'user_id' => $user->id,
        ]);

        // Send a PUT request to update the task status
        $response = $this->put("/tasks/{$task->id}", [
            'completed' => true,
        ]);

        // Assert the response status
        $response->assertStatus(200);

        // Assert the expected JSON response
        $response->assertJson([
            'id' => $task->id,
            'name' => $task->name, // Assuming you want to keep the name unchanged
            'completed' => true,
            'created_at' => $task->created_at->toISOString(),
            'updated_at' => $task->fresh()->updated_at->toISOString(), // Refresh the model to get the latest updated_at value
            'user_id' => $user->id,
        ]);
    }
}

