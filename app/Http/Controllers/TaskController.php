<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TaskController extends Controller
{
    public function index()
    {
        return view('tasks.index')
            ->with('tasks', []);
    }

    public function create()
    {

    }

    public function store($id)
    {

    }

    public function destroy($id)
    {

    }
}
