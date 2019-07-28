@extends('master')

@section('title')
  - Project
@endsection

@section('content')


  <div class="ui huge header">
    Projects
    <a class="small ui blue button" href="/projects/create">
          +
    </a>
  </div>
  <div class="ui clearing divider"></div>
<div class="ui four column grid container">
      @foreach ($projects as $project)
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
