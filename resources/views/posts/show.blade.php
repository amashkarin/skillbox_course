@extends('layout.master')
@section('content')
    <div class="mb-2">
        <i>{{ $post->created_at }}</i>
    </div>
    {{ $post->body }}
    <hr>
    <a href="/">Венуться к списку статей</a>
@endsection