@foreach($news as $newsItem)
    <div class="row mb-2">
        <div class="col-sm-12">
            <div class="card flex-md-row mb-4 shadow-sm">
                <div class="card-body d-flex flex-column align-items-start">
                    <div class="mb-1 text-muted">{{ $newsItem->updated_at }}</div>
                    <h3 class="mb-0">
                        <a class="text-dark" href="{{ route('news.item', $newsItem) }}">{{ $newsItem->title }}</a>
                    </h3>
                    @include('layout.tags', ['tags' => $newsItem->tags])
                </div>
            </div>
        </div>
    </div>
@endforeach

