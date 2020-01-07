@extends('layout.master')
@section('content')
    @include('layout.errors')
    <form method="post" action="/posts/{{$post->getRouteKey()}}" enctype="application/x-www-form-urlencoded">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="post_slug">Символьный код</label>
            <input name="slug" type="text" class="form-control" id="post_slug" value="{{old('slug', $post->slug)}}">
        </div>
        <div class="form-group">
            <label for="post_title">Название статьи</label>
            <input name="title" type="text" class="form-control" id="post_title" value="{{old('title', $post->title)}}">
        </div>
        <div class="form-group">
            <label for="post_description">Краткое описание статьи</label>
            <textarea name="description" class="form-control" id="post_description" rows="4">{{old('description', $post->description)}}</textarea>
        </div>
        <div class="form-group">
            <label for="post_body">Детальное описание</label>
            <textarea name="body" class="form-control" id="post_body" rows="10">{{old('body', $post->body)}}</textarea>
        </div>
        <div class="form-group">
            <label for="post_tags">Теги</label>
            <input type="text" name="tags" class="form-control" id="post_tags" value="{{old('tags', $post->tags->pluck('name')->implode(','))}}">
        </div>
        <div class="form-group form-check">
            <input name="published" type="checkbox" class="form-check-input" id="post_published" value="1"
            {{ old('published', $post->published) == 1 ? ' checked' : '' }}>
            <label class="form-check-label" for="post_published">Опубликовано</label>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="/posts/{{$post->getRouteKey()}}" class="btn btn-outline-primary">Отмена</a>
    </form>
@endsection