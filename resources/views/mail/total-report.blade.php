@component('mail::message')
# Отчет "Итого"

@foreach($reportRows as $row)
## {{ $row['title'] }}: {{ $row['value'] }}
@endforeach

Thanks,<br>
{{ config('app.name') }}
@endcomponent
