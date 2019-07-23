<form class="" action="/projects/{{ $project->id }}/task/{{ $task->id }}" method="post">
  @method("PATCH")
  @csrf
  <div>
    <h4>Task Description</h4>
    <input type="text" name="description" vale="{{ $task->description }}">
  </div>
  <div class="">
    <h4>Task Deadline</h4>
    <input type="datetime-local" name="deadline" required>
  </div>
  <button type="submit" name="button">Update Task</button>

</form>
