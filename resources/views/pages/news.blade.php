<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta content="width=device-width,initial-scale=1" name="viewport">
    <meta name="resource-type" content="Document" />
    <meta name="title" content="Мероприятия">
    <meta name="keywords" content="новости,мероприятия">
    <meta name="description" content="Новости">
    <title>Мероприятия</title>
    <?php $prefix = ''; ?>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.css" rel="stylesheet">
    {{-- <link rel="icon" href="img/favicon_3.ico"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/6.0.2/jquery.mmenu.all.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/css/lightbox.css" rel="stylesheet">
    <link href="{{ $prefix }}/css/common.css" rel="stylesheet">
    <link href="{{ $prefix }}/img/favicon.ico" rel="favicon">
    <link rel="stylesheet" href="/css/plyazh.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;amp;subset=cyrillic-ext"
          rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/6.0.2/jquery.mmenu.all.min.js"></script>
    <script src="https://plyazhspb.ru/js/jquery.collagePlus.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/js/lightbox.js"></script>
    <base href="{{ $prefix }}/page/">
    <style>
        .container h1 {
            font-family: Bebas Neue;
        }

        .news {
            margin-bottom: 10px;
            border: 1px solid #d8d8d8;
            padding-bottom: 15px;
        }

        .news h1 {
            margin-bottom: 20px;
        }

        .date-block {
            background-color: #005f85;
            color: #fff;
            padding: 10px 0;
            width: 85px;
            position: absolute;
        }

        .date-block > span {
            display: block;
            color: #fff;
            font-family: Roboto;
            text-align: center;
        }

        .date-block > span:first-child {
            font-size: 30px;
            font-weight: 500;
        }

        .date-block > span:last-child {
            font-weight: 300;
        }

        p {
            font-size: 18px;
        }

        .alink {
            /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#ff8e4f+0,ef6101+100 */
            background: #ff8e4f;
            /* Old browsers */
            background: -moz-linear-gradient(top, #ff8e4f 0%, #ef6101 100%);
            /* FF3.6-15 */
            background: -webkit-linear-gradient(top, #ff8e4f 0%, #ef6101 100%);
            /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(to bottom, #ff8e4f 0%, #ef6101 100%);
            /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            /* IE6-9 */
            font-size: 22px;
            color: #fff;
            font-weight: 600;
            font-family: Roboto;
            border: 0;
            text-transform: uppercase;
            text-decoration: none;
            padding: 10px 40px;
            border-radius: 12px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.32);
            transition: 0.3s;
            outline: 0;
        }

        .alink:hover {
            box-shadow: none;
        }

        .alink:active {
            box-shadow: inset 0px 2px 4px 1px rgba(0, 0, 0, 0.72);
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
                                    <li class="active">Информация</li>
                                    <li class="active">Мероприятия</li>
                                </ol>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12"><h1>МЕРОПРИЯТИЯ</h1></div>
                        </div>
                        <div class="row">
                            <div class="row news">
                                @foreach($news as $new)
                                    {!! $new !!}
                                @endforeach
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