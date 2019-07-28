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
    <a href="/projects/create">
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
    </a>
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
                  <p>{{ $project->deadline }}</p>
                </div>
              </div>
            </div>
          </a>
        </div>
  @endforeach
</div>



@endsection
