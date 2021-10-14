@extends('layout.without_aside')
@section('content')
    <div class="container">
        <table class="table table-hover">
            <thead class="">
            <tr>
                <th>Создана</th>
                <th>Изменена</th>
                <th>Название</th>
                <th>Опубликовано</th>
                <th>Автор</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->published ? 'Да' : 'Нет' }}</td>
                    <td>{{ $post->owner->name }}</td>
                    <td>
                        <a href="{{ route('admin.post.edit', $post->getRouteKey()) }}" class="btn btn-primary">Изменить</a>
                        <a href="{{ $post->published ? route('admin.post.unpublish', $post->getRouteKey()) : route('admin.post.publish', $post->getRouteKey()) }}" class="btn btn-outline-info">{{ $post->published ? 'Снять с публикации' : 'Опубликовать' }}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
