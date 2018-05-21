
@extends('notes.index', ['sub_title' => 'Edit'])

@section('content')
	<div><a href="/notes/{{ $note['key'] }}">Back to Note</a></div>
	{{ Form::open(array('url' => '/notes/' . $note['key'], 'method' => 'PUT')) }}
	    <div>
	    	<lable for="title">Title</lable>
	    	<div>
	    		<input id="title" name="title" value="{{ $note['title'] }}"/>
	    	</div>
	    </div>

	    <div>
	    	<lable for="content">Content</lable>
	    	<div>
	    		<textarea id="content" name="content">{{ $note['content'] }}</textarea>
	    	</div>
	    </div>

	    <div><input type="submit" name="submit" value="Save"></div>
	{{ Form::close() }}
@endsection