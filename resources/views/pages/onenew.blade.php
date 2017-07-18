<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <h1 style="font-size:60px">{{ $news->title }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <img src="{{ $news->img }}" alt="" width="100%">
        </div>
        <div class="col-md-9">
            {!! $news->preview !!}
            <a href="/page/news/{{ $news->page_id }}" class="alink">ПОДРОБНЕЕ</a>
        </div>
    </div>
</div>