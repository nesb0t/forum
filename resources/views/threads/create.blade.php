@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a Thread</div>

                    <div class="card-body">
                        @if(auth()->check())
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <form method="POST" action="/threads">
                                        @csrf
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                                        </div>

                                        <div class="form-group">
                                            <label for="body"></label>
                                            <textarea class="form-control" id="body" name="body" placeholder="What's up?" rows="6"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Post</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <p class="text-center"><a href="{{ route('login') }}">Sign in</a> to create a thread!</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
