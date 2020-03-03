<?php

namespace Tests\Feature;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_unauthenticated_user_can_not_create_new_forum_threads()
    {
        $this->expectException(AuthenticationException::class);

        $thread = make('App\Thread');

        $this->post('/threads', $thread->toArray());
    }

    public function test_an_unauthenticated_user_can_not_view_create_threads_page()
    {
        $this->expectException(AuthenticationException::class);

        $this->get('/threads/create')
            ->assertRedirect('/login');
    }

    public function test_an_authenticated_user_can_create_new_forum_threads()
    {
        $this->signIn();

        $thread = make('App\Thread');

        $this->post('/threads', $thread->toArray());

        $response = $this->get($thread->path());

        $response->assertSee($thread->title)
                ->assertSee($thread->body);
    }
}
