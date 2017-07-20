<header>
    <div>
        <div class="container-fluid header-fluid">
            <div class="container">
                <?php $prefix = ''; ?>
                <div class="col-xs-2">
                    <a href="{{ $prefix }}/" class="navbar-brand">
                        <img src="{{ $prefix }}/img/logo.png" alt="Логотип">
                    </a>
                </div>
                <div class="col-xs-10">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a href="#menu" id="toggleMenu">
                                    <button class="collapsed navbar-toggle" type="button">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </a>
                            </div>
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <div class="addr-head"> 
                                        <!-- <i class="fa fa-map-marker" aria-hidden="true" style="color: orange;"></i> -->
                                        <img src="/img/geo.png" style="margin-bottom: 5px" width="13px" alt="">
                                            Санкт-Петербург, улица Фучика, 2А
                                    </div>
                                    <div class="phn-head">
                                        <div class="phn-phn">8 (812) 911-70-77 &nbsp;
                                        <img src="/img/clock.png" width="20px" alt="">
                                         с 10:00 до 23:00</div>
                                    </div>
                                    <div class="auth-head">
                                        @if(Auth::check())
                                            <a href="https://lk.plyazhspb.ru/">Личный кабинет</a>
                                            <a class="auth_close" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выход
                                                <form id="logout-form" action="/logout" method="POST"
                                                    style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            </a>
                                            @else
                                            <a onclick="openAuthModal('auth')" style="cursor: pointer;">Вход</a>
                                            <a onclick="openAuthModal('reg')" style="cursor: pointer;">Регистрация</a>
                                        @endif
                                    </div>
                                    <li>
                                        <a href="{{ $prefix }}/">Главная<span class="sr-only">(current)</span></a>
                                    </li>
                                    <li id="sports" class="">
                                        <a class="
                                        @if(Request::path() == "page/volleyball" or
                                            Request::path() == "page/football" or
                                            Request::path() == "page/tennis"
                                            )
                                            blue-head
                                        @endif
                                        dropdown-toggle dropdown-menu_title"
                                        id="dLabel" data-target="#" href="#"
                                           class="dropdown-toggle dropdown-menu_title"
                                           data-toggle="dropdown" role="button" aria-haspopup="true"
                                           aria-expanded="false">Виды спорта
                                            <b class="caret"></b>
                                        </a>
                                        
                                        <ul class="dropdown-menu drop-sports">
                                            <li><a href="{{ $prefix }}/page/volleyball">Волейбол</a></li>
                                            <li><a href="{{ $prefix }}/page/football">Футбол</a></li>
                                            <li><a href="{{ $prefix }}/page/tennis">Теннис</a></li>
                                        </ul>
                                    </li>
                                    <li id="prices">
                                        <a href="{{ $prefix }}/page/prices" class="
                                        @if(Request::path() == "page/prices")
                                            blue-head
                                        @endif
                                        nuxt-link-active router-link-exact-active">
                                            Цены
                                        </a>
                                    </li>
                                    <li><a id="dLabel" data-target="#" href="#"
                                           class="
                                            @if(Request::path() == "page/childrens_sections" or
                                                Request::path() == "page/our_trainers" or
                                                Request::path() == "page/adult_sections")
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
                                            <li><a href="{{ $prefix }}/page/our_trainers">Наши тренеры</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a id="dLabel" data-target="#" href="#"
                                           class="
                                            @if(Request::path() == "page/forbusiness" or
                                                Request::path() == "page/forsport" or
                                                Request::path() == "page/children_holidays")
                                                blue-head
                                            @endif
                                           dropdown-toggle dropdown-menu_title"
                                           data-toggle="dropdown" role="button" aria-haspopup="true"
                                           aria-expanded="false">Предложения
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu drop-sports" aria-labelledby="dLabel">
                                            <li><a href="{{ $prefix }}/page/forbusiness">Для бизнеса</a></li>
                                            <li><a href="{{ $prefix }}/page/forsport">Для спорта</a></li>
                                            <li><a href="{{ $prefix }}/page/children_holidays">Детские праздники</a></li>
                                        </ul>
                                    </li>
                                    <li id="information" class="">
                                        <a href="#" class="
                                        @if(Request::path() == "page/about" or
                                            Request::path() == "page/gallery" or
                                            Request::path() == "page/news" or
                                            Request::path() == "page/partnership")
                                            blue-head
                                        @endif
                                        dropdown-menu_title dropdown-toggle"
                                           data-toggle="dropdown">
                                            Информация
                                            <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu drop-sports">
                                            <li><a href="{{ $prefix }}/page/about">О комплексе</a>
                                            <li><a href="{{ $prefix }}/page/gallery">Галерея</a>
                                            <li><a href="{{ $prefix }}/page/news">Мероприятия</a></li>
                                            <li><a href="{{ $prefix }}/page/partnership">Сотрудничество</a></li>
                                        </ul>
                                    </li>
                                    <li id="contacts"><a class="
                                    @if(Request::path() == "page/contacts")
                                        blue-head
                                    @endif
                                    " href="{{ $prefix }}/page/contacts">Контакты</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <img src="{{ $prefix }}/img/ball_1.png" class="ball">
        </div>
        <nav id="menu">
            <ul>
                <li><a href="https://plyazhspb.ru/">Главная</a></li>
                <li><span>Виды спорта</span>
                    <ul>
                        <li><a href="/page/volleyball">Волейбол</a><li>
                        <li><a href="/page/football">Футбол</a><li>
                        <li><a href="/page/tennis">Теннис</a><li>
                    </ul>
                </li>
                <li><a href="/page/prices">Цены</a></li>
                <li>Секции
                    <ul>
                        <li><a href="/page/childrens_sections">Детские секции</a></li>
                        <li><a href="/page/adult_sections">Взрослые секции</a></li>
                        <li><a href="/page/our_trainers">Наши тренеры</a></li>
                    </ul>
                </li>
                <li><span>Предложения</span>
                        <ul>
                            <li><a href="/page/forbusiness">Для бизнеса</a></li>
                            <li><a href="/page/forsport">Для спорта</a></li>
                            <li><a href="/page/children_holidays">Детские праздники</a></li>
                        </ul>
                </li>
                <li><span>Информация</span>
                    <ul>
                        <li><a href="/page/about">О комплексе</a></li>
                        <li><a href="/page/gallery">Галерея</a></li>
                        <li><a href="/page/news">Мероприятия</a></li>
                        <li><a href="/page/partnership">Сотрудничество</a></li>
                    </ul>
                </li>
                <li><a href="/page/contacts">Контакты</a></li>
                @if(Auth::check())
                    <li><a href="https://lk.plyazhspb.ru/">Личный кабинет</a>
                    <li><a class="auth_close" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выход
                        <form id="logout-form" action="/logout" method="POST"
                            style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </a></li>
                @else
                    <li><a class="auth_close" onclick="openAuthModal('auth')" style="cursor: pointer;">Вход</a></li>
                    <li><a class="auth_close" onclick="openAuthModal('reg')" style="cursor: pointer;">Регистрация</a></li>
                @endif
            </ul>
        </nav>
    </div>
</header>

<div class="modal-auth">
    <div class="box-border">
        <i class="mdi mdi-close mdi-36px" style="top: -3px"></i>
        <div id="auth">
            <form action="{{ url('/login') }}" method="post">
                {{ csrf_field() }}
                    <h1>Вход в личный кабинет</h1>
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
                {{ csrf_field() }}
                    <h1>Регистрация</h1>
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
                            <input type="checkbox" required="true">Нажимая кнопку «Зарегистрироваться», вы подтверждаете свое согласие с <a href="terms_of_use">Пользовательским соглашением</a> и <a href="privacy_policy">Политикой конфиденциальности</a> ЦПС "ПЛЯЖ"
                        </label>
                    </div>
                    <button type="submit">Регистрация</button>
            </form>
        </div>
        <div id="forget">
            <form action="{{ url('/password/email') }}" method="post">
                {{ csrf_field() }}
                <h1>Введите ваш E-mail</h1>
                <input type="text" name="email" class="form-control" placeholder="Введите ваш E-Mail:" ng-model="a.login">
                <div>После нажатия на кнопку Вам на почту придет письмо со ссылкой для восстановления пароля.</div>
                <button type="submit">Отправить</button>
            </form>
        </div>
    </div>
</div>

<!-- СТИЛИ И СКРИПТЫ МОБИЛЬНОГО МЕНЮ -->
<link rel="stylesheet" href="/css/slicknav.css" />
<script src="/js/nav/dist/jquery.slicknav.min.js"></script>

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
            $('.container').css({
                filter: 'blur(5px)'
            });
            $('.modal-auth').css('display', 'flex');
        }
        $('.modal-auth i').on('click', function() {
            $('#auth').show();
            $('#register').show();
            $(this).parent().parent().hide();
            $('.container').css({
                filter: 'blur(0)'
            });
        })
    })
</script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $("#menu").mmenu({
            "navbars": [{
                "position": "bottom",
                "content": [
                    "<a class='fa fa-envelope' href='tel:88129117077'>тел.8 (812) 911-70-77</a>",
                ]
            }]
        });
        var API = $("#menu").data( "mmenu" );
        $(".auth_close").click(function() {
            API.close();
        });
    });
</script>