
@extends('notes.index', ['sub_title' => 'List'])

@section('content')
	<div class="content-top">
		<div class="content-top-item">
			<a href="/notes/create"><i class="fas fa-plus"></i></a>
		</div>
	</div>
    <ul class="notes-list">
        @foreach ($notes as $note)
            <li>
            	<a href="/notes/{{ $note['key'] }}">{{ $note['title'] }}</a>
            	
            	<div class="options">
            		<a href="/notes/{{ $note['key'] }}/edit"><i class="far fa-edit"></i></a>
            		&nbsp;&nbsp;&nbsp;
		        	<div class="inline-option">
		    	    	{{ Form::open(array('url' => '/notes/' . $note['key'], 'method' => 'DELETE', 'id' => 'notes-delete-form')) }}
		    	    		<a href="#" onclick="if(confirm('Really want to delete this note?')){document.getElementById('notes-delete-form').submit()}"><i class="far fa-trash-alt"></i></a>
		    	    	{{ Form::close() }}
		    	    </div>
            	</div>

            	<div class="cleaner"></div>
           	</li>
        @endforeach
    </ul>
@endsection