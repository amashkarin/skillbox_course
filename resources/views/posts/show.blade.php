@extends('layout.master')
@section('content')
    <div class="mb-2">
        <i>{{ $post->created_at }}</i>
    </div>
    @include('layout.tags', ['tags' => $post->tags])
    {{ $post->body }}
    <hr>
    <form action="{{ route('posts.show', $post) }}" method="post">
        @method('DELETE')
        @csrf
        @can('update', $post)
            <a class="btn btn-secondary" href="{{ Auth::user()->isAdmin() ? route('admin.post.edit', $post) : route('posts.edit', $post) }}">Изменить</a>
        @endcan
        @can('delete', $post)
            <button class="btn btn-danger" type="submit">Удалить</button>
        @endcan
        <a href="{{ route('posts.index') }}">Венуться к списку статей</a>
    </form>
@endsection
