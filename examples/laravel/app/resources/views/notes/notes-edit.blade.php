
@extends('notes.index', ['sub_title' => 'Edit'])

@section('content')
	<div class="content-top">
		<div class="content-top-item">
			<a href="/notes/{{ $note['key'] }}"><i class="fas fa-angle-left"></i></a>
		</div>
	</div>

	{{ Form::open(array('url' => '/notes/' . $note['key'], 'method' => 'PUT')) }}
	    <div class="input-row">
	    	<label for="title">Title</label>
	    	<div>
	    		<input type="text" id="title" name="title" value="{{ $note['title'] }}"/>
	    	</div>
	    </div>

	    <div class="input-row">
	    	<label for="content">Content</label>
	    	<div>
	    		<textarea id="content" name="content">{{ $note['content'] }}</textarea>
	    	</div>
	    </div>

	    <div class="input-row">
	    	<input type="submit" name="submit" value="Save">
	    </div>
	{{ Form::close() }}
@endsection