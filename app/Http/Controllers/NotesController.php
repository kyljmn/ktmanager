<?php

namespace App\Http\Controllers;

use App\Note;
use App\Project;
use App\Task;
use Illuminate\Http\Request;

class NotesController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fromprojects(Request $request, Project $project)
    {
      $project->notes()->create($this->validateNote());

      return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fromtasks(Request $request, Task $task)
    {
      $task->notes()->create($this->validateNote());

      return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        //
    }

    public function validateNote()
    {
      return request()->validate([
        'description' => ['required', 'min:5'],
      ]);
    }
}
