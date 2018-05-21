
@extends('notes.index', ['sub_title' => 'View'])

@section('content')
    <div class="content-top">
        <div class="content-top-item content-top-left">
            <a href="/notes"><i class="fas fa-angle-left"></i></a>
        </div>
    	
        <div class="content-top-item content-top-center">
            <h1>{{ $note['title'] }}</h1>
        </div>

        <div class="content-top-item content-top-right">
            <a href="/notes/{{ $note['key'] }}/edit"><i class="far fa-edit"></i></a>
            &nbsp;&nbsp;&nbsp;
        	<div class="inline-option">
    	    	{{ Form::open(array('url' => '/notes/' . $note['key'], 'method' => 'DELETE', 'id' => 'notes-delete-form')) }}
    	    		<a href="#" onclick="if(confirm('Really want to delete this note?')){document.getElementById('notes-delete-form').submit()}"><i class="far fa-trash-alt"></i></a>
    	    	{{ Form::close() }}
    	    </div>
        </div>

        <div class="cleaner"></div>
    </div>
    <p>{{ $note['content'] }}</p>
@endsection