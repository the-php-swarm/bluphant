
@extends('notes.index', ['sub_title' => 'Create'])

@section('content')
	<div><a href="/notes">Back to Notes</a></div>
	{{ Form::open(array('url' => '/notes', 'method' => 'POST')) }}
		<input type="hidden" name="key" id="key" value="{{ $next_note_key }}">
	    <div>
	    	<lable for="title">Title</lable>
	    	<div>
	    		<input id="title" name="title" value="" placeholder="New note title" />
	    	</div>
	    </div>

	    <div>
	    	<lable for="content">Content</lable>
	    	<div>
	    		<textarea id="content" name="content" placeholder="New note content"></textarea>
	    	</div>
	    </div>

	    <div><input type="submit" name="submit" value="Save"></div>
	{{ Form::close() }}
@endsection