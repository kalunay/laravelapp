@extends('layouts.main')

@section('content')

<form class="row g-3" action="{{ route('post.update', $post->id) }}" method="post">
    @csrf
    @method('patch')
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="{{ $post->title }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Content</label>
        <textarea name="content" class="form-control" rows="3">{{ $post->content }}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category_id" id="" class="form-control">
        @foreach ($categories as $category)
            <option {{ $category->id === $post->category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->title }}</option>
        @endforeach
        </select>
    </div>
    <div class="col-auto">
     <button type="submit" class="btn btn-primary mb-3">Update</button>
    </div>
</form>

@endsection
