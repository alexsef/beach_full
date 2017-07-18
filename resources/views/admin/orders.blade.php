@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <input type="date" id="date" value="{{ $date }}">
                <table class="table">
                    <caption>Список заказов</caption>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Пользователь</th>
                            <th>Тип поля</th>
                            <th>Номер поля</th>
                            <th>Начало брони</th>
                            <th>Конец брони</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>{{ $order['order_id'] }}</td>
                                @if($order->user)
                                    <td><a href="/users/{{ $order->user->id }}">{{ $order->user->fullname }}</a></td>
                                @else
                                    <td>Незарегистрированный пользователь</td>
                                @endif
                                <td>{{ $order->field->name }}</td>
                                <td>{{ $order->position }}</td>
                                <td>{{ $order->reserved_from }}</td>
                                <td>{{ $order->reserved_to }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td>Список пуст</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#date').on('change', function () {
                window.location = '/orders?date=' + $('#date').val();
            });
        });
    </script>
@endsection
