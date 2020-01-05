@extends('layout.master')
@section('content')
    @include('layout.errors')
    <form method="post" action="/posts" enctype="application/x-www-form-urlencoded">
        @csrf
        <div class="form-group">
            <label for="post_slug">Символьный код</label>
            <input name="slug" type="text" class="form-control" id="post_slug" value="{{request('slug')}}">
        </div>
        <div class="form-group">
            <label for="post_title">Название статьи</label>
            <input name="title" type="text" class="form-control" id="post_title" value="{{request('title')}}">
        </div>
        <div class="form-group">
            <label for="post_description">Краткое описание статьи</label>
            <textarea name="description" class="form-control" id="post_description" rows="4">{{request('description')}}</textarea>
        </div>
        <div class="form-group">
            <label for="post_body">Детальное описание</label>
            <textarea name="body" class="form-control" id="post_body" rows="10">{{request('body')}}</textarea>
        </div>
        <div class="form-group form-check">
            <input name="published" type="checkbox" class="form-check-input" id="post_published" value="1"
            {{ request('published') == 1 ? ' checked':''}}>
            <label class="form-check-label" for="post_published">Опубликовано</label>
        </div>
        <button type="submit" class="btn btn-primary">Создать статью</button>
        <a class="btn btn-link" href="/">К списку статей</a>
    </form>
@endsection