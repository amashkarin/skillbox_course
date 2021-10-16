@extends('layout.without_aside')
@section('content')
    <ul>
    @foreach($routes as $route)
        <li><a href="{{ $route['url'] }}">{{ $route['title'] }}</a> </li>
    @endforeach
    </ul>
@endsection
