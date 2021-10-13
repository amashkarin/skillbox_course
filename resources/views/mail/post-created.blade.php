@component('mail::message')
# Создана новая статья "{{$post->title}}"

{{$post->description}}

@component('mail::button', ['url' => '/posts/' . $post->getRouteKey()])
Посмотреть
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
