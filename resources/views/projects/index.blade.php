<ul>

  @foreach ($projects as $project)
    <li>
      <p><a href="/projects/{{$project->id}}">{{ $project->title }}</a></p>
      <p>{{ $project->deadline }}</p>
    </li>
  @endforeach
</ul>
