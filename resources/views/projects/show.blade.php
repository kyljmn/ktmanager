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
    <a href="/projects/{{ $project-> id}}/task/create">
      <div class="ui fluid card">
        <div class="content">
        <br>
        <div class="center aligned header">
          <p>Add a Task</p>
        </div>
        <div class="center aligned meta">
          <p>Click to add a new task</P>
        </div>
        </div>
        </div>
      </a>
    @foreach ($project->tasks->where('status','todo')->sortBy('deadline') as $task)
    <div class="ui fluid card">
      <div class="content">
        <div class="header">
          <p>{{ $task->description }}</p>
        </div>
        <div class="meta">
          <p>{{ $task->deadline }}</p>
        </div>
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
        <a class="mini ui blue button" href="/projects/{{ $project->id }}/task/{{ $task->id }}/edit">Edit Task</a>
        <form class="" action="/projects/{{ $project->id }}/task/{{ $task->id }}" style="display:inline;" method="POST">
          @method("DELETE")
          @csrf
          <button class="mini ui red button" type="submit" name="button">Delete Task</button>
        </form>
      </div>
    </div>
    @endforeach
  </div>


  <div class="column">
    <div class="ui center aligned small header">
      Doing
    </div>
    @foreach ($project->tasks->where('status','doing')->sortBy('deadline') as $task)
    <div class="ui fluid card">
      <div class="content">
        <div class="header">
          <p>{{ $task->description }}</p>
        </div>
        <div class="meta">
          <p>{{ $task->deadline }}</p>
        </div>
        <form class="" action="/tasks/{{ $task->id }}" method="post">
          @method('PATCH')
          @csrf
          <input type="hidden" name="deadline" value="{{ $task->deadline }}">
            <input type="radio" name="status" value="todo" onChange="this.form.submit()" {{ $task->status == 'todo' ? 'checked' : ''}} >
            <label>to Do</label>
            <input type="radio" name="status" value="doing" onChange="this.form.submit()" {{ $task->status == 'doing' ? 'checked' : ''}} >
            <label>Doing</label>
            <input type="radio" name="status" value="done" onChange="this.form.submit()" {{ $task->status == 'done' ? 'checked' : ''}} >
            <label>Done</label>
        </form>
        <a class="mini ui blue button" href="/projects/{{ $project->id }}/task/{{ $task->id }}/edit">Edit Task</a>
        <form class="" action="/projects/{{ $project->id }}/task/{{ $task->id }}" style="display:inline;" method="POST">
          @method("DELETE")
          @csrf
          <button class="mini ui red button" type="submit" name="button">Delete Task</button>
        </form>
        <div class="ui tiny header">
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
        <form class="ui form" action="/tasks/{{ $task->id }}/notes" method="POST">
          <div class="field">
            @csrf
            <textarea name="description" rows="3" placeholder="Add notes here"></textarea>
          </div>
          <button class="tiny ui blue button" type="submit">Save Note</button>
        </form>
      </div>
    </div>
    @endforeach
  </div>


  <div class="column">
    <div class="ui center aligned small header">
      Done
    </div>
    @foreach ($project->tasks->where('status','done')->sortBy('deadline') as $task)
    <div class="ui fluid card">
      <div class="content">
        <div class="header">
          <p>{{ $task->description }}</p>
        </div>
        <div class="meta">
          <p>{{ $task->deadline }}</p>
        </div>
        <div class="ui form">
        <form class="" action="/tasks/{{ $task->id }}" method="post">
          @method('PATCH')
          @csrf
          <div class="inline fields">
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="status" value="todo" onChange="this.form.submit()" {{ $task->status == 'todo' ? 'checked' : ''}} >
                <label>to Do</label>
              </div>
            </div>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="status" value="doing" onChange="this.form.submit()" {{ $task->status == 'doing' ? 'checked' : ''}} >
                <label>Doing</label>
              </div>
            </div>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="status" value="done" onChange="this.form.submit()" {{ $task->status == 'done' ? 'checked' : ''}} >
                <label>Done</label>
              </div>
            </div>
          </div>
        </form>
        </div>
        <a class="mini ui blue button" href="/projects/{{ $project->id }}/task/{{ $task->id }}/edit">Edit Task</a>
        <form class="" action="/projects/{{ $project->id }}/task/{{ $task->id }}" style="display:inline;" method="POST">
          @method("DELETE")
          @csrf
          <button class="mini ui red button" type="submit" name="button">Delete Task</button>
        </form>
      </div>
    </div>
    @endforeach

  </div>


@endsection
