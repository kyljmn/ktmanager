@extends('master')

@section('title')
  - Projects
@endsection

@section('content')
<div class="ui huge header">
  {{ $project->title }}
</div>
<p class="meta">Deadline: {{ $project->deadline }}</p>
<p>{{ $project->description }}</p>
<a class="tiny ui blue button" href="/projects/{{ $project->id }}/edit"> Edit Project</a>
<form class="" action="/projects/{{ $project->id }}" style="display:inline;" method="POST">
    @method('DELETE')
    @csrf
    <button class="tiny ui red button" type="submit">Delete Project</button>
</form>
<div class="ui clearing divider"></div>


<div class="ui medium header">
  Notes
</div>
<div class="ui relaxed divided list">
  @foreach ($project->notes as $note)
    <div class="item">
      <div class="description">
        {{ $note->description }}
      </div>
    </div>
  @endforeach
</div>
<form class="ui form" action="/projects/{{ $project->id }}/notes" method="POST">
  <div class="field">
    @csrf
    <textarea name="description" rows="3" placeholder="Add notes here"></textarea>
  </div>
  <button class="tiny ui blue button" type="submit">Save Note</button>
</form>
<div class="ui clearing divider"></div>


<div class="ui medium header">
  Tasks
</div>
<div class="ui three column doubling stackable grid container">
  <div class="column">
    <div class="ui center aligned small header">
      To Do
    </div>


  </div>
  <div class="column">
    <div class="ui center aligned small header">
      Doing
    </div>

  </div>
  <div class="column">
    <div class="ui center aligned small header">
      Done
    </div>

  </div>
    <ul>
    @foreach ($project->tasks->sortBy('deadline') as $task)
    <li>
      <p>{{ $task->description }}</p>
      <p>{{ $task->deadline }}</p>
      <form class="" action="/tasks/{{ $task->id }}" method="post">
        @method('PATCH')
        @csrf
        <input type="hidden" name="deadline" value="{{ $task->deadline }}">
        <label>
          <input type="radio" name="status" value="todo" onChange="this.form.submit()" {{ $task->status == 'todo' ? 'checked' : ''}} > Todo
          <input type="radio" name="status" value="doing" onChange="this.form.submit()" {{ $task->status == 'doing' ? 'checked' : ''}} > Doing
          <input type="radio" name="status" value="done" onChange="this.form.submit()" {{ $task->status == 'done' ? 'checked' : ''}} > Done
        </label>
      </form>
      <form class="" action="/projects/{{ $project->id }}/task/{{ $task->id }}" method="POST">
        @method("DELETE")
        @csrf
        <button type="submit" name="button">Delete Task</button>
      </form>
      <form class="" action="/projects/{{ $project->id }}/task/{{ $task->id }}/edit" method="GET">
        @csrf
        <button type="submit" name="button">Edit Task</button>
      </form>
      <div class="">
        <ul>
          @foreach ($task->notes as $note)
            <li>{{ $note->description }}</li>
          @endforeach
        </ul>
        <form class="" action="/tasks/{{ $task->id }}/notes" method="POST">
          @csrf
          <textarea name="description" rows="3" cols="80" placeholder="Add notes here"></textarea>
          <button type="submit">Save Note</button>
        </form>
      </div>
    </li>
    @endforeach
  </ul>

@endsection
