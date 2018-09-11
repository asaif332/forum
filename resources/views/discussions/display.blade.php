@extends('layouts.app')
@section('content')

<div class="col-md-10 offset-md-1">
    <div class="card rounded-0">
        <div class="card-body">
            <h4 class="card-title d-inline">{{ $discussion->title }}</h4>&nbsp;&nbsp;&nbsp;
            @if($discussion->is_being_watched_by_auth_user())
            <a href="{{ route('discussions.unwatch' , ['id' => $discussion->id]) }}" class="btn btn-light border-dark btn-sm">unwatch</a>
            @else
            <a href="{{ route('discussions.watch' , ['id' => $discussion->id]) }}" class="btn btn-light border-dark btn-sm">watch</a>
            @endif
            <p class="d-inline float-right">created by : {{ $discussion->user->name }}</p>
            
            <hr>
            <p class="card-text">
                {!! Markdown :: convertTohtml($discussion->content) !!}
            </p>
        </div>
        <div class="card-footer bg-white py-1">
            <span> {{ $discussion->replies->count()}} replies</span>
        </div>
    </div>
    <br>
    <div class="card rounded-0">
        <div class="card-header bg-light text-uppercase">
            Latest replies
        </div>
        <div class="card-body">
            @foreach($discussion->replies()->orderBy('created_at' , 'desc')->get()->all() as $reply)
            <div class="media">
                <img src="{{ $reply->user->avatar }}" width="60px" height="60px" class="rounded-circle mr-3">
                <div class="media-body">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="d-inline text-uppercase font-weight-bold">{{ $reply->user->name}}</h5>
                            <span class="float-right">{{ $reply->created_at->diffForHumans() }}</span>
                            
                            <p class="card-text my-3">{!! Markdown :: convertTohtml($reply->content) !!}</p>
                        </div>
                        <div class="card-footer bg-white py-1">
                            @if($reply->has_already_liked())
                            <a href="{{ route('replies.unlike' , ['id' => $reply->id]) }}" class="btn badge badge-danger">unlike 
                                <span class="badge badge-light"> {{$reply->likes->count()}}</span>
                            </a>
                            @else
                            <a href="{{ route('replies.like' , ['id' => $reply->id]) }}" class="btn badge badge-success">like 
                                    <span class="badge badge-light"> {{$reply->likes->count()}}</span>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            @endforeach

            <hr>
            <h4> Reply to the discussion</h4>
            <br>
            @if( auth()->check())
            <div class="media">
                <img src="{{ auth()->user()->avatar }}" width="80px" height="80px" class="rounded-circle mx-3">
                <div class="media-body">
                    <div class="card bg-light">
                        <div class="card-body">
                            <form method="post" action="{{ route('replies.save' , ['id' => $discussion->id]) }}">
                                {{ @csrf_field() }}
                                <div class="form-group">
                                    <textarea name="reply" rows="4" class="form-control" required></textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <input type="submit" name="submit" value="Reply" class="btn btn-success btn-sm">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @else

            <h4 class="text-center">
                <a href="{{ route('login') }}">please sign in to reply</a>
            </h4>

            @endif
            

        </div>
    </div>
</div>

@endsection