<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Task;

class TaskTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreatingUser()
    {
    	$task = factory(Task::class)->create();
        $response = $this->get('/api/tasks/'.$task->task_id);

        $response->assertStatus(200);
    }

    public function testRemovingTask() 
    {
    	$task = $response = $this->get('/api/tasks/')->original->toArray()[0];

		$response = $this->delete('/api/tasks/'.$task['task_id']);

		$resp = json_decode($response->original);

		
		$response->assertStatus(200);
		

		
    }
}
