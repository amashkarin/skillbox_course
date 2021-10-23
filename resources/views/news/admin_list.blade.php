@extends('layout.without_aside')
@section('content')
    <div class="container">
        <a href="{{ route('news.item.create') }}" class="btn btn-primary">Создать новость</a>
        <table class="table table-hover">
            <thead class="">
            <tr>
                <th>Создана</th>
                <th>Изменена</th>
                <th>Название</th>
                <th>Опубликовано</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($news as $newsItem)
                <tr>
                    <td>{{ $newsItem->created_at }}</td>
                    <td>{{ $newsItem->updated_at }}</td>
                    <td>{{ $newsItem->title }}</td>
                    <td>{{ $newsItem->published ? 'Да' : 'Нет' }}</td>
                    <td>
                        <a href="{{ route('news.item.edit', $newsItem) }}" class="btn btn-primary">Изменить</a>
                        <form method="post" action="{{ route('news.item.destroy', $newsItem) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $news->links() }}
    </div>
@endsection
