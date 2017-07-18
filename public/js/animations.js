/** АНИМАЦИЯ ПРИ НАВЕДЕНИИ НА ПОЛЕ **/
function fup(type, num, out) {
    if (type == 'f') var x = document.getElementById('f');
    if (type == 'v') var x = document.getElementById('v');
    if (type == 't') var x = document.getElementById('t');
    if (!out) {
        $(x).find('img:nth-child(' + num + ')').addClass('animate');
    } else {
        $(x).find('img:nth-child(' + num + ')').removeClass('animate');
    }
}

/** СМЕНА КАРТЫ **/
$(document).ready(function() {
    var footMap = document.getElementsByClassName('map-football');
    var vollMap = document.getElementsByClassName('map-volleyball');
    var tennMap = document.getElementsByClassName('map-tennis');
    var fImg = document.getElementById('f');

    $(footMap).addClass('active');
    $(vollMap).css({
        // transform: 'translateX(1140px)',
        opacity: 0,
        display: 'none',
        zIndex: '100'
    });

    mapReady();
    animateOne(fImg);

});

function changeMap(type) {
    var footMap = document.getElementsByClassName('map-football');
    var vollMap = document.getElementsByClassName('map-volleyball');
    var tennMap = document.getElementById('map-tennis');
    var widthmap = document.getElementsByClassName('maphilighted');
    var fImg = document.getElementById('f');
    var vImg = document.getElementById('v');
    var tImg = document.getElementById('t');
    $(widthmap).css('width', '1140px');

    if (type == 'foot') {
        $('#v').find('img').attr('src', 'img/volleyball_tag_off.png');
        $('#t').find('img').attr('src', 'img/tennisl_tag_off.png');
        $('#f').find('img').attr('src', 'img/football_tag_on.png');
        $(footMap).css('display', 'block');
        setTimeout(function() {
            $(footMap).css('opacity', '1');
        }, 0);

        setTimeout(function() {
            $(vollMap).css('display', 'none');
            $(footMap).css('z-index', '1');
            $(vollMap).css('z-index', '100');
            $(vollMap).css('opacity', '0');
        }, 300);
        fToV(vImg, fImg, 1);
        mapReady();
        animateOne(fImg);
    } else if (type == 'voll') {
        $('#v').find('img').attr('src', 'img/volleyball_tag_on.png');
        $('#t').find('img').attr('src', 'img/tennisl_tag_off.png');
        $('#f').find('img').attr('src', 'img/football_tag_off.png');
        $(vollMap).css('display', 'block');
        setTimeout(function() {
            $(vollMap).css('opacity', '1');
        }, 0);

        setTimeout(function() {
            $(footMap).css('display', 'none');
            $(vollMap).css('z-index', '1');
            $(footMap).css('z-index', '100');
            $(footMap).css('opacity', '0');
        }, 300);

        mapReady();
        fToV(vImg, fImg);

        animateOne(vImg);
    } else if (type == 'tenn') {
        $('#v').find('img').attr('src', 'img/volleyball_tag_off.png');
        $('#t').find('img').attr('src', 'img/tennisl_tag_on.png');
        $('#f').find('img').attr('src', 'img/football_tag_off.png');
        $(footMap).css('display', 'block');
        setTimeout(function() {
            $(footMap).css('opacity', '1');
        }, 0);

        setTimeout(function() {
            $(vollMap).css('display', 'none');
            $(footMap).css('z-index', '1');
            $(vollMap).css('z-index', '100');
        }, 300);
        fToV(vImg, fImg, 1);
        mapReady();
        animateOne(tImg);
    }
}

function mapReady() {
    $('.map').maphilight({
        fillColor: '3bfa41',
        stroke: false,
        strokeColor: '245ed1',
        groupBy: 'title'
    });
}

function animateOne(img) {
    $(img).find('img').addClass('animateOne');
    setTimeout(function() {
        $(img).find('img').removeClass('animateOne');
    }, 850);
}

function translateMap(x, y, z) {
    if (z == 'f') { /** когда нажимаю на волейбол **/
        $(x).css({
            transform: 'translateX(0)',
            opacity: 1
        });
        $(y).css({
            transform: 'translateX(-1140px)',
            opacity: 0
        });
        setTimeout(function() {
            $(y).css('display', 'none');
        }, 300);
    } else { /** когда нажимаю на футбол **/
        $(x).css({
            transform: 'translateX(0)',
            opacity: 1
        });
        $(y).css({
            transform: 'translateX(1140px)',
            opacity: 0
        });
        setTimeout(function() {
            $(y).css('display', 'none');
        }, 300);
    }
}

function fToV(vimg, fimg, type) {
    if (type == 1) {
        $(fimg).find('img').css({
            transform: 'translateY(0)',
            opacity: 1,
        });
        for (var i = 4; i <= 6; i++) {
            $(vimg).find('img:nth-child(' + i + ')').css({
                transform: 'translateY(-50px)',
                opacity: 0,
            });
        }
    } else {
        $(fimg).find('img').css({
            transform: 'translateY(-50px)',
            opacity: 0,
        });
        for (var i = 4; i <= 6; i++) {
            $(vimg).find('img:nth-child(' + i + ')').css({
                transform: 'translateY(0)',
                opacity: 1,
            });
        }
    }
}
/** КОНЕЦ СМЕНЫ КАРТЫ **/

/** ПОДСЧЕТ БЕЗДАТ **/
var dayNow = new Date().getDate();
var monthNow = new Date().getMonth();
var yearNow = new Date().getFullYear();
var disabledDays = [];
for (var i = 1; i < dayNow; i++) {
    disabledDays.push(yearNow + '/' + addZero(monthNow + 1) + '/' + addZero(i));
}

console.log(disabledDays);

/** DATEPICKER **/
$('.input-group.date').datepicker({
    format: "yyyy-mm-dd",
    maxViewMode: 0,
    language: "ru",
    autoclose: true,
    todayHighlight: true,
    datesDisabled: disabledDays
});

/** ДОБАВЛЕНИЕ НУЛЕЙ **/
function addZero(i) {
    return (i < 10) ? "0" + i : i;
}

/** ПОКАЗАТЬ ПОДСКАЗКУ **/
function showHelp(show) {
    var help = angular.element(document.getElementsByClassName('helpBlock'));
    if (show == true) {
        help[0].style.display = 'inline-block';
        setTimeout(function() {
            help[0].style.opacity = 1;
            help[0].style.transform = 'translateX(0)';
        });
    } else {
        help[0].style.opacity = 0;
        help[0].style.transform = 'translateX(12px)';
        setTimeout(function() {
            help[0].style.display = 'none';
            help[0].style.transform = 'translateX(-12px)';
        }, 300);

    }
}