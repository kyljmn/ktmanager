@extends('master')

@section('title')
  - Create Tasks
@endsection

@section('content')
<form class="" action="/projects/{{ $project->id }}/task" method="post">
  @csrf
  <div>
    <h4>Task Description</h4>
    <input type="text" name="description" placeholder="Task Description">
  </div>
  <div class="">
    <h4>Task Deadline</h4>
    <input type="datetime-local" name="deadline" required>
  </div>
  <button type="submit" name="button">Save Task</button>

</form>
@endsection
