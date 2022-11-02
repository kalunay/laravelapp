@extends('layouts.main')

@section('content')

<h3>{{ $post->title }}</h3>

<blockquote class="blockquote">
  <p>{{ $post->content }}</p>
</blockquote>

<form action="{{ route('post.destroy', $post->id) }}" method="post">
  @csrf
  @method('delete')
  <button type="submit" class="btn">Del</button>
</form>
<a href="{{ route('post.index') }}">LIST</a>
<a href="{{ route('post.edit', $post->id) }}">EDIT</a>

@endsection