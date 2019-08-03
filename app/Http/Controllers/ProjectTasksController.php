<?php

namespace App\Http\Controllers;

use App\Task;
use App\Project;
use Carbon\Carbon;
use App\Note;
use App\User;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
  public function __construct() {
    $this->middleware('auth');
    $this->middleware('can:update,task', ['only'=>['edit', 'update', 'destroy', 'statusChange']]);
  }
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        return view('tasks.create', ['project' => $project]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        $newTask = $this->validateTask();
        $newTask['project_id'] = $project->id;
        $newTask['deadline']= Carbon::createFromFormat('F j, Y g:i A', $request->deadline, auth()->user()->timezone)->timezone('UTC');
        Task::create($newTask);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, Task $task)
    {
      return view('tasks.edit', ['task' => $task, 'project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, Task $task)
    {
        $validated = $this->validateTask();
        $validated['deadline'] = Carbon::createFromFormat('F j, Y g:i A', $request->deadline, auth()->user()->timezone)->timezone('UTC');
        $task->update($validated);
        return redirect()->action(
          'ProjectsController@show', ['id'=> $project->id ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Task $task)
    {
        foreach ($task->notes as $note){
          $note->delete();
        }
        $task->delete();
        return back();
    }

    public function statusChange(Request $request, Task $task)
    {
      $task->update(['status' => $request->status]);

      return back();
    }

    public function validateTask()
    {
      return request()->validate([
        'description' => ['required', 'min:5'],
        'deadline' => ['required'],
      ]);
    }
}
