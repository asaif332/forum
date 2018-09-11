@extends('layouts.app')

@section('content')
<div class="col-md-6 offset-md-3">
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <th>channel name</th>
                <th>actions</th>
            </thead>
            <tbody>
                @foreach($channels as $channel)
                <tr>
                    <td>
                        {{ $channel->title }}
                    </td>
                    <td>
                        <a class="btn btn-sm btn-secondary" href="{{ route('channels.edit' , ['id' => $channel->id]) }}"><i class="fas fa-edit"></i></a>
                        <form class="d-inline" method="post" action="{{ route('channels.destroy' , ['id' => $channel->id]) }}">
                            @method('DELETE')
                            {{ @csrf_field() }}
                            <button type="submit" class="btn btn-sm btn-danger" onclick="
                            var x = confirm('Do you want to delete this channel ?');
                            if(x){return true;}
                            return false;
                            ">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection