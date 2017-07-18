<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta content="width=device-width,initial-scale=1" name="viewport">
    <meta name="resource-type" content="Document" />
    <meta name="title" content="{{ $page->meta_title }}">
    <meta name="keywords" content="{{ $page->meta_keywords }}">
    <meta name="description" content="{{ $page->meta_description }}">
    <title>{{ $page->title }}</title>
    <?php $prefix = '';?>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.css" rel="stylesheet">
    <link href="//cdn.materialdesignicons.com/1.9.32/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/6.0.2/jquery.mmenu.all.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/css/lightbox.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ $prefix }}/css/common.css" rel="stylesheet">
    <link rel="icon" href="/img/favicon.ico">
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
                                    @if(Request::path() == "page/contacts" or
                                        Request::path() == "page/terms_of_use" or
                                        Request::path() == "page/privacy_policy")
                                        <li><a href="{{ $prefix }}/">Главная</a></li>
                                        <li class="active">{{ $page->title }}</li>
                                    @else
                                        <li><a href="{{ $prefix }}/">Главная</a></li>
                                        @if($page->parent)
                                            <li class="active">{{ $page->parent->title }}</li>
                                        @endif
                                        <li class="active">{{ $page->title }}</li>
                                    @endif
                                </ol>
                            </div>
                        </div>
                        <div class="row">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-12"><h1 class="razdel-2">{{ $page->title }}</h1>
                            </div>
                        </div>

                        {!! $page->content !!}

                        <!-- ФОРМЫ ЗАЯВОК -->
                        <!-- ДЕТСКИЕ СЕКЦИИ -->
                        <div class="row corporate-block back-block" id="form_">
                            <div class="order-application">
                                <h3>Предварительная запись в секцию</h3>
                            </div>
                            <form action="" method="post" style="width: 300px; text-align: center; margin: auto;">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" name="fio_par" class="form-control" placeholder="ФИО родителя:" required="true">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="fio_child" class="form-control" placeholder="ФИО ребенка:" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="mobile_phone_par" class="form-control phn-usr" placeholder="Мобильный телефон:" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="mail_par" class="form-control" placeholder="Почта:" required>
                                </div>
                                <div class="chk-box">
                                    <label class="fontbold">
                                        <input type="checkbox" required="true">&#4448 Нажимая кнопку «Отправить заявку», вы подтверждаете свое согласие с <a href="terms_of_use" class="link-terms">Пользовательским соглашением</a> и <a href="privacy_policy" class="link-terms">Политикой конфиденциальности</a> ЦПС "ПЛЯЖ"
                                    </label>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-inpt">Отправить заявку</button>
                                </div>
                            </form>
                        </div>

                        <!-- ДЕТСКИЕ ПРАЗДНИКИ -->
                        <div class="row corporate-block back-block" id="form_2">
                            <div class="order-application">
                                <h3>Отправьте нам заявку</h3>
                            </div>
                            <form action="" method="post" style="width: 300px; text-align: center; margin: auto;">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" name="fio_par_hol" class="form-control" placeholder="ФИО родителя:" required="true">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="fio_child_hol" class="form-control" placeholder="ФИО ребенка:" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="mobile_phone_par" class="form-control phn-usr" placeholder="Мобильный телефон:" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="mail_par" class="form-control" placeholder="Почта:" required>
                                </div>
                                <div class="form-group">
                                    <textarea name="info" rows="5" class="form-control" placeholder="Укажите дополнительную информацию, необходимую для организации мероприятия... например, количество гостей, наличие аниматора, угощения, подарки, шары и пр."></textarea>
                                </div>
                                <div class="chk-box">
                                    <label class="fontbold">
                                        <input type="checkbox" required="true">
                                        &#4448 Нажимая кнопку «Отправить заявку», вы подтверждаете свое согласие с <a href="terms_of_use" class="link-terms">Пользовательским соглашением</a> и <a href="privacy_policy" class="link-terms">Политикой конфиденциальности</a> ЦПС "ПЛЯЖ"
                                    </label>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-inpt">Отправить заявку</button>
                                </div>
                            </form>
                        </div>


                        <!-- ВЗРОСЛЫЕ СЕКЦИИ -->
                        <div class="row corporate-block back-block" id="form_3">
                            <div class="order-application">
                                <h3>Отправьте нам заявку</h3>
                            </div>
                            <form action="" method="post" style="width: 300px; text-align: center; margin: auto;">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" name="fio" class="form-control" placeholder="Ваше ФИО:" required="true">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="mobile_phone" class="form-control phn-usr" placeholder="Мобильный телефон:" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="mail" class="form-control" placeholder="Почта:" required>
                                </div>
                                <div class="radio" style="text-align: left">
                                    <label style="color: #fff"><input type="radio" name="newcomer" value="newcomer" checked>Новичок</label>
                                </div>
                                <div class="radio" style="text-align: left">
                                    <label style="color: #fff; margin-right: 0px;">
                                        <input type="radio" name="newcomer" value="">Любитель
                                    </label>
                                </div>
                                <div class="chk-box">
                                    <label class="fontbold">
                                        <input type="checkbox" required="true">&#4448 Нажимая кнопку «Отправить заявку», вы подтверждаете свое согласие с <a href="terms_of_use" class="link-terms">Пользовательским соглашением</a> и <a href="privacy_policy" class="link-terms">Политикой конфиденциальности</a> ЦПС "ПЛЯЖ"
                                    </label>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-inpt">Отправить заявку</button>
                                </div>
                            </form>
                        </div>

                        <!-- ДЛЯ БИЗНЕСА -->
                        <div class="row corporate-block back-block" id="form_4" style="margin-top: 30px !important">
                            <div class="order-application">
                                <h3>Оставьте заявку
                                    от вашей компании на бронирование полей или всего комплекса</h3>
                            </div>
                            <form action="" method="post" style="width: 300px; text-align: center; margin: auto;">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" name="name_corp" class="form-control" placeholder="Ваше имя:" required="true">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="phone_corp" class="form-control phn-usr" placeholder="Телефон:" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="corp" class="form-control" placeholder="Название организации:" required>
                                </div>
                                <div class="form-group">
                                    <textarea name="info_corp" rows="5" class="form-control" placeholder="Кратко укажите: цель мероприятия, примерное число участников, дата мероприятия. И любую дополнительную информацию."></textarea>
                                </div>
                                <div class="chk-box">
                                    <label class="fontbold">
                                        <input type="checkbox" required="true">&#4448 Нажимая кнопку «Отправить заявку», вы подтверждаете свое согласие с <a href="terms_of_use" class="link-terms">Пользовательским соглашением</a> и <a href="privacy_policy" class="link-terms">Политикой конфиденциальности</a> ЦПС "ПЛЯЖ"
                                    </label>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-inpt">Отправить заявку</button>
                                </div>
                            </form>
                        </div>

                        <!-- ДЛЯ СПОРТА -->
                        <div class="row corporate-block back-block" id="form_5" style="margin-top: 30px !important">
                            <div class="order-application">
                                <h3>Оставьте заявку от вашей спортивной организации или клуба на бронирование полей или всего комплекса</h3>
                            </div>
                            <form action="" method="post" style="width: 300px; text-align: center; margin: auto;">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" name="name_corp_sport" class="form-control" placeholder="Ваше имя:" required="true">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="phone_corp_sport" class="form-control phn-usr" placeholder="Телефон:" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="corp_sport" class="form-control" placeholder="Название организации:" required>
                                </div>
                                <div class="form-group">
                                    <textarea name="info_corp_sport" rows="5" class="form-control" placeholder="Кратко укажите: цель мероприятия, примерное число участников, дата мероприятия. И любую дополнительную информацию."></textarea>
                                </div>
                                <div class="chk-box">
                                    <label class="fontbold">
                                        <input type="checkbox" required="true">&#4448 Нажимая кнопку «Отправить заявку», вы подтверждаете свое согласие с <a href="terms_of_use" class="link-terms">Пользовательским соглашением</a> и <a href="privacy_policy" class="link-terms">Политикой конфиденциальности</a> ЦПС "ПЛЯЖ"
                                    </label>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-inpt">Отправить заявку</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </main>
        </div>
        @include('pages.footer')
    </div>
</div>





<script type="text/javascript" src="/js/mask.js"></script>
<script type="text/javascript">
    jQuery(function($){
       $(".phn-usr").mask("+7 (999) 999-9999");
    });
</script>
<script>

$(document).ready(function(){
    $('#form_').hide();
    $('#form_2').hide();
    $('#form_3').hide();
    $('#form_4').hide();
    $('#form_5').hide();
    $("#z").on("click","a", function (event) {
        $('#form_').show();
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1000);
    });
    $("#x").on("click", "a", function (event) {
        $('#form_2').show();
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1000);
    });
    $("#y").on("click", "a", function (event) {
        $('#form_3').show();
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1000);
    });
    $("#c").on("click", "a", function (event) {
        $('#form_4').show();
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1000);
    });
        $("#s").on("click", "a", function (event) {
        $('#form_5').show();
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1000);
    });
});

</script>
</body>
</html>