@extends('layout.master')
@section('content')
    @include('layout.errors')
    <form method="post" action="{{ route('news.item.update', $newsItem) }}" enctype="application/x-www-form-urlencoded">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="post_slug">Символьный код</label>
            <input name="slug" type="text" class="form-control" id="post_slug" value="{{old('slug', $newsItem->slug)}}">
        </div>
        <div class="form-group">
            <label for="post_title">Название новости</label>
            <input name="title" type="text" class="form-control" id="post_title" value="{{old('title', $newsItem->title)}}">
        </div>
        <div class="form-group">
            <label for="post_body">Текст новости</label>
            <textarea name="body" class="form-control" id="post_body" rows="10">{{old('body', $newsItem->body)}}</textarea>
        </div>
        <div class="form-group form-check">
            <input name="published" type="checkbox" class="form-check-input" id="post_published" value="1"
            {{ old('published', $newsItem->published) == 1 ? ' checked' : '' }}>
            <label class="form-check-label" for="post_published">Опубликовано</label>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="{{ route('admin.news') }}" class="btn btn-outline-primary">Отмена</a>
    </form>
@endsection
