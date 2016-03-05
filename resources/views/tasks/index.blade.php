@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h4>Your tasks</h4></div>

        @if(count($tasks) == 0 )
            <div class="list-group-item">
                No tasks yet. Would you like to <a href="{{ url('tasks/create') }}">create</a> one?
            </div>
        @else
            <ul class="list-group">
                @foreach($tasks as $task)
                    <li class="list-group-item">
                        {{ $task->description }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
