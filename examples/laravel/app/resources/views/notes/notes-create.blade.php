
@extends('notes.index', ['sub_title' => 'Create'])

@section('content')
	<div class="content-top">
		<div class="content-top-item">
			<a href="/notes"><i class="fas fa-angle-left"></i></a>
		</div>
	</div>
	
	{{ Form::open(array('url' => '/notes', 'method' => 'POST')) }}
		<input type="hidden" name="key" id="key" value="{{ $next_note_key }}">
	    <div class="input-row">
	    	<label for="title">Title</label>
	    	<div>
	    		<input type="text" id="title" name="title" value="" placeholder="New note title" />
	    	</div>
	    </div>

	    <div class="input-row">
	    	<label for="content">Content</label>
	    	<div>
	    		<textarea id="content" name="content" placeholder="New note content"></textarea>
	    	</div>
	    </div>

	    <div class="input-row">
	    	<input type="submit" name="submit" value="Save">
	    </div>
	{{ Form::close() }}
@endsection