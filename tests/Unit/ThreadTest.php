<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_thread_has_replies()
    {
        $thread = factory('App\Thread')->create();

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $thread->replies);
    }
}