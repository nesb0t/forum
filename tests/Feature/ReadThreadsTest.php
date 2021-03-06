<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReadThreadsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }

    /**
     * Browse threads
     *
     * @return void
     */
    public function test_a_user_can_view_all_threads()
    {
        $response = $this->get('/threads');

        $response->assertSee($this->thread->title);
    }

    public function test_a_user_can_view_a_single_thread()
    {
        $response = $this->get($this->thread->path());

        $response->assertSee($this->thread->title);
    }

    public function test_a_user_can_read_replies_to_a_thread()
    {
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);

        $response = $this->get($this->thread->path());

        $response->assertSee($reply->body);
    }

    public function test_a_user_can_filter_threads_by_a_topic()
    {
        $topic = create('App\Topic');
        $threadInTopic = create('App\Thread', ['topic_id' => $topic->id]);
        $threadNotInChannel = create('App\Thread');

        $this->get('/threads/' . $topic->slug)
            ->assertSee($threadInTopic->title)
            ->assertDontSee($threadNotInChannel->title);
    }
}
