<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskControllerTest extends TestCase
{
    

    public function test_no_tasks_available()
    {
        // create a user 
        $user = User::create([
            'name'=>'test name',
            'email'=>'e@e.com',
            'password'=>bcrypt('123456789'),
        ]);
        
        $response = $this->actingAs($user)->get('/all-tasks');
        $response->assertStatus(200);
        $response->assertSee("Tasks Not Found");
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_tasks()
    {
        // create a user 
        $user =  \App\Models\User::factory()->create();
        
        $response = $this->actingAs($user)->get('/all-tasks');
        $response->assertStatus(200);
        $response->assertDontSee("Task Name");
    }

    public function test_user_can_not_access_taskes_if_not_authenticated(){

        $response = $this->get('all-tasks');
        $response->assertStatus(302);
        $response->assertRedirect('login');
    }
}
