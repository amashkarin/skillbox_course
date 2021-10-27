@extends('layout.without_aside')
@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Показатель</th>
                <th>Значение</th>
            </tr>
        </thead>
        @foreach($statistic as $statisticItem)
            <tr>
                <td>{{ $statisticItem['title'] }}</td>
                <td>{!! $statisticItem['value'] !!}</td>
            </tr>
        @endforeach
    </table>
@endsection
