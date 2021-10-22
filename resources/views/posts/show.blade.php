@extends('layout.master')
@section('content')
    <div class="mb-2">
        <i>{{ $post->created_at }}</i>
    </div>
    @include('layout.tags', ['tags' => $post->tags])
    {{ $post->body }}
    <hr>
    <h2>Коментарии</h2>
    @forelse($comments as $comment)
        <p class="text-light bg-dark p-3">
            <i>[{{ $comment->created_at }}]</i> <span class="font-weight-bold">{{ $comment->owner->name }}</span>
            <br> {{ $comment->body }}</p>
    @empty
        <p class="text-light bg-dark p-3">Для данной статьи ещё нет ни одного коментария</p>
    @endforelse

    <form method="post" action="{{ route('post.comment.add', $post) }}">
        @csrf
        <div class="form-group">
            <textarea name="body" class="form-control" placeholder="Введите текст"></textarea>
        </div>
        <button class="btn btn-primary" type="submit">Оставить коментарий</button>
    </form>

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
