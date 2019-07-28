@extends('master')

@section('title')
  - Projects
@endsection

@section('content')
<form action="/projects/{{ $project->id }}" method="POST">
  @method('PATCH')
  @csrf
  <div>
    <h4>Project Title</h4>
    <input type="text" name="title" value="{{$project->title}}" required>
  </div>
  <div>
    <h4>Project Description</h4>
    <textarea name="description" placeholder="Write something about your project here" required>{{$project->description}}</textarea>
  </div>
  <div>
    <h4>Deadline</h4>
    <input type="datetime-local" name="deadline" value="{{$project->deadline}}" required>
  </div>
  <br><br>
  <div>
    <button type="submit" name="button">Update Project</button>
  </div>
</form>
@endsection
