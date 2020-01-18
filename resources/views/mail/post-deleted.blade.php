@component('mail::message')
# Статья "{{$post->title}}" удалена

Thanks,<br>
{{ config('app.name') }}
@endcomponent
