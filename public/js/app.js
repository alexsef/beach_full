'use strict';

var beach = angular.module('beach', ['ngAnimate']);

beach.directive('kindSport', function($timeout) {
    return {
        restrict: 'A',
        link: function(scope, elem, attr) {
            $timeout(function() {
                console.log(elem);
                var item = angular.element(document.getElementsByClassName('kind-item'));
                var service = angular.element(document.getElementsByClassName('services'));

                item[0].className = 'col-md-4 kind-item active';

                item.on('click', function() {
                    for (var i = item.length - 1; i >= 0; i--) {
                        item[i].className = 'col-md-4 kind-item';
                        service[i].className = 'services';
                    }
                    this.className = 'col-md-4 kind-item active';
                    var s = this.attributes[1].value;
                    console.log(s);
                    service[s - 1].className = 'services active';
                });

                service[0].className = 'services active';
            });
        }
    }
});

beach.filter('timeSeparate', function() {

    return function(input, second) {
        if (input) {
            input = input.split(',');

            if (second) {
                return input[1];
            } else {
                return input[0];
            }
        }
    }
});

beach.filter('currentDate', function($filter) {
    return function() {
        return $filter('date')(new Date(), 'yyyy-MM-dd');
    }
});

beach.controller('Main', function($scope, $rootScope, $timeout, $http, $filter, $window) {

    $scope.auth = function(a) {
        $http({
            url: '',
            method: 'get',
            params: {
                login: a.login,
                password: a.password
            }
        }).then(function(data) {

        });
    }

    $scope.register = function(r) {
        if (r.pass === r.spass) {
            $http({
                url: '',
                method: 'get',
                params: {
                    firstname: r.firstname,
                    lastname: r.lastname,
                    family: r.family,
                    email: r.email,
                    login: r.login,
                    password: r.pass
                }
            }).then(function(data) {

            });
        }
    }

    $scope.showHelp = function() {
        var help = angular.element(document.getElementById('help'));
        help[0].style.opacity = 1;
    }

    $scope.sendCorporate = function(corp) {
        $http({
            url: 'api/v1/send/corporate/order',
            method: 'POST',
            params: {
                name: corp.name,
                phone: corp.phone,
                organization: corp.nameOrganize,
                text: corp.target
            }
        }).then(function(data) {
            if (data.data.result === true) {
                document.getElementsByClassName('modal-corporate')[0].style.display = 'none';
                document.getElementsByClassName('blur-content')[0].style.filter = 'blur(0)';

            }
        });
    }

    /*** ОТКРЫТЬ МОДАЛЬНОЕ ОКНО РЕЗЕРВАЦИИ ***/
    $scope.openModal = function(field, fieldType, fieldNume) {

        $scope.numField = fieldNume;
        localStorage.setItem('fieldType', fieldType);

        var date = $filter('date')(new Date(), 'yyyy-MM-dd');
        $scope.busyDate(fieldType, date);

        if (field == 'football') {
            $scope.type = 'Футбольное поле';
            $scope.typeS = 'футбольного поля';
            //localStorage.setItem('fieldType', 2);
        } else if (field == 'volleyball') {
            $scope.type = 'Волейбольное поле';
            $scope.typeS = 'волейбольного поля';
            //localStorage.setItem('fieldType', 1);
        } else if (field == 'tennis') {
            $scope.type = 'Теннисное поле';
            $scope.typeS = 'теннисного поля';
            //localStorage.setItem('fieldType', 3);
        } else {
            $scope.type = 'Бронирование всего комплекса';
            $scope.typeS = 'всего комплекса';
            //localStorage.setItem('fieldType', 4);
        }

        var modal = angular.element(document.getElementsByClassName('reserve-field'));
        var blur = angular.element(document.getElementsByClassName('blur-content'));
        var close = angular.element(document.getElementsByClassName('closeModal'));

        close[0].style.display = 'block';

        blur[0].style.filter = 'blur(10px)';

        modal[0].style.display = 'block';

        setTimeout(function() {
            modal[0].style.opacity = 1;
            modal[0].style.transform = 'translateX(0)';
        }, 0);

        var digits = angular.element(document.getElementsByClassName('reserve-digits'));
        var state1 = angular.element(document.getElementsByClassName('state1'));
        var state2 = angular.element(document.getElementsByClassName('state2'));
        var state3 = angular.element(document.getElementsByClassName('state3'));

        digits[0].style.backgroundPosition = "0 0";
        digits[1].style.backgroundPosition = "-46px -46px";
        digits[2].style.backgroundPosition = "-92px -46px";

        state1[0].style.display = 'block';

        var send = angular.element(document.getElementById('send'));


        /** ПРОВЕРКА ПОЛЕЙ В STATE 1 **/
        var dateField = angular.element(document.getElementById('dateField')); // поле даты
        var timeField = angular.element(document.getElementsByClassName('timeField')); // поля времени
        var nextState1 = angular.element(document.getElementById('page1next')); // кнопка "Следующий шаг" в 1ом стейте
        var modalResult = angular.element(document.getElementsByClassName('modal-result'));
        nextState1.on('click', function() {
            if (!$scope.date && $scope.time) {
                var time = $scope.time.split(',');
                var date = $filter('date')(new Date(), 'yyyy-MM-dd');
                var from = date + ' ' + time[0];
                var to = date + ' ' + time[1];
            } else if ($scope.date && $scope.time) {
                var time = $scope.time.split(',');
                var from = $scope.date + ' ' + time[0];
                var to = $scope.date + ' ' + time[1];
            }

            $http({
                url: 'api/v1/check/free',
                method: 'get',
                params: {
                    position: localStorage.getItem('fieldType'),
                    from: from,
                    to: to
                }
            }).then(function successCallback(data) {
                $scope.checkDate = data.data.result;
                $scope.checkDateMes = data.data.message;
                $scope.checkDateType = data.data.type;
                if ($scope.date == undefined || $scope.date == '' || $scope.time == undefined || $scope.time == '' || $scope.checkDate == false) {
                    if ($scope.date == undefined || $scope.date == '') {
                        dateField[0].className = "form-control alertRed";
                        setTimeout(function() {
                            dateField[0].className = "form-control";
                        }, 2000);
                    } else {
                        dateField[0].parentNode.className = "input-group date";
                    }
                    if ($scope.time == undefined || $scope.time == '') {
                        timeField[0].className = "form-control timeField alertRed";
                        timeField[1].className = "form-control timeField alertRed";
                        setTimeout(function() {
                            timeField[0].className = "form-control timeField";
                            timeField[1].className = "form-control timeField";
                        }, 2000);
                    } else {
                        timeField[0].className = "form-control timeField";
                        timeField[1].className = "form-control timeField";
                    }
                    if ($scope.checkDate == false) {
                        modalResult[0].className = 'modal-result danger';

                        setTimeout(function() {
                            modalResult[0].className = 'modal-result';
                        }, 4000);
                    } else {

                    }
                } else {
                    dateField[0].parentNode.className = "input-group date";
                    timeField[0].className = "form-control timeField";
                    timeField[1].className = "form-control timeField";
                    states(2);
                }
            });
        });
        /** КОНЕЦ ПРОВЕРКА ПОЛЕЙ В STATE 1 **/

        /** ПРОВЕРКА ПОЛЕЙ В STATE 2 **/
        var nextState2 = angular.element(document.getElementById('page2next')); // кнопка "Следующий шаг" во 2ом стейте
        var firstnameField = angular.element(document.getElementsByName('firstname')); // поле Имя
        var phoneField = angular.element(document.getElementsByName('phone')); // поле телефон
        var emailField = angular.element(document.getElementsByName('email')); // поле email
        nextState2.on('click', function() {
            if ($scope.firstname == undefined || $scope.firstname == '' || $scope.phone == undefined || $scope.phone == '' || $scope.email == undefined || $scope.email == '') {
                if ($scope.firstname == undefined || $scope.firstname == '') {
                    firstnameField[0].className = "form-control alertRed";
                    setTimeout(function() {
                        firstnameField[0].className = "form-control";
                    }, 2000);
                } else {
                    firstnameField[0].className = "form-control";
                }
                if ($scope.phone == undefined || $scope.phone == '') {
                    phoneField[0].className = "form-control alertRed";
                    setTimeout(function() {
                        phoneField[0].className = "form-control";
                    }, 2000)
                } else {
                    phoneField[0].className = "form-control";
                }
                if ($scope.email == undefined || $scope.email == '') {
                    emailField[0].className = "form-control alertRed";
                    setTimeout(function() {
                        emailField[0].className = "form-control";
                    }, 2000);
                } else {
                    emailField[0].className = "form-control";
                }
            } else {
                firstnameField[0].className = "form-control";
                phoneField[0].className = "form-control";
                emailField[0].className = "form-control";
                states(3);
            }
        });
        /** КОНЕЦ ПРОВЕРКА ПОЛЕЙ В STATE 2 **/

        var backState2 = angular.element(document.getElementById('page2back'));
        backState2.on('click', function() {
            states(1);
        });
        var backState3 = angular.element(state3[0].children[6].children[0].children[0]);
        backState3.on('click', function() {
            states(2);
        });


        function setAlert(field) {
            field.className = "form-control alertRed";
        }

        function states(state) {
            if (state == 1) {
                digits[0].style.backgroundPosition = "0 0";
                digits[1].style.backgroundPosition = "-46px -46px";
                digits[2].style.backgroundPosition = "-92px -46px";
                // send[0].style.display = "none";
                state1[0].style.display = 'block';
                state2[0].style.display = 'none';
                state3[0].style.display = 'none';
            } else if (state == 2) {
                digits[0].style.backgroundPosition = "0 -46px";
                digits[1].style.backgroundPosition = "-46px 0";
                digits[2].style.backgroundPosition = "-92px -46px";
                // send[0].style.display = "none";
                state1[0].style.display = 'none';
                state2[0].style.display = 'block';
                state3[0].style.display = 'none';
            } else if (state == 3) {
                digits[0].style.backgroundPosition = "0 -46px";
                digits[1].style.backgroundPosition = "-46px -46px";
                digits[2].style.backgroundPosition = "-92px 0";
                // send[0].style.display = "block";
                state1[0].style.display = 'none';
                state2[0].style.display = 'none';
                state3[0].style.display = 'block';
            }
        }
    }

    $scope.sendQuestion = function(q) {
        $http({
            url: 'api/v1/send/ask',
            method: 'post',
            params: {
                name: q.name,
                phone: q.phone,
                text: q.message,
                field: 1
            }
        }).then(function(data) {
            if (data.data.result == true) {
                alert('Ваше сообщение отправлено');
            }
        })
    }

    $scope.busyDate = function(fieldType, date) {
        /** ФУНКЦИЯ ПРОВЕРКИ ДАТ **/
        // function busyDate() {
        //var date = $filter('date')(new Date(), 'yyyy-MM-dd');

        $timeout(function() {
            /** ЗАНЯТЫЕ МЕСТА **/
            $http({
                url: 'api/v1/orders/today',
                method: 'get',
                params: {
                    position: fieldType,
                    from: date
                }
            }).then(function successCallback(data) {
                $scope.timeBusy = data.data;
                var rangeHighlights = [];
                var ticks = [];
                var ticks_positions = [];
                var ticks_labels = [];

                for (var i = $scope.timeBusy.length - 1; i >= 0; i--) {
                    var sh = new Date($scope.timeBusy[i]['reserved_from']).getHours();
                    var sm = new Date($scope.timeBusy[i]['reserved_from']).getMinutes();
                    var eh = new Date($scope.timeBusy[i]['reserved_to']).getHours();
                    var em = new Date($scope.timeBusy[i]['reserved_to']).getMinutes();

                    var start = funCount(sh, sm);
                    var end = funCount(eh, em);
                    rangeHighlights.push({ "start": start, "end": end });

                    ticks.push(start, end);
                    ticks_positions.push(start / 240 * 100, end / 240 * 100);

                    ticks_labels.push(addZero(sh) + ':' + addZero(sm));
                    ticks_labels.push(addZero(eh) + ':' + addZero(em));
                }
                rangeHighlights.push({ "start": 20, "end": 70 }); /** ЧАСЫ РАБОТЫ С 7 УТРА И ДО 2 НОЧИ **/
                ticks.push(0, 20, 70, 240);
                ticks_positions.push(0, 20 / 240 * 100, 70 / 240 * 100, 240 / 240 * 100);
                ticks_labels.push('00:00', '02:00', '07:00', '00:00');


                /** ПЕРЕВОД ВЕРМЕНИ **/
                function funCount(h, m) {
                    if (m % 30 == 0 && m != 0) {
                        if (h == 0) {
                            return 5;
                        } else {
                            return h * 10 + 5;
                        }
                    } else {
                        if (h == 0) {
                            return 0;
                        } else {
                            return h * 10;
                        }
                    }
                }

                /** ПРОЦЕНТ ОТ ДНЯ **/
                function procDay() {

                }

                /** ДОБАВЛЕНИЕ НУЛЕЙ **/
                function addZero(i) {
                    return (i < 10) ? "0" + i : i;
                }

                /** ИНТЕРВАЛ **/
                $rootScope.slider = new Slider("#ex16b", {
                    id: 'beachRange',
                    min: 0,
                    max: 240,
                    value: [70, 100],
                    focus: true,
                    step: 5,
                    rangeHighlights: rangeHighlights,
                    ticks: ticks,
                    ticks_positions: ticks_positions,
                    ticks_labels: ticks_labels
                });
            });
        });
        // }
    }

    $scope.update = function(date, fieldType) {
        console.log(date, fieldType);
        document.getElementById('beachRange').remove();
        $scope.busyDate(fieldType, date);
    }
    $scope.send = function(numField, time, datel, surname, firstname, lastname, phone, email) {

        var time = time.split(',');
        var from = datel + ' ' + time[0];
        var to = datel + ' ' + time[1];

        $http({
            url: "api/v1/orders/make",
            method: "post",
            params: {
                field_type: localStorage.getItem('fieldType'),
                position: numField,
                from: from,
                to: to,
                name: firstname,
                surname: surname,
                patronymic: lastname,
                phone: phone,
                email: email
            }
        }).then(function successCallback(data) {
            var modalResult = angular.element(document.getElementsByClassName('modal-result'));

            if ($scope.checkDateType == 'success') {
                modalResult[0].className = 'modal-result success';
            } else {
                modalResult[0].className = 'modal-result danger';
            }
            setTimeout(function() {
                modalResult[0].className = 'modal-result';
            }, 4000);

            $scope.responce = data.data.message;
            $scope.checkDate = data.data.result;
            $scope.checkDateMes = data.data.message;
            $scope.checkDateType = data.data.type;

            $scope.closeModal();
        });
    }

    /*** ЗАКРЫТЬ МОДАЛЬНОЕ ОКНО РЕЗЕРВАЦИИ ***/
    $scope.closeModal = function() {
        var state2 = angular.element(document.getElementsByClassName('state2'));
        var state3 = angular.element(document.getElementsByClassName('state3'));
        state2[0].style.display = 'none';
        state3[0].style.display = 'none';
        document.getElementById('beachRange').remove();
        localStorage.clear('fieldType');
        $scope.field = '';
        $scope.reserve = false;
        $scope.type = '';
        $scope.time = '';
        $scope.date = '';
        $scope.surname = '';
        $scope.firstname = '';
        $scope.lastname = '';
        $scope.phone = '';
        $scope.email = '';

        var modal = angular.element(document.getElementsByClassName('reserve-field'));
        //var modalReserve = angular.element(document.getElementsByClassName('modal-reserve'));
        var blur = angular.element(document.getElementsByClassName('blur-content'));
        var close = angular.element(document.getElementsByClassName('closeModal'));

        close[0].style.display = 'none';

        blur[0].style.filter = 'blur(0)';

        modal[0].style.opacity = 0;
        modal[0].style.transform = 'translateX(250px)';

        setTimeout(function() {
            //modalReserve[0].style.display = 'none';
            modal[0].style.display = 'none';
            modal[0].style.transform = 'translateX(-250px)';
        }, 300);
    }

    /*** ОТПРАВКА НА ПОЧТУ ***/
    $scope.mail = function(message) {}


    /** ОТКРЫТЬ МОБИЛЬНУЮ МОДАЛКУ **/
    $scope.openMobile = function(type) {
        if (type == 'football') {
            $scope.typeSport = 'Футбольное поле';
            $scope.fieldCount = [{ num: 1, fieldType: 4 }];
        } else if (type == 'volleyball') {
            $scope.typeSport = 'Волейбольное поле';
            $scope.fieldCount = [{ num: 1, fieldType: 1 }, { num: 2, fieldType: 2 }, { num: 3, fieldType: 3 }, { num: 4, fieldType: 5 }];
        } else if (type == 'tennis') {
            $scope.typeSport = 'Теннисное поле';
            $scope.fieldCount = [{ num: 1, fieldType: 6 }, { num: 2, fieldType: 7 }];
        } else {
            $scope.typeSport = 'Весь комплекс';
            $scope.fieldCount = 8;
        }

        $scope.times = ['00:00', '00:30', '01:00', '01:30', '02:00', '07:00', '07:30', '08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30', '20:00', '20:30', '21:00', '21:30', '22:00', '22:30', '23:00', '23:30'];

        var modal = angular.element(document.getElementsByClassName('mobile-modal'));

        modal[0].style.display = 'block';
        modal[0].style.opacity = '1';
    };

    $scope.getPoloski = function(date, field) {
        $http({
            url: 'api/v1/orders/today',
            method: 'get',
            params: {
                position: field,
                from: date
            }
        }).then(function successCallback(data) {
            var reserv = data.data;

            $scope.reservere = reserv;

            $scope.ranges = timeRange(reserv);

            function timeRange(reserv) {
                if (reserv.length == 0) {
                    $scope.firstRangeCount = proc24(19);
                    $scope.firstRangeFrom = '07:00';
                    $scope.firstRangeTo = '02:00';
                } else {
                    var ranges = [];
                    ranges.push({ from: getDate(reserv[0], 'from'), to: '07:00', count: proc24(12) });
                    for (var i = 0; i <= 0; i++) {
                        ranges.push({ from: getDate(reserv[i + 1], 'from'), to: getDate(reserv[i], 'to'), count: proc24(12) });
                    }
                    ranges.push({ from: '02:00', to: getDate(reserv[reserv.length - 1], 'from'), count: proc24(12) });

                }
                return ranges;
            }

            function proc24(range) {
                return range / (24 / 100);
            }

            function getDate(date, x) {
                if (x == 'from') {
                    date = new Date(date.reserved_from).getHours() + ':' + new Date(date.reserved_from).getMinutes();
                } else if (x == 'to') {
                    date = new Date(date.reserved_to).getHours() + ':' + new Date(date.reserved_to).getMinutes();
                } else if (x == 'count') {

                }
                return date;
            }
        });
    }

    $scope.closeMobile = function() {
        var modal = angular.element(document.getElementsByClassName('mobile-modal'));

        modal[0].style.display = 'none';
        modal[0].style.opacity = '0';
    }

    $scope.sendMobile = function(data) {
        console.log(data);
        if (data.selectedField == null) {
            alert('поле не выбрано');
        } else if (data.from == null) {
            alert('от не задано');
        } else if (data.to == null) {
            alert('до не задано');
        } else if (data.mobileDate == null) {
            alert('дата не задано');
        } else if (data.phone == null) {
            alert('Номер телефона не задан');
        } else if (data.name == null) {
            alert('Имя не задано');
        } else if (data.last_name == null) {
            alert('Фамилия не задана');
        } else if (data.email == null) {
            alert('Почта на указана');
        } else {
            // $http({
            // 	url: 'http://beach-api.mk-cms.ru/api/v1/check/free',
            // 	method: 'get',
            // 	params: {
            // 		position: data.selectedField,
            // 		from: data.from,
            // 		to: data.to
            // 	}
            // }).then(function successCallback(data) {
            // 	console.log(data);
            // });
            var from = data.mobileDate + ' ' + data.from;
            var to = data.mobileDate + ' ' + data.to;
            $http({
                url: "api/v1/orders/make",
                method: "post",
                params: {
                    field_type: data.selectedField,
                    position: data.selectedField,
                    from: from,
                    to: to,
                    name: data.name,
                    surname: data.lastname,
                    patronymic: data.last_name,
                    phone: data.phone,
                    email: data.email
                }
            }).then(function successCallback(data) {
                console.log('dsa');
                console.log(data.data);

                if (data.data.result != true) {
                    alert(data.data.message);
                } else if (data.data.result == true) {
                    alert(data.data.message);
                    $scope.closeMobile();
                }
            });
        }

    }

    // $scope.updateMobile = function(date, type) {
    // 	//console.log(date, fieldType);
    // 	//document.getElementById('beachRange').remove();
    // 	//$scope.busyDate(fieldType, date);
    // }
});