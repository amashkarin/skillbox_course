@extends('layout.master')
@section('content')
    <div class="mb-2">
        <i>{{ $post->created_at }}</i>
    </div>
    {{ $post->body }}
    <hr>
    <form action="/posts/{{$post->getRouteKey()}}" method="post">
        @method('DELETE')
        @csrf
        <a class="btn btn-secondary" href="/posts/{{$post->getRouteKey()}}/edit">Изменить</a>
        <button class="btn btn-danger" type="submit">Удалить</button>
        <a href="/">Венуться к списку статей</a>
    </form>
@endsection