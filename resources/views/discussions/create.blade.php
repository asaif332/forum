@extends('layouts.app')

@section('content')

<div class="card col-md-8 offset-md-2 p-0">
    <div class="card-body">
        <h2 class="card-title text-center"> Create a  discussion</h2>
        <form method="post" action="{{ route('discussions.store') }}">
            {{ @csrf_field() }}
            <div class="form-group">
                <label for="title">Discussion title</label>
                <input type="text" name="title" class="form-control">
            </div>

            <div class="form-group">
                <label for="channel">Select channel</label>
                <select name="channel_id" class="form-control">
                    @foreach($channels as $channel)
                    <option value="{{ $channel->id}}"> {{ $channel->title }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="content">Ask your question ?</label>
                <textarea name="content"  rows="4" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-success" value="create a discussion">
            </div>
        </form>
    </div>
</div>
@endsection