@extends('master')

@section('title')
  - Projects
@endsection

@section('content')

<div class="ui one column center aligned stackable page grid">
   <div class="column eight wide">
         <div class="ui center aligned header">
           Edit Project
         </div>

         <div class="ui clearing divider"></div>
         <form class="ui form" action="/projects/{{ $project->id }}" method="POST">
           @method('PATCH')
           @csrf
           <div class="field">
             <label>Project Title</label>
             <input type="text" name="title" value="{{$project->title}}" required>
           </div>
           <div class="field">
             <label>Project Description</label>
             <textarea name="description" placeholder="Write something about your project here" required>{{$project->description}}</textarea>
           </div>
           <div class="field">
             <div class="ui calendar" id="example1">
               <label>Project Deadline</label>
               <input type="text" name="deadline" value="{{ date('F j, Y g:i A', strtotime($project->deadline)) }}" required>
             </div>
           </div>
           <br><br>
           <div>
             <button class="fluid ui blue button" type="submit" name="button">Save Changes</button>
           </div>
         </form>
  </div>
</div>

@endsection
