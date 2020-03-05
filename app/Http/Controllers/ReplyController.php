<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($topic, Thread $thread)
    {
        $this->validate(request(), [
            'body'      =>  'required'
        ]);

        $thread->addReply([
            'user_id'   =>  auth()->id(),
            'body'      =>  request('body')
        ]);

        return back();
    }
}
