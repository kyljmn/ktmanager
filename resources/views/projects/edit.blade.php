@extends('master')

@section('title')
  - Projects
@endsection

@section('content')

<div class="ui huge header">
    Edit Task
</div>

<div class="ui clearing divider"></div>
<form class="ui form" action="/projects/{{ $project->id }}" method="POST">
  @method('PATCH')
  @csrf
  <div>
    <label>Project Title</label>
    <input type="text" name="title" value="{{$project->title}}" required>
  </div>
  <div>
    <label>Project Description</label>
    <textarea name="description" placeholder="Write something about your project here" required>{{$project->description}}</textarea>
  </div>
  <div>
    <label>Project Deadline</label>
    <input type="datetime-local" name="deadline" value="{{$project->deadline}}" required>
  </div>
  <br><br>
  <div>
    <button class="ui blue button" type="submit" name="button">Save Changes</button>
  </div>
</form>

@endsection
