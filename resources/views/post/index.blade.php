@extends('layouts.main')

@section('content')

    <a href="{{ route('post.create') }}" class="btn btn-primary mb-3">Add</a>

    <div>
    @foreach($posts as $post)
        <div><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a></div>
    @endforeach
    </div>

@endsection