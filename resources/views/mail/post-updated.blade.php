@component('mail::message')
# Статья "{{$post->title}}" обновлена

{{$post->description}}

@component('mail::button', ['url' => '/posts/' . $post->getRouteKey()])
Посмотреть
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
