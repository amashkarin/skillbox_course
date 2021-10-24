<hr>
<h2>Комментарии</h2>
@forelse($comments as $comment)
    <p class="text-light bg-dark p-3">
        <i>[{{ $comment->created_at }}]</i> <span class="font-weight-bold">{{ $comment->owner->name }}</span>
        <br> {{ $comment->body }}</p>
@empty
    <p class="text-light bg-dark p-3">Здесь ещё нет ни одного комментария</p>
@endforelse

<form method="post" action="{{ $formAction }}">
    @csrf
    <div class="form-group">
        <textarea name="body" class="form-control" placeholder="Введите текст"></textarea>
    </div>
    <button class="btn btn-primary" type="submit">Оставить комментарий</button>
</form>
