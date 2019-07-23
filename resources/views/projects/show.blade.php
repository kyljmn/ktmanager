<div>
  <h1>{{ $project->title }}</h1>
  <p>Deadline: {{ $project->deadline }}</p>
  <p>{{ $project->description }}</p>
  <div class="">
    <form action="/projects/{{ $project->id }}/edit" method="GET">
      @csrf
      <button type="submit">Edit Project</button>
    </form>
    <form class="" action="/projects/{{ $project->id }}" method="POST">
      @method('DELETE')
      @csrf
      <button type="submit">Delete Project</button>
    </form>
  </div>
<div>
<div class="">
  <div class="">
    @foreach ($project->tasks as $task)
      <p>{{ $task->description }}</p>
      <p>{{ $task->deadline }}</p>
      <form class="" action="/tasks/{{ $task->id }}" method="post">
        @method('PATCH')
        @csrf
        <label>
          <input type="radio" name="status" value="todo" onChange="this.form.submit()" {{ $task->status == 'todo' ? 'checked' : ''}} > Todo
          <input type="radio" name="status" value="doing" onChange="this.form.submit()" {{ $task->status == 'doing' ? 'checked' : ''}} > Doing
          <input type="radio" name="status" value="done" onChange="this.form.submit()" {{ $task->status == 'done' ? 'checked' : ''}} > Done
        </label>
      </form>
      <form class="" action="/projects/{{ $project->id }}/tasks/{{ $task->id }}" method="POST">
        @method("DELETE")
        @csrf
        <button type="submit" name="button">Delete Task</button>
      </form>
      <form class="" action="/projects/{{ $project->id }}/tasks/{{ $task->id }}/edit" method="GET">
        @csrf
        <button type="submit" name="button">Delete Task</button>
      </form>
    @endforeach
  </div>
  <div class="">
    <form class="" action="/projects/{{ $project->id }}/task/create" method="GET">
      @csrf
      <button type="submit" name="button">Add Task</button>
    </form>

  </div>
</div>
