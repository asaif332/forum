@extends('layouts.app')

@section('content')

<div class="card col-md-8 offset-md-2 p-0">
    <div class="card-body">
        <h2 class="card-title text-center"> Add a channel</h2>
        <form method="post" action="{{ route('channels.store') }}">
            {{ @csrf_field() }}
            <div class="form-group">
                <label for="title">Channel title</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-success" value="Add a channel">
            </div>
        </form>
    </div>
</div>
@endsection