@extends('layout.master')
@section('content')
    <div class="mb-2">
        <i>{{ $newsItem->updated_at }}</i>
    </div>
    <h1>{{ $newsItem->title }}</h1>
    {{ $newsItem->body }}

    @include('comments.block', [
        'comments' => $newsItem->comments ?? [],
        'formAction' => route('news.comment.add', $newsItem),
    ])
@endsection
