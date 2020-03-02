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

        $thread = factory('App\Thread')->make();

        $this->post('/threads', $thread->toArray());
    }

    public function test_an_authenticated_user_can_create_new_forum_threads()
    {
        $this->actingAs(factory('App\User')->create());

        $thread = factory('App\Thread')->make();

        $this->post('/threads', $thread->toArray());

        $response = $this->get($thread->path());

        $response->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
