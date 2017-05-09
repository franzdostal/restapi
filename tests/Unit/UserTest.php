<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreatingUser()
    {
    	$user = factory(User::class)->create();
        $response = $this->get('/api/users/'.$user->id);

        $response->assertStatus(200);
    }

    public function testRemovingUser() 
    {
    	$user = $response = $this->get('/api/users/')->original->toArray()[0];
    	
		$response = $this->delete('/api/users/'.$user['id']);

		$response->assertStatus(200);
    }
}
