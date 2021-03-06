<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;

    protected $thread;

    public function setUp() :void
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }

    public function test_a_thread_can_generate_its_path()
    {
        $thread = create('App\Thread');

        $this->assertEquals("/threads/{$thread->topic->slug}/{$thread->id}", $thread->path());
    }

    public function test_a_thread_has_replies()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    public function test_a_thread_has_an_owner()
    {
        $this->assertInstanceOf('App\User', $this->thread->user);
    }

    public function test_a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'user_id'   =>  1,
            'body'      =>  'Test body'
        ]);

        $this->assertCount(1, $this->thread->replies);
    }

    public function test_a_thread_belongs_to_a_topic()
    {
        $thread = create('App\Thread');

        $this->assertInstanceOf('App\Topic', $thread->topic);
    }
}
