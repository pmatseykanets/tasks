<?php

namespace App\Http\Controllers;

use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = $request->user()->tasks;

        return view('tasks.index')
            ->with('tasks', $tasks ?: []);
    }

    public function store(Request $request)
    { 
        $this->validate($request, [
            'task' => 'required',
        ]);

        $request->user()->tasks()->create([
            'task' => $request->get('task'),
        ]);

        return redirect()->route('task.index');
    }

    public function put($id)
    {
        $task = $this->getTaskOrFail($id);

        $task->completed_at = is_null($task->completed_at) ? Carbon::now() : null;
        $task->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $task = $this->getTaskOrFail($id);

        $task->delete();

        return redirect()->back();

    }

    protected function getTaskOrFail($id)
    {
        $task = Task::find((int) $id);

        if (is_null($task)) {
            abort(404);
        }

        return $task;
    }
}
