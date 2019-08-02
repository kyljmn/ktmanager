@extends('master')

@section('title')
  - Dashboard
@endsection

@section('content')

<div class="ui huge header">
Dashboard - all your tasks
</div>
<div class="ui clearing divider"></div>
<div class="ui three column doubling stackable grid container">


  <div class="column">
    <div class="ui center aligned small header">
      To Do
    </div>
      <div class="ui fluid card"  style="background-color:#0E6EB8; color: white;">
        <div class="content">
        <div class="ui accordion">
          <div class="title">
            <div class="ui center aligned header" style="color: white;">
              Add a new task!
            </div>
          </div>
          <div class="content">
            <form class="ui form" action="/fromdashboard" method="post">
              @csrf
              <div class="field">
                <label style="color: white;">Project</label>
                <div class="ui dropdown">
                  <input type="hidden" name="project_id" required>
                  <i class="dropdown icon"></i>
                  <div class="default text">Select Project</div>
                  <div class="menu">
                    @foreach(auth()->user()->projects as $project)
                      <div class="item" data-value="{{$project->id}}">{{$project->title}}</div>
                    @endforeach
                  </div>
                </div>
              </div>
              <div class="field">
                <label style="color: white;">Task Description</label>
                <input type="text" name="description" placeholder="Task Description" required>
              </div>
              <div class="field">
                <div class="ui calendar" id="example1">
                  <label style="color: white;">Task Deadline</label>
                  <input type="text" name="deadline" placeholder="Date/Time" required>
                </div>
              </div>
              <button class="ui inverted basic button" type="submit" name="button">Save Task</button>

            </form>
          </div>
        </div>
        </div>
        </div>
      <!-- </a> -->
    @foreach ($tasks->where('status','todo')->sortBy('deadline') as $task)
    <div class="ui fluid card">
      <div class="content">
        <div class="header">
          <p>{{ $task->description }}</p>
        </div>
        <div class="meta">
          <p>Project: {{ $task->project->title}}</p>
        </div>
        <div class="meta">
          <p>Deadline: {{ date('D F j, Y g:i A', strtotime(\Carbon\Carbon::parse($task->deadline)->timezone(auth()->user()->timezone))) }}</p>
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

        <div class="ui accordion">
          <div class=" title">
            <div class="ui small header">
              <i class="dropdown icon"></i>
              Notes
            </div>
          </div>
          <div class=" content">
            <div class="ui relaxed divided list">
              @foreach ($task->notes as $note)
                <div class="item">
                  <div class="description">
                    {{ $note->description }}
                  </div>
                </div>
              @endforeach
              <form class="ui form" action="/tasks/{{ $task->id }}/notes" method="POST">
                <div class="field">
                  @csrf
                  <textarea name="description" rows="3" placeholder="Add notes here"></textarea>
                </div>
                <button class="tiny ui blue button" type="submit">Save Note</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>


  <div class="column">
    <div class="ui center aligned small header">
      Doing
    </div>
    @foreach ($tasks->where('status','doing')->sortBy('deadline') as $task)
    <div class="ui fluid card">
      <div class="content">
        <div class="header">
          <p>{{ $task->description }}</p>
        </div>
        <div class="meta">
          <p>Project: {{ $task->project->title}}</p>
        </div>
        <div class="meta">
          <p>Deadline: {{ date('D F j, Y g:i A', strtotime(\Carbon\Carbon::parse($task->deadline)->timezone(auth()->user()->timezone))) }}</p>
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

        <div class="ui accordion">
          <div class="active title">
            <div class="ui small header">
              <i class="dropdown icon"></i>
              Notes
            </div>
          </div>
          <div class="active content">
            <div class="ui relaxed divided list">
              @foreach ($task->notes as $note)
                <div class="item">
                  <div class="description">
                    {{ $note->description }}
                  </div>
                </div>
              @endforeach
              <form class="ui form" action="/tasks/{{ $task->id }}/notes" method="POST">
                <div class="field">
                  @csrf
                  <textarea name="description" rows="3" placeholder="Add notes here"></textarea>
                </div>
                <button class="tiny ui blue button" type="submit">Save Note</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>


  <div class="column">
    <div class="ui center aligned small header">
      Done
    </div>
    @foreach ($tasks->where('status','done')->sortBy('deadline') as $task)
    <div class="ui fluid card">
      <div class="content">
        <div class="header">
          <p>{{ $task->description }}</p>
        </div>
        <div class="meta">
          <p>Project: {{ $task->project->title}}</p>
        </div>
        <div class="meta">
          <p>Deadline: {{ date('D F j, Y g:i A', strtotime(\Carbon\Carbon::parse($task->deadline)->timezone(auth()->user()->timezone))) }}</p>
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

        <div class="ui accordion">
          <div class="title">
            <div class="ui small header">
              <i class="dropdown icon"></i>
              Notes
            </div>
          </div>
          <div class="content">
            <div class="ui relaxed divided list">
              @foreach ($task->notes as $note)
                <div class="item">
                  <div class="description">
                    {{ $note->description }}
                  </div>
                </div>
              @endforeach
              <form class="ui form" action="/tasks/{{ $task->id }}/notes" method="POST">
                <div class="field">
                  @csrf
                  <textarea name="description" rows="3" placeholder="Add notes here"></textarea>
                </div>
                <button class="tiny ui blue button" type="submit">Save Note</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach

  </div>
</div>

@endsection
