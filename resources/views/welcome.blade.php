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
   <div class="column eight wide">
          <h1>ToDone</h1>
         <p class="ui small header">From "to do" to "done" real quick.</p>
  </div>
</div>

@endsection
