@extends('master')

@section('title')
  - Project
@endsection

@section('content')


<div class="ui huge header">
    Projects
</div>

<div class="ui clearing divider"></div>
<div class="ui four column grid container">
  <div class="column">
    <div class="ui fluid card"  style="background-color:#0E6EB8; color: white;">
      <div class="content">
      <div class="ui accordion">
        <div class="title">
          <div class="ui center aligned header" style="color: white;">
            Add a new project!
          </div>
        </div>
        <div class="content">
          <form class="ui form" action="/projects" method="post">
            @csrf
            <div class="field">
              <label style="color: white;">Project Title</label>
              <input type="text" name="title" placeholder="Title" required>
            </div>
            <div class="field">
              <label style="color: white;">Project Description</label>
              <input type="text" name="description" placeholder="Write something about your project here" required>
            </div>
            <div class="field">
              <div class="ui calendar" id="example1">
                <label style="color: white;">Project Deadline</label>
                <input type="text" name="deadline" placeholder="Date/Time" required>
              </div>
            </div>
            <button class="ui inverted basic button" type="submit" name="button">Save Project</button>

          </form>
        </div>
      </div>
      </div>
      </div>
    <!-- <a href="/projects/create">
      <div class="ui fluid card">
        <div class="content">
          <div class="header">
            <p class="center aligned">Add a Project</p>
          </div>
          <div class="meta">
            <p class="center aligned">Click to create a new project</p>
          </div>
        </div>
      </div>
    </a> -->
  </div>
  @foreach ($projects->sortBy('deadline') as $project)
        <div class="column">
          <a href="/projects/{{$project->id}}">
            <div class="ui fluid card">
              <div class="content">
                <div class="header">
                  <p>{{ $project->title }}</p>
                </div>
                <div class="meta">
                  <p>Deadline: {{ date('D F j, Y g:i A', strtotime(\Carbon\Carbon::parse($project->deadline)->timezone(auth()->user()->timezone))) }}</p>
                </div>
              </div>
            </div>
          </a>
        </div>
  @endforeach
</div>



@endsection
