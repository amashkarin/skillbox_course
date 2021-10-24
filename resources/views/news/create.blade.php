@extends('layout.master')
@section('content')
    @include('layout.errors')
    <form method="post" action="{{ route('news.item.create') }}" enctype="application/x-www-form-urlencoded">
        @csrf
        <div class="form-group">
            <label for="post_slug">Символьный код</label>
            <input name="slug" type="text" class="form-control" id="post_slug" value="{{old('slug', request('slug'))}}">
        </div>
        <div class="form-group">
            <label for="post_title">Название новости</label>
            <input name="title" type="text" class="form-control" id="post_title" value="{{old('title', request('title'))}}">
        </div>
        <div class="form-group">
            <label for="post_body">Текст новости</label>
            <textarea name="body" class="form-control" id="post_body" rows="10">{{old('body', request('body'))}}</textarea>
        </div>
        <div class="form-group form-check">
            <input name="published" type="checkbox" class="form-check-input" id="post_published" value="1"
            {{ old('published', request('published')) == 1 ? ' checked':''}}>
            <label class="form-check-label" for="post_published">Опубликовано</label>
        </div>
        <button type="submit" class="btn btn-primary">Создать новость</button>
        <a class="btn btn-link" href="{{ route('admin.news') }}">Назад</a>
    </form>
@endsection
