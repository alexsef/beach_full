<!DOCTYPE html>
<html ng-app="beach">

<head>
    <title>Наши тренеры</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="js/jquery.maphilight.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/plyazh.css">
    <link rel="stylesheet" type="text/css" href="/css/materialdesignicons.css">
    <link rel="stylesheet" type="text/css" href="css/datepicker/bootstrap-datepicker3.css">
    <script type="text/javascript" src="js/angular.js"></script>
    <script type="text/javascript" src="js/angular-animate.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
    <script type="text/javascript" src="js/datepicker/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.js"></script>
    <link href="/css/common.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic" rel="stylesheet">

    <link href="/css/lightbox.css" rel="stylesheet">
    <script src="/js/lightbox.js"></script>

    <!--[if IE]>
    <link rel="shortcut icon" href="img/favicon_3.ico"><![endif]-->
    <link rel="icon" href="/img/favicon.ico">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/6.0.2/jquery.mmenu.all.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/6.0.2/jquery.mmenu.all.min.js"></script>
</head>


@include('pages.header')

<div class="container">
    <div class="row padd">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="train-h3">Кашкаров Александр Александрович</div>
                <div class="train-small">(Волейбол)</div>
            </div>
        </div>
        <div class="col-sm-3 col-xs-12">
            <div class="photo-train">
                <img src="img/trainer.jpg" alt="" class="img-train img-responsive img-circle">
            </div>
        </div>
        <div class="col-sm-9 col-xs-12">
            <h3 class="train-header">Биография</h3>
            <p>Закончил Педагогический колледж номер 1 им. Некрасова, отделение адаптивной физической культуры</p>
            <p>Выпускник ДЮСШ Красносельского района</p>
            <p>Призер чемпионата города среди юношей 95-96 года
            1 место на чемпионате города среди мужчин в составе волейбольного клуба "Экран"</p>
            <p>КМС по классическому волейболу</p>
        </div>
    </div>




    <div class="row padd">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="train-h3">Шелудько Максим Эдуардович</div>
                <div class="train-small">(Волейбол)</div>
            </div>
        </div>
        <div class="col-sm-3 col-xs-12">
            <div class="photo-train">
                <img src="img/sheludko.jpg" alt="" class="img-train img-responsive img-circle">
            </div>
        </div>
        <div class="col-sm-9 col-xs-12">
            <h3 class="train-header">Биография</h3>
            <p>Студент 4 курса НГУ им П.Ф. Лесгафта, специализация волейбол.</p>
            <p>Выпускник ГДЮЦФКиС Кировского района.</p>
            <p>Призёр первенства города среди юношей 2012/2013</p>
            <p>1 место СЗАО среди юношей 2013/2014</p>
            <p>Участник всероссийской Универсиады среди команд ВУЗов 2015/16</p>
            <p>1 место чемпионата ВУЗов 2015/16</p>
            <p>1 место чемпионата среди любительский команд Суперлиги 2015/2017</p>
            <p>1 место чемпионата ВУЗов 2016/17</p>
        </div>
    </div>
    <!-- <div class="row padd">
        <h3 class="train-header">Цены</h3>
        <div class="price-sm" id="first-price-sm">
            <div class="rotate-text">Абонимент 1</div>
            <ul class="absolute-ul">
                <li>Lorem ipsum dolor sit amet, consectetur</li>
                <li>ipsum dolor sit amet, consectetur</li>
                <li> nostrud exercitation ullamco laboris </li>
            </ul>
            <div class="absolute-hr"></div>
            <div class="price-absolute">3500 руб.</div>
        </div>
        <div class="price-sm" id="second-price-sm">
            <div class="rotate-text">Абонимент 2</div>
            <ul class="absolute-ul">
                <li>Lorem ipsum dolor sit amet, consectetur</li>
                <li>ipsum dolor sit amet, consectetur</li>
                <li> nostrud exercitation ullamco laboris </li>
            </ul>
            <div class="absolute-hr"></div>
            <div class="price-absolute">8200 руб.</div>
        </div>
        <div class="price-sm" id="third-price-sm">
            <div class="rotate-text">Абонимент 3</div>
            <ul class="absolute-ul">
                <li>Lorem ipsum dolor sit amet, consectetur</li>
                <li>ipsum dolor sit amet, consectetur</li>
                <li> nostrud exercitation ullamco laboris </li>
            </ul>
            <div class="absolute-hr"></div>
            <div class="price-absolute">12000 руб.</div>
        </div>
    </div> -->
    {{-- <div class="row">
        <div style="margin-bottom: 20px; color: #2486cb; margin-top: 100px">
            <h3>Расписание</h3>
        </div>
        <table class="table table-responsive" style="margin-bottom: 400px;">
            <thead>
                <tr>
                    <th>Понедельник</th>
                    <th>Вторник</th>
                    <th>Среда</th>
                    <th>Четверг</th>
                    <th>Пятница</th>
                    <th>Суббота</th>
                    <th>Воскресение</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>12:00-15:00</td>
                    <td>16:00-19-30</td>
                    <td>09:30-12:00</td>
                    <td>11:00-14:30</td>
                    <td>12:00-15:00</td>
                    <td>10:00-13:30</td>
                    <td style="color: #ffaf00" rowspan="2">Выходной</td>
                </tr>
                <tr>
                    <td>16:00-19:00</td>
                    <td></td>
                    <td>13:00-16:00</td>
                    <td>15:30-18:00</td>
                    <td>18:00-20:00</td>
                    <td>15:00-19:00</td>
                </tr>
            </tbody>
        </table>
    </div> --}}
</div>



<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

@include('pages.footer')

