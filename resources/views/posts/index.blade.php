@extends('layout.master')
@section('content')

<div class="container">
    <div class="row mb-4">
        <div class="col-sm-12">
            <a class="btn btn-primary" href="{{ route('posts.create') }}">Добавить статью</a>
        </div>
    </div>
    @include('posts.list', ['posts' => $posts])
    {{ $posts->links() }}
</div>

@endsection
