
@extends('notes.index', ['sub_title' => 'List'])

@section('content')
	<div><a href="/notes/create">[new note]</a></div>
    <ul>
        @foreach ($notes as $note)
            <li><a href="/notes/{{ $note['key'] }}">{{ $note['title'] }}</a></li>
        @endforeach
    </ul>
@endsection