<?php

namespace Tests\Feature;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TopicTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_topic_has_threads()
    {
        $topic = create('App\Topic');
        $thread = create('App\Thread', ['topic_id' => $topic->id]);

        $this->assertTrue($topic->threads->contains($thread));
    }
}
