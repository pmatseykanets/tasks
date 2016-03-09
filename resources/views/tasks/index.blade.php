@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h4>My tasks</h4></div>

        @if(count($tasks) == 0)
            <div class="list-group-item">
                No tasks yet. Would you like to <a href="{{ url('tasks/create') }}">create</a> one?
            </div>
        @else
            <table class="table">
                <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>
                                <p>
                                    @if($task->isCompleted()) <s> @endif
                                    {{ $task->task }}
                                    @if($task->isCompleted()) </s> @endif
                                </p>
                            </td>
                            <td class="text-right">
                                <p>
                                    <form action="{{ url('tasks', [$task->id]) }}" method="post" style="display: inline">
                                        {{ method_field('put') }}
                                        {{ csrf_field() }}
                                        <input type="submit"
                                               class="btn btn-xs btn-default"
                                               value="@if($task->isCompleted()) Unmark @else Mark @endif as Done">
                                    </form>
                                    <form action="{{ url('tasks', [$task->id]) }}" method="post" style="display: inline">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete" onclick="return confirm('Are you sure?');">
                                    </form>
                                </p>
                            </td>
                            <td>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <form class="form-inline" role="form" method="POST" action="{{ route('task.store') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('task') ? ' has-error' : '' }}">
                    <input type="text" class="form-control" name="task" value="{{ old('task') }}" placeholder="New Task">
                    <input type="submit" class="btn btn-primary" value="Add">
                </div>
            </form>
            <div class="form-group{{ $errors->has('task') ? ' has-error' : '' }}">
                @if ($errors->has('task'))
                    <span class="help-block">{{ $errors->first('task') }}</span>
                @endif
            </div>
        </div>
    </div>
@endsection
