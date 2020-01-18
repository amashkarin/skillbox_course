@extends('layout.master')
@section('content')

<div class="container">
    <div class="row mb-4">
        <div class="col-sm-12">
            <a class="btn btn-primary" href="/posts/create">Добавить статью</a>
        </div>
    </div>
    @foreach($posts as $post)
        <div class="row mb-2">
            <div class="col-sm-12">
                <div class="card flex-md-row mb-4 shadow-sm">
                    <div class="card-body d-flex flex-column align-items-start">
                        <h3 class="mb-0">
                            <a class="text-dark" href="/posts/{{ $post->slug }}">{{ $post->title }}</a>
                        </h3>
                        @include('layout.tags', ['tags' => $post->tags])
                        <div class="mb-1 text-muted">{{ $post->created_at }}</div>
                        <p class="card-text mb-auto">{{ $post->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection