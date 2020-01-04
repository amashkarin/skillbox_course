@extends('layout.master')
@section('content')

    <p>Статичный текст</p>

    @include('layout.errors')
    <form method="post" action="/contacts" enctype="application/x-www-form-urlencoded">
        @csrf
        <div class="form-group">
            <label for="contact_email">Email</label>
            <input name="email" type="email" class="form-control" id="contact_email" placeholder="Введите email">
        </div>
        <div class="form-group">
            <label for="contact_message">Сообщение</label>
            <textarea name="message" class="form-control" id="contact_message" placeholder="Введите сообщение"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
@endsection