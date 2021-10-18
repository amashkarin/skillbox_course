@component('mail::message')
# Дайджест статей

@foreach($posts as $post)
## [{{ $post->created_at }}] [{{ $post->title }}]({{ route('posts.show', $post) }})

{{ $post->description }}

@endforeach

[Посмотреть все статьи]({{ route('posts.index') }})

Thanks,<br>
{{ config('app.name') }}
@endcomponent
