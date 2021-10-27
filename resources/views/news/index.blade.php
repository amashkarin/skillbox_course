@extends('layout.master')
@section('content')

<div class="container">
    @include('news.list', ['news' => $news])
    {{ $news->links() }}
</div>

@endsection
