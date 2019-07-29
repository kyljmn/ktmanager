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
      <form class="ui form" action="/projects/{{ $project->id }}/task/{{ $task->id }}" method="post">
        @method('PATCH')
        @csrf
        <div class="field">
          <label>Task Description</label>
          <input type="text" name="description" value="{{ $task->description }}">
        </div>
        <div class="field">
          <label>Task Deadline</label>
          <input type="datetime-local" name="deadline" required>
        </div>
        <button class="fluid ui blue button" type="submit" name="button">Save Changes</button>
      </form>
    </div>
</div>
@endsection
