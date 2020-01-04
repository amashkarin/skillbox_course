@extends('layout.master')
@section('content')

    <table class="table">
        <tr>
            <th>Дата создания</th>
            <th>Email</th>
            <th>Сообщение</th>
        </tr>
    @foreach($results as $result)
        <tr>
            <td>{{ $result->created_at }}</td>
            <td>{{ $result->email }}</td>
            <td>{{ $result->message }}</td>
        </tr>
    @endforeach
    </table>

@endsection