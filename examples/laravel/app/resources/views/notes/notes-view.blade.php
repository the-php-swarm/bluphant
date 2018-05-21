
@extends('notes.index', ['sub_title' => 'View'])

@section('content')
	<div><a href="/notes">Back to Notes</a></div>
    <h1>
    	{{ $note['title'] }} 
    	&nbsp;&nbsp;&nbsp; <a href="/notes/{{ $note['key'] }}/edit">[edit]</a>
    	&nbsp;&nbsp;&nbsp; 
    	<div class="inline-option">
	    	{{ Form::open(array('url' => '/notes/' . $note['key'], 'method' => 'DELETE', 'id' => 'notes-delete-form')) }}
	    		<a href="#" onclick="if(confirm('Really want to delete this note?')){document.getElementById('notes-delete-form').submit()}">[delete]</a>
	    	{{ Form::close() }}
	    </div>
    </h1>
    <p>{{ $note['content'] }}</p>
@endsection