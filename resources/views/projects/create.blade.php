@extends('master')

@section('title')
  - Create Project
@endsection

@section('content')
<form action="/projects" method="POST">
  @csrf
  <div>
    <h4>Project Title</h4>
    <input type="text" name="title" placeholder="Title" required>
  </div>
  <div>
    <h4>Project Description</h4>
    <textarea name="description" placeholder="Write something about your project here" required></textarea>
  </div>
  <div>
    <h4>Deadline</h4>
    <input type="datetime-local" name="deadline" required>
  </div>
  <br><br>
  <div>
    <button type="submit" name="button">Save project</button>
  </div>
</form>
@endsection
