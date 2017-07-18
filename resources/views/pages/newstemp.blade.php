<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width,initial-scale=1" name="viewport">
    <meta name="title" content="{{ $news->meta_title }}">
    <meta name="keywords" content="{{ $news->meta_keywords }}">
    <meta name="description" content="{{ $news->meta_description }}">
    <title>{{ $news->title }}</title>
    <?php $prefix = ''; ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.css" rel="stylesheet">
    <link href="//cdn.materialdesignicons.com/1.9.32/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/6.0.2/jquery.mmenu.all.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/css/lightbox.css" rel="stylesheet">
    <link href="{{ $prefix }}/css/common.css" rel="stylesheet">
    <link rel="icon" href="/img/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;amp;subset=cyrillic-ext"
          rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/6.0.2/jquery.mmenu.all.min.js"></script>
    <script src="https://plyazhspb.ru/js/jquery.collagePlus.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/js/lightbox.js"></script>
    <base href="{{ $prefix }}/page/">
</head>
<body>
<div>
    <div>
        <div id="wrap">
            @include('pages.header')
            <main>
                <div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <ol class="breadcrumb">
                                    <li><a href="{{ $prefix }}/">Главная</a></li>
                                    <li class="active">Информация</li>
                                    <li><a href="{{ $prefix }}/page/news">Мероприятия</a></li>
                                    <li class="active">{{ $news->title }}</li>
                                </ol>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12"><h1>{{ $news->title }}</h1></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <img src="{{ $news->img }}" alt="" width="100%">
                            </div>
                            <div class="col-md-9">
                                {!! $news->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        @include('pages.footer')
    </div>
</div>
</body>
</html>