<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

  public function index()
  {
    $tasks = Task::paginate(20);

    return view('tasks.index', compact('tasks'));
  }


  public function create()
  {
    return view('tasks.create');
  }


  public function store(StoreTaskRequest $request)
  {
    $data = $request->validated();

    Task::create($data);

    return redirect()->route('tasks.index')
      ->with('message', 'task created successfully');
  }


  public function show(Task $task)
  {
    return view('tasks.show', compact('task'));
  }


  public function edit(Task $task)
  {
    return view('tasks.edit', compact('task'));
  }


  public function update(UpdateTaskRequest $request, Task $task)
  {
    $data = $request->validated();

    $task->update($data);

    return redirect()->route('tasks.index')
      ->with('message', 'task updated successfully');
  }


  public function destroy(Task $task)
  {
    if(($task->loadCount('user') != 0)
      || ($task->loadCount('project') != 0)) {
      return redirect()->route('tasks.index')
        ->with('message', 'This task cannot be deleted because it is assigned to projects or users!');
    }

    $task->delete();

    return redirect()->route('tasks.index')
      ->with('message', 'task deleted successfully');
  }
}
