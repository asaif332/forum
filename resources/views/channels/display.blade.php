@extends('layouts.app')

@section('content')
<div class="container col-md-8 offset-md-2">
    @if($discussions->count() > 0)
    <h2 class="text-center text-capitalize">{{$channel}} Discussions</h2>
    <hr>
    @foreach($discussions as $discussion)
    <div class="card">
        <div class="card-header">
            <img src="{{ $discussion->user->avatar }}" alt="" width="40px" height="40px" class="rounded-circle">
            <span class="d-inline">{{ $discussion->user->name }}</span>
            <div class="float-right text-right">
                <h4 class="mb-0"><a href="{{ route('discussions.display' , ['slug' => $discussion->slug]) }}">{{$discussion->title}}</a></h4>
                <i class="mb-0"> {{ $discussion->created_at->diffForHumans() }}</i>
            </div>
            
        </div>
        <div class="card-body">
            <p class="mb-0"> {{ str_limit($discussion->content , 150) }}</p>

            <span class="float-right text-info">{{$discussion->replies->count()}} replies</span>
              
        </div>
    </div>
    <br>
    @endforeach

    <br>
    <div class="text-center">
            {{$discussions->links()}}
    </div>

    @else
    <h2 class="text-center">No discussions yet</h2>

    @endif
</div>
@endsection
