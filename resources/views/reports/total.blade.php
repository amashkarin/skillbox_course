@extends('layout.without_aside')
@section('content')
    <p>Отметьте необходимые чекбоксы для формирования отчета</p>
    @include('layout.errors')
    <form method="post" action="{{ route('admin.reports.total.create') }}">
        @csrf
        @foreach($entities as $key => $entity)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="{{ $key }}" id="{{ $key }}_check" name="entities[]">
            <label class="form-check-label" for="{{ $key }}_check">
                {{ $entity['checkboxTitle'] }}
            </label>
        </div>
        @endforeach
        <div class="mt-3 mb-3">
            <button type="submit" class="btn btn-primary">Сгенерировать отчёт</button>
        </div>
    </form>
@endsection
