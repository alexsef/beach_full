<!DOCTYPE html>
<html ng-app="beach">

<head>
    <title>ЦПС "ПЛЯЖ" - центр пляжного спорта, спортивный комплекс пляжных видов спорта</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="Центр пляжного спорта Пляж. Отличное расположение, бесплатные маршрутки от метро, у ТЦ 'РИО' и огромная парковка. Адрес ЦПС 'ПЛЯЖ' - ул. Фучика д.2, телефон 8 (812) 911-70-77">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.maphilight.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/plyazh.css">
    <link rel="stylesheet" type="text/css" href="/css/materialdesignicons.css">
    <link rel="stylesheet" type="text/css" href="css/datepicker/bootstrap-datepicker3.css">
    <script type="text/javascript" src="js/angular.js"></script>
    <script type="text/javascript" src="js/angular-animate.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
    <link href="/css/common.css" rel="stylesheet">
    <script type="text/javascript" src="js/datepicker/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic" rel="stylesheet">

    <link href="/css/lightbox.css" rel="stylesheet">
    <script src="/js/lightbox.js"></script>

    <link rel="stylesheet" href="/css/slicknav.css" />
    <script src="/js/nav/dist/jquery.slicknav.min.js"></script>

    <!--[if IE]>
    <link rel="shortcut icon" href="img/favicon_3.ico"><![endif]-->
    <link rel="icon" href="img/favicon.ico">
</head>

<body ng-controller="Main">
    <div class="blur-content">
        <!-- МЕНЮ -->
        <div class="container-fluid header-fluid">
            <div class="container">
                <div class="col-xs-2">
                    <a class="navbar-brand" href="/"><img src="img/logo.png"></a>
                </div>
                <div class="col-xs-10">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <div class="slicknav_menu">
                                    <a href="#" aria-haspopup="true" role="button" tabindex="0" class="navbar-toggle collapsed slicknav_btn slicknav_collapsed">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </a>

                                </div>
                            </div>

                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <div class="addr-head"> 
                                        <i class="fa fa-map-marker" aria-hidden="true" style="color: black;"></i>
                                            Санкт-Петербург, улица Фучика, 2А
                                    </div>
                                    <div class="phn-head">
                                        <div class="phn-phn">8 (812) 911-70-77 &nbsp;</div>      <i class="fa fa-clock-o" aria-hidden="true" style="color: black;"></i> с 10:00 до 23:00
                                    </div>
                                    <div class="auth-head">
                                        @if(Auth::check())
                                            <a href="https://lk.plyazhspb.ru/">Личный кабинет</a>
                                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выход
                                                <form id="logout-form" action="/logout" method="POST"
                                                          style="display: none;">
                                                        <%% csrf_field() %%>
                                                </form>
                                            </a>
                                            @else
                                            <a onclick="openAuthModal('auth')" style="cursor: pointer;">Вход</a>
                                            <a onclick="openAuthModal('reg')" style="cursor: pointer;">Регистрация</a>
                                        @endif
                                    </div>
                                    <li><a class="
                                    @if(Request::path() == "/")
                                        blue-head
                                    @endif
                                    " href="/">Главная<span class="
                                    sr-only">(current)</span></a></li>
                                    <li class="">
                                        <a id="dLabel" data-target="#" href="#" class="dropdown-toggle dropdown-menu_title" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Виды спорта <span class="caret"></span></a>
                                        <ul class="dropdown-menu drop-sports" aria-labelledby="dLabel">
                                            <li><a href="/page/volleyball">Волейбол</a></li>
                                            <li><a href="/page/football">Футбол</a></li>
                                            <li><a href="/page/tennis">Теннис</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="/page/prices">Цены</a></li>
                                    <li><a id="dLabel" data-target="#" href="#"
                                           class="
                                            @if(Request::path() == "page/" or
                                                Request::path() == "page/" or
                                                Request::path() == "page/" or
                                                Request::path() == "page/")
                                                blue-head
                                            @endif
                                           dropdown-toggle dropdown-menu_title"
                                           data-toggle="dropdown" role="button" aria-haspopup="true"
                                           aria-expanded="false">Секции
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu drop-sports" aria-labelledby="dLabel">
                                            <li><a href="{{ $prefix }}/page/childrens_sections">Детские секции</a></li>
                                            <li><a href="{{ $prefix }}/page/adult_sections">Взрослые секции</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#" class="dropdown-toggle dropdown-menu_title" data-toggle="dropdown">Предложения
                                        <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="/page/forbusiness">Для бизнеса</a></li>
                                            <li><a href="/page/forsport">Для спорта</a></li>
                                            <li><a href="/page/children_holidays">Детские праздники</a></li>
                                        </ul>
                                    </li>
                                    <li class="">
                                        <a href="#" class="dropdown-toggle dropdown-menu_title" data-toggle="dropdown">Информация
                                        <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="/page/about">О комплексе</a></li>
                                            <li><a href="/page/gallery">Галерея</a></li>
                                            <li><a href="/page/our_trainers">Наши тренеры</a></li>
                                            <li><a href="/page/news">Мероприятия</a></li>
                                            <li><a href="/page/partnership">Сотрудничество</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="/page/contacts">Контакты</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <img src="img/ball_1.png" class="ball">

        </div>

        <!-- МОБИЛЬНОЕ МЕНЮ -->
        <ul id="menu" style="display: none">
            <li><a href="/">Главная</a></li>
            <li>Виды спорта
                <ul>
                    <li><a href="page/volleyball">Волейбол</a></li>
                    <li><a href="page/football">Футбол</a></li>
                    <li><a href="page/tennis">Тенис</a></li>
                </ul>
            </li>
            <li><a class="scroll" href="page/prices">Цены</a></li>
            <li>Секции
                <ul>
                    <li><a href="page/childrens_sections">Детские секции</a></li>
                    <li><a href="page/adult_sections">Взрослые секции</a></li>
                </ul>
            </li>
            <li>Предложения
                <ul>
                    <li><a href="page/forbusiness">Для бизнеса</a></li>
                    <li><a href="page/forsport">Для спорта</a></li>
                    <li><a href="page/children_holidays">Детские праздники</a></li>
                </ul>
            </li>
            <li>Информация
                <ul>
                    <li><a href="page/about">О комплексе</a></li>
                    <li><a href="page/gallery">Галерея</a></li>
                    <li><a href="page/our_trainers">Наши тренеры</a></li>
                    <li><a href="page/news">Мероприятия</a></li>
                    <li><a href="page/partnership">Сотрудничество</a></li>
                </ul>
            </li>
            <li><a href="page/contacts">Контакты</a></li>
            <li>@if(Auth::check())
                <a href="https://lk.plyazhspb.ru/">Личный кабинет</a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выход
                    <form id="logout-form" action="/logout" method="POST"
                              style="display: none;">
                            <%% csrf_field() %%>
                    </form>
                </a>
                @else
                <a onclick="openAuthModal('auth')" style="cursor: pointer;">Вход</a>
                <a onclick="openAuthModal('reg')" style="cursor: pointer;">Регистрация</a>
            @endif</li>
        </ul>

        <script>
            $(function(){
                $('#menu').slicknav({
                    label: 'ЦПС "ПЛЯЖ"',
                    duration: 300,
                });
            });
        </script>
    

        <!-- КАРУСЕЛЬ -->
        <div class="container-fluid" style="position: relative;">
            <div class="row">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="4"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="5"></li>
                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="img/carousel/bg5.png" alt="...">
                            <div class="carousel-caption">
                                <div class="carousel-caption">
                                    <img src="img/carousel/banner5.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <img src="img/carousel/bg4.png" alt="...">
                            <div class="carousel-caption">
                                <div class="carousel-caption">
                                    <img src="img/carousel/banner4.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <img src="img/carousel/bg3.png" alt="...">
                            <div class="carousel-caption">
                                <div class="carousel-caption">
                                    <img src="img/carousel/banner3.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <img src="img/carousel/bg2.png" alt="...">
                            <div class="carousel-caption">
                                <div class="carousel-caption">
                                    <img src="img/carousel/banner2.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <img src="img/carousel/bg.png" alt="...">
                            <div class="carousel-caption">
                                <div class="carousel-caption">
                                    <img src="img/carousel/banner.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <img src="img/banner_bg_3.png" alt="...">
                            <div class="carousel-caption">
                                <div class="carousel-caption">
                                    <img src="img/banner3.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img src="img/decoration_up.png" class="decoration-up" alt="">
            <img src="img/decoration_down.png" class="decoration-down" alt="">
            <!--<img src="img/decoration.png" width="100%" class="decoration">-->
            <div class="sale-box">
                <a href="#">
                    <!--<img src="/img/sale.png" class="sale-img" alt="">-->
                </a>
            </div>
        </div>


        <!-- НОВОСТИ  -->
        


        <!-- БРОНИРОВАНИЕ ПОЛЯ НА МОБИЛЬНЫХ -->
        <div class="container book">
            <div class="row book-head">
                <div class="col-xs-12">
                    <h3 style="font-size: 32px">Забронировать площадку</h3>
                </div>
            </div>
            <div class="row book-buttons">
                <div class="col-xs-4">
                    <div class="book-sport" ng-click="openMobile('football')">
                        <img src="img/football_tag_on.png">
                        <p>Футбол</p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="book-sport" ng-click="openMobile('volleyball')">
                        <img src="img/volleyball_tag_on.png">
                        <p>Волейбол</p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="book-sport" ng-click="openMobile('tennis')">
                        <img src="img/tennisl_tag_on.png">
                        <p>Теннис</p>
                    </div>
                </div>
            </div>
            <div class="row book-or">
                <div class="col-xs-5"></div>
                <div class="col-xs-2">
                    <p>или</p>
                </div>
                <div class="col-xs-5"></div>
            </div>
            <div class="row book-all">
                <div class="col-xs-12">
                    <button class="btn btn-block" ng-click="openMobile()">Забронировать весь комплекс</button>
                </div>
            </div>
        </div>

        <!-- ЗАБРОНИРОВАТЬ ПОЛЕ -->
        <div class="container-fluid reserve">
            <div class="row">
                <h1>Забронировать площадку в ЦПС "Пляж"</h1>
                <div class="check">Схема площадок по видам спорта:</div>
                <a name="resfield"></a>
                <div class="col-md-12 sport">
                    <div class="container">
                        <div class="col-md-12">
                            <ul>
                                <li><a href="" onclick="changeMap('foot')">Футбол</a></li>
                                <li><a href="" onclick="changeMap('voll')">Волейбол</a></li>
                                <li><a href="" onclick="changeMap('tenn')">Теннис</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="container map-field">
                    <div class="map-football">
                        <img src="img/field_1.png" width="100%" usemap="#foot" class="map">
                        <map name="foot" id="foot">
                        <area shape="poly" alt="Футбол №6" title="Футбол №6" coords="183,38,523,38,514,496,82,496" target=""
                              ng-click="openModal('football', 4, 6)" onmouseover="fup('f', 1)"
                              onmouseout="fup('f', 1, 1)"/>
                        <area shape="poly" alt="Волейбол №3" title="Волейбол №3" coords="567,38,793,38,806,128,566,128" target=""
                              ng-click="openModal('volleyball', 1, 3)" onmouseover="fup('v', 1)"
                              onmouseout="fup('v', 1, 1)"/>
                        <area shape="poly" alt="Волейбол №4" title="Волейбол №4" coords="567,186,814,186,829,293,567,293"
                              ng-click="openModal('volleyball', 2, 4)" target="" onmouseover="fup('v', 2)"
                              onmouseout="fup('v', 2, 1)"/>
                        <area shape="poly" alt="Волейбол №5" title="Волейбол №5" coords="568,367,839,367,856,497,568,496"
                              ng-click="openModal('volleyball', 3, 5)" target="" onmouseover="fup('v', 3)"
                              onmouseout="fup('v', 3, 1)"/>
                        <area shape="poly" alt="Теннис №1" title="Теннис №1" coords="836,38,950,38,993,226,866,226"
                              ng-click="openModal('tennis', 6, 1)" target="" onmouseover="fup('t', 1)"
                              onmouseout="fup('t', 1, 1)"/>
                        <area shape="poly" alt="Теннис №2" title="Теннис №2" coords="871,254,999,254,1055,496,910,497"
                              ng-click="openModal('tennis', 7, 2)" target="" onmouseover="fup('t', 2)"
                              onmouseout="fup('t', 2, 1)"/>
                    </map>
                    </div>
                    <div class="map-volleyball">
                        <img src="img/field_2.png" width="100%" usemap="#voll" class="map">
                        <map name="voll" id="voll">
                        <area alt="Волейбол №6,7,8" title="Волейбол №6,7,8" ng-click="openModal('volleyball', 5, 6)" shape="poly"
                              coords="306,38,528,38,526,126,291,127" onmouseover="fup('v', 6)"
                              onmouseout="fup('v', 6, 1)"/>
                        <area alt="Волейбол №6,7,8" title="Волейбол №6,7,8" ng-click="openModal('volleyball', 5, 7)" shape="poly"
                              coords="281,185,524,185,522,291,263,292" onmouseover="fup('v', 5)"
                              onmouseout="fup('v', 5, 1)"/>
                        <area alt="Волейбол №6,7,8" title="Волейбол №6,7,8" ng-click="openModal('volleyball', 5, 8)" shape="poly"
                              coords="250,365,519,365,516,496,229,496" onmouseover="fup('v', 4)"
                              onmouseout="fup('v', 4, 1)"/>
                        <area shape="poly" alt="Волейбол №3" title="Волейбол №3" coords="567,38,793,38,806,128,566,128"
                              ng-click="openModal('volleyball', 1, 3)" target="" onmouseover="fup('v', 1)"
                              onmouseout="fup('v', 1, 1)"/>
                        <area shape="poly" alt="Волейбол №4" title="Волейбол №4" coords="567,186,814,186,829,293,567,293"
                              ng-click="openModal('volleyball', 2, 5)" target="" onmouseover="fup('v', 2)"
                              onmouseout="fup('v', 2, 1)"/>
                        <area shape="poly" alt="Волейбол №5" title="Волейбол №5" coords="568,367,839,367,856,497,568,496"
                              ng-click="openModal('volleyball', 3, 4)" target="" onmouseover="fup('v', 3)"
                              onmouseout="fup('v', 3, 1)"/>
                        <area shape="poly" alt="Теннис №1" title="Теннис №1" coords="836,38,950,38,993,226,866,226"
                              ng-click="openModal('tennis', 6, 1)" target="" onmouseover="fup('t', 1)"
                              onmouseout="fup('t', 1, 1)"/>
                        <area shape="poly" alt="Теннис №2" title="Теннис №2" coords="871,254,999,254,1055,496,910,497"
                              ng-click="openModal('tennis', 7, 2)" target="" onmouseover="fup('t', 2)"
                              onmouseout="fup('t', 2, 1)"/>
                    </map>
                    </div>
                    <div class="pick-field">
                        <div id="f">
                            <img src="img/football_tag_on.png" onmouseover="fup('f', 1)" onmouseout="fup('f', 1, 1)" ng-click="openModal('football', 5)">
                        </div>
                        <div id="v">
                            <img src="img/volleyball_tag_on.png" class="first" ng-click="openModal('volleyball', 0)" onmouseover="fup('v', 1)" onmouseout="fup('v', 1, 1)">
                            <img src="img/volleyball_tag_on.png" class="second" ng-click="openModal('volleyball', 1)" onmouseover="fup('v', 2)" onmouseout="fup('v', 2, 1)">
                            <img src="img/volleyball_tag_on.png" class="third" ng-click="openModal('volleyball', 2)" onmouseover="fup('v', 3)" onmouseout="fup('v', 3, 1)">
                            <img src="img/volleyball_tag_on.png" class="fourth" ng-click="openModal('volleyball', 4)" onmouseover="fup('v', 4)" onmouseout="fup('v', 4, 1)">
                            <img src="img/volleyball_tag_on.png" class="fifth" ng-click="openModal('volleyball', 4)" onmouseover="fup('v', 5)" onmouseout="fup('v', 5, 1)">
                            <img src="img/volleyball_tag_on.png" class="sixth" ng-click="openModal('volleyball', 4)" onmouseover="fup('v', 6)" onmouseout="fup('v', 6, 1)">
                        </div>
                        <div id="t">
                            <img src="img/tennisl_tag_on.png" class="first" ng-click="openModal('tennis', 6, 1)" onmouseover="fup('t', 1)" onmouseout="fup('t', 1, 1)">
                            <img src="img/tennisl_tag_on.png" class="second" ng-click="openModal('tennis', 7, 2)" target="" onmouseover="fup('t', 2)" onmouseout="fup('t', 2, 1)">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 sport">
                    <div class="container">
                        <div class="col-md-12">
                            <span>Для корпоративных клиентов и спортивных команд</span>
                            <button onclick="openCorporateModal()">Продолжить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- КОРПОРАТИВНЫМ КЛИЕНТАМ-->
        <div class="container">
            <div class="row corporate">
                <div class="col-md-12">
                    <h2>Корпоративным клиентам</h2>
                    <button class="btn btn-block" onclick="openCorporateModal()">Продолжить</button>
                </div>
            </div>
            <div class="row corporate-block">
                <div class="col-md-4">
                    <ul>
                        <li>
                            Полное закрытие пляжного центра под ваше мероприятие, без ограничения по времени
                        </li>
                        <li>
                            Организация турниров
                        </li>
                        <li>
                            Приглашенные судьи
                        </li>
                    </ul>
                </div>
                <div class="col-md-offset-4 col-md-4">
                    <ul>
                        <li>Развлекательная программа</li>
                        <li>Музыкальное и световое сопровождение</li>
                        <li>Видео и фотосъемка</li>
                        <li>Площадки для волейбола/тенниса/футбола</li>
                    </ul>
                </div>
                <img src="img/circle1-min.png" class="img-circle hidden-xs hidden-sm hidden-md" alt="">
            </div>
        </div>

        <!-- ВИДЫ СПОРТА -->
        <div class="container kinds" kind-sport>
            <div class="row">
                <div class="col-md-4 kind-item" value="1">
                    <span>ПЛЯЖНЫЙ ФУТБОЛ</span>
                    <img src="/img/football.png" width="100%">
                </div>
                <div class="col-md-4 kind-item" value="2">
                    <span>ПЛЯЖНЫЙ ВОЛЕЙБОЛ</span>
                    <img src="/img/volleyball.png" width="100%">
                </div>
                <div class="col-md-4 kind-item" value="3">
                    <span>ПЛЯЖНЫЙ ТЕННИС</span>
                    <img src="/img/tennis.png" width="100%">
                </div>
            </div>
            <div class="row">
                <div class="services">
                    <h3 style="font-size: 32px">Пляжный футбол</h3>
                    <div>
                        <h2>История</h2>
                        <p>
                            Пляжный футбол зародился в Бразилии и вырос до уровня вида спорта международного значения. Участие в соревнованиях известных спортсменов из большого футбола, таких как француз Эрик Кантона, испанцев Мигель и Хулио Салинаса и бразильцев Ромарио, Жуниора
                            и Зико способствовало расширению телевизионного освещения - пляжный футбол стали показывать в 170 странах мира. Это сделало пляжный футбол одним из самых динамично развивающихся видов спорта в мире и привлекло большое количество
                            рекламы и спонсоров.
                        </p>
                        <div class="kinds-of-sports-buttons">
                            <a href="#">Расписание</a>
                            <a href="/page/football">Подробнее</a>
                            <a href="#">Тренировки</a>
                        </div>
                    </div>
                    <img src="img/football_big.png">
                </div>
            </div>
            <div class="row">
                <div class="services">
                    <h3 style="font-size: 32px">Пляжный волейбол</h3>
                    <div>
                        <h2>История</h2>
                        <p>
                            Родиной пляжного волейбола считается Калифорния, на пляжах которой в начале 1920-х годов появились площадки для игры и были собраны первые команды, состоявшие, как и в классическом волейболе, из 6 человек. Распространена также версия, что в 1910-е годы
                            на Гавайях члены местного сёрфинг-клуба, среди которых был знаменитый американский пловец, сёрфер и ватерполист Дьюк Каханамоку, в ожидании хорошей волны нередко играли в волейбол прямо на пляже. Позднее, став руководителем
                            пляжного клуба Санта-Моники, Каханамоку внёс большой вклад в развитие игры. В 1930 году в Санта-Монике прошёл первый матч по пляжному волейболу с командами из двух человек.Первые официальные соревнования по пляжному волейболу
                            в СССР прошли в 1986 году. В 1989-м разыгран Кубок Москвы и Кубок СССР среди мужчин, советские волейболисты (Виктор Артамонов / Валтс Михелсонс, Игорь Абдрахманов / Александр Овсянников) дебютировали в Мировом туре.
                        </p>
                        <div class="kinds-of-sports-buttons">
                            <a href="#">Расписание</a>
                            <a href="/page/volleyball">Подробнее</a>
                            <a href="/page/forsport">Тренировки</a>
                        </div>
                    </div>
                    <img src="img/volleyball_big.png">
                </div>
            </div>
            <div class="row">
                <div class="services">
                    <h3 style="font-size: 32px">Пляжный теннис</h3>
                    <div>
                        <h2>История</h2>
                        <p>
                            Пляжный теннис зародился сравнительно недавно — всего лишь в 1978 году в итальянской Равенне. Именно там на местных пляжах появились люди с ракетками, причем не с обычными, а со специальными — без струн, и сделанными из цельного пластика (ныне используют
                            графит и фиберглас). В Италии создали Международную федерацию пляжного тенниса. Первым и до сих пор действующим её президентом стал Джандоменико Беллеттини. В 2007 году Международная федерация тенниса (ITF) официально признала
                            новый вид тенниса и запустила программу соревнований мирового тура. С 2008 года ежегодно под эгидой ITF проводятся Чемпионаты Европы, с 2009 года Чемпионаты Мира, а с 2012 года командный Чемпионат Мира по пляжному теннису.
                        </p>
                        <div class="kinds-of-sports-buttons">
                            <a href="#">Расписание</a>
                            <a href="/page/tennis">Подробнее</a>
                            <a href="#">Тренировки</a>
                        </div>
                    </div>
                    <img src="img/tennis_big.png">
                </div>
            </div>
        </div>

        <!-- ГАЛЕРЕЯ -->
        <div class="container-fluid my-gallery" gallery>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="imgInGallery">
                            <a href="img/gallery/1.jpg" data-lightbox="image-1">
                                <img src="img/gallery/1.jpg" width="100%">
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="imgInGallery">
                            <a href="img/gallery/2.jpg" data-lightbox="image-1">
                                <img src="img/gallery/2.jpg" width="100%">
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="imgInGallery">
                            <a href="img/gallery/3.jpg" data-lightbox="image-1">
                                <img src="img/gallery/3.jpg" width="100%">
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="imgInGallery">
                            <a href="img/gallery/4.jpg" data-lightbox="image-1">
                                <img src="img/gallery/4.jpg" width="100%" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="imgInGallery">
                            <a href="img/gallery/5.jpg" data-lightbox="image-1">
                                <img src="img/gallery/5.jpg" width="100%" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            <!--<div class="my-gallery-controls">
            <span class="prev"></span>
        </div>
        <div class="gitem">
            <img src="img/tennis.png">
        </div>
        <div class="my-gallery-controls">
            <span class="next"></span>
        </div>-->
            <img src="img/ball_2.png">
        </div>
        <script>
            var mySwiper = new Swiper('.swiper-container', {
                // Optional parameters
                direction: 'horizontal',
                spaceBetween: 20,
                loop: false,
                width: 250,
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev'
            })
        </script>
    </div>


        


<style>
    .carousel-control.left, .carousel-control.right {
      background-image: none;
      filter: none;
    }
</style>

<script>
    // $(".item").last().addClass("active");
</script>

    <!-- ФОРМА КОММЕНТАРИЕВ -->
    <div class="container">
        <div class="row howfind">
            <div class="col-md-12">
                <h2>Напишите нам свой отзыв</h2>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="frm_usr">

                    <form action="/reviews" method="post">
                      <%% csrf_field() %%>
                      <div class="form-group">
                        <input type="text" class="form-control" name="name_rev" placeholder="Ваше имя:" required="">
                      </div>
                      <div class="form-group">
                        <input type="email" class="form-control" name="email_rev" placeholder="Email" required="">
                      </div>
                      <div class="form-group">
                        <textarea class="form-control" rows="3" name="message_rev" placeholder="Ваш отзыв:" required=""></textarea>
                      </div>
                      <div class="checkbox" style="text-align: left">
                        <label>
                            <input type="checkbox" required="true">Нажимая кнопку «Отправить», вы подтверждаете свое согласие с <a href="page/terms_of_use">Пользовательским соглашением</a> и <a href="page/privacy_policy">Политикой конфиденциальности</a> ЦПС "ПЛЯЖ"
                        </label>
                    </div>
                      <button type="submit" class="btn btn-default">Отправить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!--Как добраться-->
    <div class="container">
        <div class="row howfind">
            <div class="col-md-12">
                <h2>Как добраться?</h2>
            </div>
        </div>
    </div>



    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <img src="img/map.jpg" width="100%" alt="">
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row footerP">
            <div class="container">
                <div class="row">
                    <div class="col-md-2" style="text-align: center">
                        <img src="/img/logo.png" alt="ПЛЯЖ">
                    </div>
                    <div class="col-md-offset-1 col-md-6">
                        <div class="footer-data">
                            <div>
                                <div>8 (812) 911-70-77</div>
                                <div>c 10:00 до 23:00</div>
                            </div>
                            <div class="soc_">
                                <a href="https://vk.com/plyazh_cps" target="_blank">
                                    <img src="/img/vk.png" alt="Мы в ВКонтакте">
                                </a>
                                <a href="https://www.instagram.com/plyazhspb/" target="_blank">
                                    <img src="/img/insta.png" alt="Мы в Instagram">
                                </a>
                            </div>
                            <div>
                                <div>Адрес: Санкт-Петербург,</div>
                                <div>улица Фучика, 2А</div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-3">
                        <div class="footer-data">
                            <div style="padding:0;position: relative">2017 &copy; <a href="https://plyazhspb.ru/">ЦПС "ПЛЯЖ"</a><br>
                                <a href="page/privacy_policy">Политика конфиденциальности</a><br>
                                <a href="page/terms_of_use">Пользовательское соглашение</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal-corporate">
        <div>
            <i class="mdi mdi-close mdi-36px"></i>
            <h3 style="font-size: 32px; display: block">Оставьте заявку
                <small style="display: block;">от вашей компании на бронирование полей или всего комплекса</small>
            </h3>
            <form action="/mail" method="post">
                <%% csrf_field() %%>
                <input type="text" class="form-control" placeholder="Ваше Имя" ng-model="cor.name" name="name_user">
                <input type="text" class="form-control phn-usr" placeholder="Телефон" ng-model="cor.phone" name="phone_user">
                <input type="text" class="form-control" placeholder="Название организации" ng-model="cor.nameOrganize" name="organization_user">
                <textarea cols="20" rows="5" class="form-control" placeholder="Кратко укажите: цель мероприятия, примерное число участников, дата меропрития. И любую дополнительную информацию" rows="10" ng-model="cor.target" name="target_user"></textarea>
                <div class="checkbox" style="text-align: left">
                            <label>
                                <input type="checkbox" required="true">Нажимая кнопку «Зарегистрироваться», вы подтверждаете свое согласие с <a href="page/terms_of_use">Пользовательским соглашением</a> и <a href="page/privacy_policy">Политикой конфиденциальности</a> ЦПС "ПЛЯЖ"
                            </label>
                        </div>
                <button ng-click="sendCorporate(cor)">ОТПРАВИТЬ</button>
            </form>
            <span style="color: #787878">Мы перезвоним Вам в ближайшее время для уточнения деталей заявки.</span>
            <span style="color: #787878">Спасибо!</span>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            openCorporateModal = function() {
                $('.modal-corporate').css('display', 'flex');
                $('.blur-content').css({
                    filter: 'blur(5px)'
                });
            }
            $('.modal-corporate i').on('click', function() {
                $(this).parent().parent().hide();
                $('.blur-content').css({
                    filter: 'blur(0)'
                });
            })
        })
    </script>

    <!--MODAL for AUTH-->
    <div class="modal-auth">
        <div class="box-border">
            <i class="mdi mdi-close mdi-36px" style="top: 4px"></i>
            <div id="auth">
                <form action="/auth" method="post">
                    <%% csrf_field() %%>
                        <h3 style="font-size: 32px">Вход в личный кабинет</h3>
                        <a href="" class="disabled">Вход</a>
                        <a class="auth_close" onclick="openAuthModal('reg')" style="cursor: pointer;">Регистрация</a><br><br>
                        <p>Мы работаем в соответствии с Федеральным Законом от 27.07.2006 №152-ФЗ «О персональных данных»</p>
                        <input type="text" name="email" class="form-control" placeholder="E-Mail" ng-model="a.login">
                        <input type="password" name="password" class="form-control" placeholder="Пароль" ng-model="a.pass">
                        <a onclick="openAuthModal('forget')" style="display: block; cursor: pointer;">Забыли пароль?</a>
                        <button type="submit">ВОЙТИ</button>
                </form>
            </div>
            <div id="register">
                <form action="/register" method="post">
                    <%% csrf_field() %%>
                        <h3 style="font-size: 32px">Регистрация</h3>
                        <p>Мы работаем в соответствии с Федеральным Законом от 27.07.2006 №152-ФЗ «О персональных данных»</p>
                        <a class="auth_close" onclick="openAuthModal('auth')" style="cursor: pointer;">Вход</a>
                        <a href="" class="disabled">Регистрация</a><br><br>
                        <input type="text" name="name" class="form-control" placeholder="Имя" ng-model="r.firstname" required="true">
                        <input type="text" name="surname" class="form-control" placeholder="Фамилия" ng-model="r.family" required="true">
                        <input type="text" name="patronymic" class="form-control" placeholder="Отчество" ng-model="r.lastname">
                        <input type="text" name="email" class="form-control" placeholder="E-Mail" ng-model="r.email" required="true">
                        <input type="text" name="phone" class="form-control phn-usr" placeholder="Номер телефона" ng-model="r.phone">
                        <input type="password" name="password" class="form-control" placeholder="Пароль" ng-model="r.pass" required="true">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Повторить пароль" ng-model="r.spass" required="true">
                        <div class="checkbox" style="text-align: left">
                            <label>
                                <input type="checkbox" required="true">Нажимая кнопку «Зарегистрироваться», вы подтверждаете свое согласие с <a href="page/terms_of_use">Пользовательским соглашением</a> и <a href="page/privacy_policy">Политикой конфиденциальности</a> ЦПС "ПЛЯЖ"
                            </label>
                        </div>
                        <button type="submit">Зарегистрироваться</button>
                </form>
            </div>
            <!-- FORGET PASSWORD -->
            <div id="forget">
                <form action="<% url('/password/email') %>" method="post">
                    <%% csrf_field() %%>
                        <h3 style="font-size: 32px">Введите ваш E-mail</h3>
                        <!-- <a href="" class="disabled">Вход</a>
                        <a class="auth_close" onclick="openAuthModal('reg')" style="cursor: pointer;">Регистрация</a><br><br> -->
                        <input type="text" name="email" class="form-control" placeholder="Введите ваш E-Mail:" ng-model="a.login">
                        <div>После нажатия на кнопку Вам на почту придет письмо со ссылкой для восстановления пароля.</div>
                        <button type="submit">Отправить</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            openAuthModal = function(type) {

                if (type == 'auth') {
                    $('#register').hide();
                    $('#forget').hide();
                    $('#auth').show();
                } else if (type == 'reg') {
                    $('#auth').hide();
                    $('#forget').hide();
                    $('#register').show();
                } else if (type == 'forget') {
                    $('#auth').hide();
                    $('#register').hide();
                    $('#forget').show();
                }
                $('.blur-content').css({
                    filter: 'blur(5px)'
                });
                $('.modal-auth').css('display', 'flex');

            }
            $('.modal-auth i').on('click', function() {
                $('#auth').show();
                $('#register').show();
                $(this).parent().parent().hide();
                $('.blur-content').css({
                    filter: 'blur(0)'
                });
            });

        });
    </script>
    <!-- МОДАЛЬНОЕ ОКНО РЕЗЕРВАЦИИ -->
    <!-- <div class="container-fluid modal-reserve" style="">        -->
    <div class="reserve-field" modal-view>
        <i class="mdi mdi-close mdi-36px" ng-click="closeModal();"></i>
        <div class="row">
            <div class="col-xs-4">
                <div class="reserve-digits"></div>
                <div class="reserve-pips"></div>
            </div>
            <div class="col-xs-4" align="center">
                <div class="reserve-digits"></div>
            </div>
            <div class="col-xs-4" align="right">
                <div class="reserve-pips" style="left: inherit;right:100px"></div>
                <div class="reserve-digits"></div>
            </div>
        </div>
        <noindex>
            <div class="state1">
                <div class="row">
                    <div class="col-md-12">
                        <span style="font-size: 36px;display: block;margin-top: 18px;">{{type}}
                        <small ng-if="numField" style="color: #8a8a8a;">номер {{numField}}</small></span>
                    </div>
                </div>
                <hr>
                <div class="row" style="margin-top:20px">
                    <div class="col-md-6">
                        <span style="font-size: 18px;margin-top:10px;margin-bottom:10px;font-weight:500;display:block">Время</span>
                    </div>
                    <div class="col-md-6">
                        <span style="font-size: 18px;margin-top:10px;margin-bottom:10px;font-weight:500;display:block">Дата</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="from">От</label>
                        <input type="text" id="from" class="form-control timeField" value="{{time | timeSeparate}}" disabled="">
                    </div>
                    <div class="col-md-3">
                        <label for="to">До</label>
                        <input type="text" id="to" class="form-control timeField" value="{{time | timeSeparate:true}}" disabled="">
                    </div>
                    <div class="col-md-6">
                        <div class="input-group date" style="margin-top:23px;">
                            <input type="text" class="form-control" id="dateField" ng-model="date" value="{{'' | currentDate}}" placeholder="Выберите дату" ng-change="update(date, numField)">
                            <span class="input-group-addon">
                                    <i class="mdi mdi-calendar mdi-18px"></i>
                                </span>
                        </div>
                    </div>
                </div>                                
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <span style="font-size:24px;margin-top:20px;margin-bottom:10px;font-weight:500;display:block;">Выберите промежуток времени 
                        <i class="mdi mdi-help-circle-outline" onmouseover="showHelp(true)"
                                onmouseout="showHelp(false)"></i></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input id="ex16b" type="text" ng-model="time" /><br/>
                    </div>
                </div>
                <div class="row" style="margin-top:8px">
                    <div class="col-md-12" id="help">
                        <div class="helpBlock">
                            <div class="busy">Занято</div>
                            <div class="free">Свободно</div>
                            <div class="checked">Выбрано</div>
                        </div>
                    </div>
                </div>
                <hr>                
                <div class="row" style="text-align: right">
                    <div class="col-md-12">
                        <button class="btn btn-success" id="page1next" class="next">Следующий шаг<i class="mdi mdi-arrow-right"></i>
                    </button>
                    </div>
                </div>
            </div>
            <div class="state2">
                <div class="row" style="margin-top:50px;">
                    <div class="col-md-12">
                        <p>Мы работаем в соответствии с Федеральным Законом от 27.07.2006 №152-ФЗ «О персональных данных»</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <i class="mdi mdi-face mdi-24px"></i>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="surname" placeholder="Фамилия" class="form-control" ng-model="surname">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="firstname" placeholder="Имя" class="form-control" ng-model="firstname">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="lastname" placeholder="Отчество" class="form-control" ng-model="lastname">
                    </div>
                </div>
                <div class="row" style="padding: 10px 0;">
                    <div class="col-md-1">
                        <i class="mdi mdi-cellphone mdi-24px"></i>
                    </div>
                    <div class="col-md-11">
                        <input type="text" name="phone" placeholder="Телефон" class="form-control phn-usr" ng-model="phone">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <i class="mdi mdi-email mdi-24px"></i>
                    </div>
                    <div class="col-md-11">
                        <input type="text" name="email" placeholder="e-mail" class="form-control" ng-model="email">
                    </div>
                </div>
                <hr>
                <div class="row" style="text-align: right">
                    <div class="col-md-12">
                        <button class="btn btn-success" id="page2back" class="back"><i class="mdi mdi-arrow-left"></i></button>
                        <button class="btn btn-success" id="page2next" class="next">Следующий шаг<i class="mdi mdi-arrow-right"></i>
                    </button>
                    </div>
                </div>
            </div>
            <div class="state3">
                <div class="row" style="margin-top: 26px">
                    <div class="col-md-12">
                        <h3>Бронирование {{typeS}}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>
                            <small>на</small> {{date | date: 'd MMMM'}}
                            <small>в</small> с {{time | timeSeparate}} по {{time | timeSeparate:true}}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <i class="mdi mdi-face mdi-24px" style="font-size: 15px;position: relative;bottom: -1px;"></i> {{surname}} {{firstname}} {{lastname}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <i class="mdi mdi-cellphone mdi-24px"></i> {{phone}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <i class="
                         mdi-email mdi-24px"></i> {{email}}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-1">
                        <button class="btn btn-success" class="back"><i class="mdi mdi-arrow-left"></i></button>
                    </div>
                    <div class="col-md-offset-2 col-md-6">
                        <button class="btn btn-block btn-success" ng-click="send(numField, time, date, surname, firstname, lastname, phone, email)">Все верно.
                        Забронировать!
                    </button>
                    </div>
                </div>
            </div>
        </noindex>
    </div>
    <noindex>
        <!-- MODAL MOBILE WINDOW -->
        <div class="mobile-modal">
            <div class="row header">
                <div class="col-xs-2">
                    <i class="mdi mdi-close" ng-click="closeMobile()"></i>
                </div>
                <div class="col-xs-10">
                    <span>
                            {{typeSport}}
                        </span>
                </div>
            </div>
            <div class="row modal-body">
                <div class="col-xs-12">
                    <div class="select-field" ng-init="selectField = 1">
                        <!-- Поле номер {{selectField}} <i class="mdi mdi-chevron-down"></i> -->
                        <select ng-model="data.selectedField" class="form-control">
                        <option selected>-- Выберите поле --</option>
                        <option ng-repeat="field in fieldCount" value="{{field.fieldType}}">Поле
                            номер {{field.num}}</option>
                    </select>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row dates modal-body" ng-hide="!data.selectedField">
                <div class="col-xs-4">
                    <!-- <label class="label" for="modal-date">Дата</label> -->
                    <input type="text" class="form-control input-group date" id="modal-date" ng-model="data.mobileDate" ng-change="getPoloski(data.mobileDate, data.selectedField)" placeholder="Дата">
                </div>
                <div class="col-xs-4">
                    <!-- <label class="label" for="modal-time-1">От</label> -->
                    <select ng-model="data.from" class="form-control list-selector required">
                    <option disabled="disabled" selected="selected">От</option>
                    <option ng-repeat="time in times">{{time}}</option>
                </select>
                    <!-- <input type="text" class="modal-inpu" id="modal-time-1"> -->
                </div>
                <div class="col-xs-4">
                    <!-- <label class="label" for="modal-time-2">До</label> -->
                    <select ng-model="data.to" class="form-control">
                    <option disabled="" selected="">До</option>
                    <option ng-repeat="time in times">{{time}}</option>
                </select>
                </div>
            </div>
            <div class="row modal-body mobile-range" ng-hide="!data.selectedField">
                <div class="col-xs-12">
                    <ul>
                        <li ng-repeat="range in ranges">
                            <div class="mobile-prog">
                                <i class="mdi mdi-dots-vertical" style="left: 0;"></i>
                                <from>{{range.to}}</from>
                                <to>{{range.from}}</to>
                                <i class="mdi mdi-dots-vertical"></i>
                            </div>
                        </li>
                        <li ng-show="!ranges">
                            <div class="mobile-prog">
                                <i class="mdi mdi-dots-vertical" style="left: 0;"></i>
                                <from>07:00</from>
                                <to>02:00</to>
                                <i class="mdi mdi-dots-vertical"></i>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="row modal-body">
                <div class="col-xs-12">
                    <input type="text" class="modal-input phn-usr" ng-model="data.phone" placeholder="Номер телефона">
                </div>
            </div>
            <div class="row modal-body">
                <div class="col-xs-12">
                    <input type="text" class="modal-input" ng-model="data.name" placeholder="Имя">
                </div>
            </div>
            <div class="row modal-body">
                <div class="col-xs-12">
                    <input type="text" class="modal-input" placeholder="Фамилия" ng-model="data.last_name" style="font-size: 18px;">
                </div>
            </div>
            <div class="row modal-body">
                <div class="col-xs-12">
                    <input type="text" class="modal-input" placeholder="e-mail" ng-model="data.email" style="font-size: 18px;">
                </div>
            </div>
            <div class="row modal-body">
                <div class="col-xs-12">
                    <button class="modal-button" ng-click="sendMobile(data)">ОТПРАВИТЬ</button>
                </div>
            </div>
        </div>
    </noindex>
    </div>
    <!-- </div> -->
    <noindex>
        <div class="modal-result">
            {{checkDateMes}}
        </div>
        <div class="closeModal" ng-click="closeModal()" style="display: none;"></div>
    </noindex>



    <!-- АНИМАЦИИ -->
    <noindex>
        <script type="text/javascript" src="/js/animations.js"></script>
        <script src="https://code.angularjs.org/1.3.0-rc.2/i18n/angular-locale_ru-ru.js"></script>
        <script type="text/javascript" src="/js/bootstrap-slider.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/js/mask.js"></script>
        <script type="text/javascript">
            jQuery(function($){
               $(".phn-usr").mask("+7 (999) 999-9999");
            });
        </script>
        <script type="text/javascript" src="/js/jcarousel.js"></script>
        <script type="text/javascript">
        </script>
        <script>
            function checkForm(form) {

                var name = form.name.value;
                var n = name.match(/^[A-Za-zА-Яа-я ]*[A-Za-zА-Яа-я ]+$/);
                if (!n) {
                    alert("Имя введено неверно, пожалуйста исправьте ошибку");
                    return false;
                }

                var phone = form.phone.value;
                var p = phone.match(/^[0-9+][0-9- ]*[0-9- ]+$/);
                if (!p) {
                    alert("Телефон введен неверно");
                    return false;
                }
                return true;
            }
        </script>
    </noindex>
    <!— Yandex.Metrika counter —>
    <script type="text/javascript">
        (function(d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter44916208 = new Ya.Metrika({
                        id: 44916208,
                        clickmap: true,
                        trackLinks: true,
                        accurateTrackBounce: true,
                        webvisor: true
                    });
                } catch (e) {}
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function() {
                    n.parentNode.insertBefore(s, n);
                };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else {
                f();
            }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/44916208" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!— /Yandex.Metrika counter —>
    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-38821658-6', 'auto');
        ga('send', 'pageview');
    </script>
</body>

</html>