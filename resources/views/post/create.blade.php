@extends('layouts.main')

@section('content')

<form class="row g-3" action="{{ route('post.store') }}" method="post">
    @csrf
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Content</label>
        <textarea name="content" class="form-control" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category_id" id="" class="form-control">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->title }}</option>
        @endforeach
        </select>
    </div>
    <div class="col-auto">
     <button type="submit" class="btn btn-primary mb-3">Create</button>
    </div>
</form>

@endsection
