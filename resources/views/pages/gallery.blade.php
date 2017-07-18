<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="resource-type" content="Document" />
    <meta content="width=device-width,initial-scale=1" name="viewport">
    <meta name="title" content="{{ $page->meta_title }}">
    <meta name="keywords" content="{{ $page->meta_keywords }}">
    <meta name="description" content="{{ $page->meta_description }}">
    <title>{{ $page->title }}</title>
    <?php $prefix = ''; ?>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="/img/favicon.ico">
    <link rel="stylesheet" href="/css/plyazh.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <script type="text/javascript" src="js/jquery.maphilight.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/6.0.2/jquery.mmenu.all.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/css/lightbox.css" rel="stylesheet">
    <link href="{{ $prefix }}/css/common.css" rel="stylesheet">
    <link href="//cdn.materialdesignicons.com/1.9.32/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;amp;subset=cyrillic-ext"
          rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/6.0.2/jquery.mmenu.all.min.js"></script>
    <script src="http://plyazhspb.ru/js/jquery.collagePlus.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/js/lightbox.js"></script>
    <base href="{{ $prefix }}/page/">
    <style>
        .swiper-container {
            width: 100%;
            height: 300px;
            margin-left: auto;
            margin-right: auto;
        }

        .swiper-slide {
            background-size: cover;
            background-position: center;
        }

        .gallery-top {
            height: 528px;
            width: 100%;
        }

        .gallery-top img {
            cursor: zoom-in;
        }

        .gallery-thumbs {
            height: 139px;
            box-sizing: border-box;
            padding: 10px 0;
        }

        .gallery-thumbs .swiper-slide {
            width: 25%;
            height: 100%;
            opacity: 0.4;
        }

        .gallery-thumbs .swiper-slide-active {
            opacity: 1;
        }
    </style>
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
                                    @if(Request::path() == "page/gallery")
                                    <li class="active">Галерея</li>
                                    @else
                                        <li class="active"><a href="/page/gallery">Галерея</a></li>
                                        <li class="active">{{ $album_name }}</li>
                                    @endif
                                </ol>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h1 style="color: #2788d2">Галерея</h1>

                                @foreach($sl as $s)

                                    <div class="back-clear" style="height: 260px; float: left; margin-bottom: 40px">
                                        <div class="col-md-6 story-image-box img_gallery" style="height: 260px;">
                                            <a href="/page/gallery/{{ $s->id }}">
                                                <img src="{{ $s->img }}" class="transform_img" alt="" height="260px">
                                            <h4>{{ $s->album_name }}</h4>
                                            </a>
                                        </div>
                                    </div>

                                @endforeach

                                {!! $page->content !!}

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        @include('pages.footer')
    </div>
</div>

<script>
    $(document).ready(function () {
        // $('#album_two').click(function() {
        //     $.ajax({
        //         url: 'gallery',
        //         type: 'post',
        //         data: 'album=album_one',
        //         cache: false,
        //         success: function() {
        //             alert( "Прибыли данные");
        //         }
        //     });
        // });

        var galleryTop = new Swiper('.gallery-top', {
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',
            spaceBetween: 10,
            height: 528
        });
        var galleryThumbs = new Swiper('.gallery-thumbs', {
            spaceBetween: 10,
            centeredSlides: true,
            slidesPerView: 'auto',
            touchRatio: 0.2,
            slideToClickedSlide: true
        });
        galleryTop.params.control = galleryThumbs;
        galleryThumbs.params.control = galleryTop;

    });
</script>
</body>
</html>