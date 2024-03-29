@php
    $tags = $tags ?? collect();
@endphp
@if ($tags->isNotEmpty())
    <div class="mt-2 mb-2">
        @foreach($tags as $tag)
            <a class="badge badge-warning" href="{{ route('tags.show', $tag) }}">{{$tag->name}}</a>
        @endforeach
    </div>
@endif
