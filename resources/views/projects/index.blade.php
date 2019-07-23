<ul>

  @foreach ($projects as $project)
    <li>
      <p><a href="/projects/{{$project->id}}">{{ $project->title }}</a></p>
      <p>{{ $project->deadline }}</p>
    </li>
  @endforeach
</ul>
<div class="">
  <form class="" action="/projects/create" method="GET">
    @csrf
    <button type="submit" name="button">Create New Project</button>
  </form>

</div>
