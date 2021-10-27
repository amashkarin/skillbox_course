@extends('layout.master')
@section('content')

<div class="container">
    @if($tag->posts->isNotEmpty())
        <h2>Статьи</h2>
        @include('posts.list', ['posts' => $tag->posts])
        <hr>
    @endif
    @if($tag->news->isNotEmpty())
        <h2>Новости</h2>
        @include('news.list', ['news' => $tag->news])
        <hr>
    @endif
</div>

@endsection
