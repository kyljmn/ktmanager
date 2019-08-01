<?php

namespace App\Http\Controllers;

use App\Project;
use Carbon\Carbon;
use App\Task;
use App\Note;
use App\User;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
      $this->middleware('can:update,project', ['except' => ['index','create','store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $projects = auth()->user()->projects;
      return view('projects.index', ['projects'=> $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $project = $this->validateProject();
      $project['owner_id'] = auth()->id();
      $validated['deadline'] = Carbon::createFromFormat('F j, Y g:i A', $request->deadline, auth()->user()->timezone)->timezone('UTC');
      $newProject = Project::create($project);


      return redirect()->action(
        'ProjectsController@show', ['id'=> $newProject->id ]
      );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        dd($project->deadline);
        return view('projects.show', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('projects.edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $validated = $this->validateProject();
        $validated['deadline'] = Carbon::createFromFormat('F j, Y g:i A', $request->deadline, auth()->user()->timezone)->timezone('UTC');
        $project->update($validated);
        return redirect()->action(
          'ProjectsController@show', ['id'=> $project->id ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        foreach ($project->tasks as $task){
          foreach ($task->notes as $note){
            $note->delete();
          }
          $task->delete();
        }
        foreach ($project->notes as $note){
          $note->delete();
        }
        $project->delete();
        return redirect('/projects');
    }
    protected function validateProject()
    {
      return request()->validate([
        'title' => ['required', 'min:5'],
        'description' => ['required','min:5'],
        'deadline' => ['required'],
      ]);
    }
}
