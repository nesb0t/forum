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

        $thread = make('App\Thread');

        $response = $this->post('/threads', $thread->toArray());

        $this->get($response->headers->get('Location'))
                ->assertSee($thread->title)
                ->assertSee($thread->body);
    }

    public function test_a_thread_requires_a_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    public function test_a_thread_requires_a_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    public function test_a_thread_requires_a_topic()
    {
        factory('App\Topic', 2)->create();

        $this->publishThread(['topic_id' => 99999])
            ->assertSessionHasErrors('topic_id');

        $this->publishThread(['topic_id' => null])
            ->assertSessionHasErrors('topic_id');
    }

    public function publishThread($values = [])
    {
        $this->withExceptionHandling()->signIn();

        $thread = make('App\Thread', $values);

        return $this->post('/threads', $thread->toArray());
    }
}
