@extends('master')

@section('style')
<style>
  body {
    background-image: url('{{ asset('images/bgcover.jpg') }}');
    background-size:cover;
  }

</style>
@endsection
@section('content')
<div class="ui one column center aligned stackable page grid" style="margin:30vh;">
   <div class="column six wide">
         <div class="ui center aligned huge header">
           <h1>ToDone</h1>
         </div>
         <p class="ui small header">From to do to done real quick.</p>
  </div>
</div>

@endsection
