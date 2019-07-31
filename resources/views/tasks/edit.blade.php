@extends('master')

@section('title')
  - Create Tasks
@endsection

@section('content')

<div class="ui one column center aligned stackable page grid">
  <div class="column eight wide">
    <div class="ui center aligned header">
     Edit Task
    </div>

    <div class="ui clearing divider"></div>
      <form class="ui form" action="/projects/{{ $project->id }}/task/{{ $task->id }}" method="post" required>
        @method('PATCH')
        @csrf
        <div class="field">
          <label>Task Description</label>
          <input type="text" name="description" value="{{ $task->description }}" required>
        </div>
        <div class="field">
          <div class="ui calendar" id="example1">
            <label>Task Deadline</label>
            <input type="text" name="deadline" value="{{ date('F j, Y g:i A', strtotime($task->deadline)) }}" required>
          </div>
        </div>
        <button class="fluid ui blue button" type="submit" name="button">Save Changes</button>
      </form>
    </div>
</div>
@endsection
