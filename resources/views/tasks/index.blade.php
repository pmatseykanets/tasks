@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Tasks</div>

        <ul class="list-group">
            @foreach($tasks as $task)
                <li class="list-group-item">
                    {{ $task->description }}
                </li>
            @endforeach
        </ul>
    </div>
@endsection
