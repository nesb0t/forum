<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_create_thread()
    {
        $this->withExceptionHandling()
            ->get('/threads/topic/create')
            ->assertRedirect('/login');

        $this->withExceptionHandling()
            ->post('/threads')
            ->assertRedirect('/login');;
    }

    public function test_an_authenticated_user_can_create_new_forum_threads()
    {
        $this->signIn();

        $thread = create('App\Thread');

        $this->post('/threads', $thread->toArray());

        $response = $this->get($thread->path());

        $response->assertSee($thread->title)
                ->assertSee($thread->body);
    }
}
