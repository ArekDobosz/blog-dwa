@if ($latestArticles)
<div class="row mb-2">
  @foreach ($latestArticles as $article)
  <div class="col-md-6">
    <div class="card flex-md-row mb-4 shadow-sm h-md-250">
      <div class="card-body d-flex flex-column align-items-start">
        <strong class="d-inline-block mb-2 text-primary">{{ $article->getCategoryName() }}</strong>
        <h3 class="mb-0">
          <a class="text-dark latest-title" href="{{ route('show-article', $article->slug) }}">
            {{ str_limit($article->title, 30) }}
          </a>
        </h3>
        <div class="mb-1 text-muted">{{ $article->getPublishedDate() }}</div>
          <p class="card-text mb-auto">{!! $article->getShortContent(100) !!}</p>
          <a href="{{ route('show-article', $article->slug) }}">czytaj dalej</a>
      </div>
      <div class="latest-thumbnail" style="background-image: url({{ $article->thumbnail }});"></div>
    </div>
  </div>
  @endforeach
</div>
@endif