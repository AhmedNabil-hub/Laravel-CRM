<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

  public function index()
  {
    $projects = Project::paginate(20);

    return view('projects.index', compact('projects'));
  }


  public function create()
  {
    return view('projects.create');
  }


  public function store(StoreProjectRequest $request)
  {
    $data = $request->validated();

    Project::create($data);

    return redirect()->route('projects.index')
      ->with('message', 'project created successfully');
  }


  public function show(Project $project)
  {
    return view('projects.show', compact('project'));
  }


  public function edit(Project $project)
  {
    return view('projects.edit', compact('project'));
  }


  public function update(UpdateProjectRequest $request, Project $project)
  {
    $data = $request->validated();

    $project->update($data);

    return redirect()->route('projects.index')
      ->with('message', 'project updated successfully');
  }


  public function destroy(Project $project)
  {
    if(($project->loadCount('user') != 0)
      || ($project->loadCount(['tasks' => function ($query) {
        $query->whereIn('status', ['open', 'in progress']);
      }]) != 0)
      || ($project->loadCount('client') != 0)) {
      return redirect()->route('projects.index')
        ->with('message', 'This project cannot be deleted because it is assigned to clients or users or has running tasks!');
    }

    $project->delete();

    return redirect()->route('projects.index')
      ->with('message', 'project deleted successfully');
  }
}
