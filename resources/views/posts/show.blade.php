@extends('layout.master')
@section('content')
    <div class="mb-2">
        <i>{{ $post->created_at }}</i>
    </div>
    @include('layout.tags', ['tags' => $post->tags])
    {{ $post->body }}
    @include('comments.block', [
        'comments' => $post->comments,
        'formAction' => route('post.comment.add', $post),
    ])
    <hr>
    <h2>История изменений</h2>
    @forelse($post->history as $historyItem)
        <table class="table">
            <thead>
                <tr>
                    <th>Дата изменения</th>
                    <th>Изменения</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $historyItem->timestamp }}</td>
                    <td>
                        @foreach($historyItem->before as $key => $value)
                        {{ $key }}: {{ $value }} => {{ $historyItem->after[$key] }}<br>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
    @empty
        <i class="text-lg-center">Статья ещё не менялась с момента создания</i>
    @endforelse


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
