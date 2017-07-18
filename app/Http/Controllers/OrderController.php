<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PriceEvent;
use Carbon\Carbon;
use App\Order;
use App\User;
use Auth;

class OrderController extends Controller
{
    public function sendMail(Request $request)
    {
        $name_user = $request->input('name_user');
        $phone_user = $request->input('phone_user');
        $organization_user = $request->input('organization_user');
        $target_user = $request->input('target_user');

        if($request->input('name_user')) {
            $subject="=?utf-8?B?". base64_encode("Заявка от компании с сайта ЦПС Пляж"). "?=";
            $message = "Поступила новая заявка <br> Пользователь: {$name_user}<br>";
            $message .= "Мобильный номер клиента:  {$phone_user} <br>";
            $message .= "Организация:  {$organization_user} <br>";
            $message .= "Дополнительная информация:  {$target_user} <br>";

            $headers= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n";
            $headers .= 'From: Заказ на Пляже <zakaz@plyazhspb.ru>' . "\r\n";

            mail('zakaz@plyazhspb.ru', $subject, $message, $headers);
        }
            return redirect('/');
    }

    /**
     * Создание заказа поля
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function makeOrder(Request $request)
    {
        $validationArray = [
            'field_type' => 'required|numeric',
            'position' => 'required|numeric',
            'from' => 'required',
            'to' => 'required'
        ];
        $fields = [
            "Все поля", 
            "Волейбольное поле №1", 
            "Волейбольное поле №2",
            "Волейбольное поле №3",
            "Футбольное поле №4",
            "Три волейбольных поля №5 (Вместо футбольного)",
            "Теннисное поле №6",
            "Теннисное поле №7",
        ];

        if (Auth::check()) {
            $user = Auth::user();
        } else {
            $user = User::whereEmail($request->email)->first();
        }

        if (!$user) {
            $validationArray['name'] = 'required|string';
            //$validationArray['surname'] = 'required|string';
            //$validationArray['patronymic'] = 'required|string';
            $validationArray['phone'] = 'required';
            $validationArray['email'] = 'required|email|unique:users';

            $this->validate($request, $validationArray);
        }

        $surname = $request->surname ? $request->surname : '';
        $patronymic = $request->patronymic ? $request->patronymic : '';

        $to = Carbon::parse(preg_replace("/24:00/", "00:00", $request->to));
        $from = Carbon::parse($request->from);

        $toCheck = Carbon::parse(preg_replace("/24:00/", "00:00", $request->to));
        $fromCheck = Carbon::parse($request->from);

        $toMail = $to->format("h:i");
        $fromMail = $from->format("h:i");
        $dateTo = $to->format("d-m-Y");

        if ($from < Carbon::now()) {
            return response()->json([
                'result' => false,
                'type' => 'danger',
                'message' => 'Невозможно забронировать время в прошлом'
            ]);
        }
        if ((($from->hour >= 2 && $from->hour < 7) || ($to->hour >= 2 && $from->hour < 7))) {
            return response()->json([
                'result' => false,
                'type' => 'danger',
                'message' => 'Мы не работвем с 2 до 7'
            ]);
        }

        $ordersToday = Order::whereDate('reserved_from', $fromCheck->toDateString())
            ->where('position', $request->position)
            ->where(function ($q) use ($toCheck, $fromCheck) {
                $q->where(function ($q) use ($toCheck, $fromCheck) {
                    $q->where('reserved_from', '>', $fromCheck)
                        ->where('reserved_to', '<', $toCheck);
                })
                    ->orWhere(function ($q) use ($toCheck, $fromCheck) {
                        $q->where('reserved_from', '<', $fromCheck)
                            ->where('reserved_to', '>', $toCheck);
                    })
                    ->orWhere(function ($q) use ($toCheck, $fromCheck) {
                        $q->whereBetween('reserved_from', [$fromCheck->addMinute(), $toCheck->subMinute()])
                            ->orWhere(function ($q) use ($toCheck, $fromCheck) {
                                $q->whereBetween('reserved_to', [$fromCheck->addMinute(), $toCheck->subMinute()]);
                            });
                    });
            })
            ->get();

        $events = PriceEvent::where('status', 1)->get();

        $activeEvents = $events->filter(function($value, $key) {
            if(Carbon::parse($value->ended_at)->lt(Carbon::now())) {
                PriceEvent::where('price_event_id', $value->price_event_id)->update([
                    'status' => 0
                ]);
                return false;
            } else {
                return true;
            }
        });

        $event = $activeEvents->first();

        if ($request->position == config('fields.positions.allfields')) {
            if(!$ordersToday->isEmpty()) {
                return response()->json([
                    'result' => false,
                    'type' => 'danger',
                    'message' => 'На данный день уже есть забронированные поля'
                ]);
            }
            if (!$user) {
                $password = str_random(6);
                $user = User::insertGetId([
                    'user_group' => 1,
                    'name' => $request->name,
                    'surname' => $surname,
                    'patronymic' => $patronymic,
                    'fullname' => $request->surname . " " . $request->name . " " . $request->patronymic,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => bcrypt($password),
                ]);
                //mail($request->email, "Заказ", "{$password}","Content-type:text/html;charset=utf-8");
                $user = User::find($user);
            }

            $discount = 0;
            $userOrders = Order::where('user_id', $user->id)->count();
            if($userOrders != 0) {
                if(($userOrders + 1) % 2 == 0) {
                    $discount = 50;
                } elseif($userOrders % 10 == 0) {
                    $discount = 100;
                }

            }

            // if($event) {
                // $discount = $this->calculateEvent($event, ++$userOrders);
            // }

            $orderId = $this->createOrder([
                'field_id' => 4,
                'field_as' => 0,
                'user_id' => $user->id,
                'position' => 0,
                'discount' => $discount,
                'reserved_from' => $from,
                'reserved_to' => $to
            ]);
            if ($orderId) {
                $message = "Создан новый заказ <br> Пользователь: {$user->fullname}<br>";
                $message .= "Почта клиента: {$user->email} <br>";
                $message .= "Мобильный номер клиента:  {$user->phone} <br>";
                $message .= "Поле:  {$fields[0]} <br>";
                $message .= "Дата заказа: {$dateTo} <br>";
                $message .= "Время заказа: {$fromMail} - {$toMail} <br>";

                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type:text/html;charset=utf-8' . "\r\n";
                $headers .= 'From: Заказ на Пляже <zakaz@plyazhspb.ru>' . "\r\n";
                mail('zakaz@plyazhspb.ru', "Заказ #{$orderId}", "Заказ #{$orderId}. <br>".$message, $headers);

                $message = "Ваш заказ успешно создан! <br>";
                $message .= "Номер Вашего заказа: {$orderId} <br>";
                $message .= "Вы заказали поле:  {$fields[0]} <br>";
                $message .= "Дата заказа: {$dateTo} <br>";
                $message .= "Время заказа: {$fromMail} - {$toMail} <br>";

                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type:text/html;charset=utf-8' . "\r\n";
                $headers .= 'From: Заказ на Пляже <zakaz@plyazhspb.ru>' . "\r\n";
                mail($request->email, "Заказ #{$orderId}", "Заказ #{$orderId}. <br>".$message, $headers);

                return response()->json([
                    'result' => true,
                    'type' => 'success',
                    'message' => 'Все поля успешно зарезервированы'
                ]);
            }
        }

        if ($ordersToday->isEmpty()) {
            if (!$user) {
                $password = str_random(6);
                $user = User::insertGetId([
                    'user_group' => 1,
                    'name' => $request->name,
                    'surname' => $surname,
                    'patronymic' => $patronymic,
                    'fullname' => $request->surname . " " . $request->name . " " . $request->patronymic,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => bcrypt($password),
                ]);
                //mail($request->email, "Заказ", "{$password}","Content-type:text/html;charset=utf-8");
                $user = User::find($user);
            }

            $discount = 0;
            $userOrders = Order::where('user_id', $user->id)->count();
            if($userOrders != 0) {
                if(($userOrders + 1) % 2 == 0) {
                    $discount = 50;
                } elseif($userOrders % 10 == 0) {
                    $discount = 100;
                }
            }

            // if($event) {
            //     $discount = $this->calculateEvent($event, ++$userOrders);
            // }

            $orderId = $this->createOrder([
                'field_id' => 0,
                'user_id' => $user->id,
                'field_as' => 0,
                'position' => $request->position,
                'discount' => $discount,
                'reserved_from' => $from,
                'reserved_to' => $to
            ]);
            $message = "Создан новый заказ <br> Пользователь: {$user->fullname}<br>";
            $message .= "Почта клиента: {$user->email} <br>";
            $message .= "Мобильный номер клиента:  {$user->phone} <br>";
            $message .= "Поле:  {$fields[$request->position]} <br>";
            $message .= "Дата заказа: {$dateTo} <br>";
            $message .= "Время заказа: {$fromMail} - {$toMail} <br>";

            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type:text/html;charset=utf-8' . "\r\n";
            $headers .= 'From: Заказ на Пляже <zakaz@plyazhspb.ru>' . "\r\n";
            mail('zakaz@plyazhspb.ru', "Заказ #{$orderId}", "Заказ #{$orderId}. <br>".$message, $headers);

            $message = "Ваш заказ успешно создан! <br>";
            $message .= "Номер Вашего заказа: {$orderId} <br>";
            $message .= "Вы заказали поле:  {$fields[$request->position]} <br>";
            $message .= "Дата заказа: {$dateTo} <br>";
            $message .= "Время заказа: {$fromMail} - {$toMail} <br>";

            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type:text/html;charset=utf-8' . "\r\n";
            $headers .= 'From: Заказ на Пляже <zakaz@plyazhspb.ru>' . "\r\n";
            mail($request->email, "Заказ #{$orderId}", "Заказ #{$orderId}. <br>".$message, $headers);

            return response()->json([
                'result' => true,
                'type' => 'success',
                'message' => 'Поле было успешно зарезервировано'
            ]);
        } else {
            return response()->json([
                'result' => false,
                'type' => 'danger',
                'message' => 'Данное поле занято в указанное время'
            ]);
        }
    }

    public function sendQuestion(Request $request)
    {
        $validationArray['name'] = 'required|string';
        $validationArray['phone'] = 'required';
        $validationArray['text'] = 'required';

        $this->validate($request, $validationArray);

        $message = "Вопрос задал: {$request->name}<br>";
        $message .= "Номер для связи: {$request->phone}<br>";
        $message .= "Вопрос: {$request->text}";

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type:text/html;charset=utf-8' . "\r\n";
        $headers .= 'From: Вопрос с Пляжа <vopros@plyazhspb.ru>' . "\r\n";
        mail("vopros@plyazhspb.ru", "Вопрос с сайта", $message, $headers);
        return response()->json(['result' => true]);
    }

    public function orderCorporate(Request $request)
    {
        $validationArray['name'] = 'required|string';
        $validationArray['phone'] = 'required';
        $validationArray['organization'] = 'required';
        $validationArray['text'] = 'required';

        $this->validate($request, $validationArray);

        $message = "Пользователь {$request->name} из компании  {$request->organization} оставил заявку";
        $message .= "Номер для связи: {$request->phone}<br>";
        $message .= "Описание заказа: {$request->text}";

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type:text/html;charset=utf-8' . "\r\n";
        $headers .= 'From: Инфо с Пляжа <info@plyazhspb.ru>' . "\r\n";
        mail("info@plyazhspb.ru", "Вопрос с сайта", $message, $headers);
        return response()->json(['result' => true]);
    }

    public function checkOrder(Request $request)
    {
        $to = Carbon::parse(preg_replace("/24:00/", "00:00", $request->to));
        $from = Carbon::parse($request->from);
        if ($from < Carbon::now()) {
            return response()->json([
                'result' => false,
                'type' => 'danger',
                'message' => 'Невозможно забронировать время в прошлом'
            ]);
        }
        if ((($from->hour >= 2 && $from->hour < 7) || ($to->hour >= 2 && $from->hour < 7))) {
            return response()->json([
                'result' => false,
                'type' => 'danger',
                'message' => 'Мы не работвем с 2 до 7'
            ]);
        }
        $ordersToday = Order::whereDate('reserved_from', $from->toDateString())
            ->where('position', $request->position)
            ->where(function ($q) use ($to, $from) {
                $q->where(function ($q) use ($to, $from) {
                    $q->where('reserved_from', '>', $from)
                        ->where('reserved_to', '<', $to);
                })
                    ->orWhere(function ($q) use ($to, $from) {
                        $q->where('reserved_from', '<', $from)
                            ->where('reserved_to', '>', $to);
                    })
                    ->orWhere(function ($q) use ($to, $from) {
                        $q->whereBetween('reserved_from', [$from->addMinute(), $to->subMinute()])
                            ->orWhere(function ($q) use ($to, $from) {
                                $q->whereBetween('reserved_to', [$from->addMinute(), $to->subMinute()]);
                            });
                    });
            })
            ->get();
        if($request->position == 0 && !$ordersToday->isEmpty()) {
            return response()->json([
                'result' => false,
                'type' => 'danger',
                'message' => 'На данный день уже есть забронированные поля'
            ]);
        }
        return $ordersToday->isEmpty() ? response()->json([
            'result' => true,
            'type' => 'success',
            'message' => 'Поле свободно'
        ]) : response()->json([
            'result' => false,
            'type' => 'danger',
            'message' => 'Поле занято'
        ]);
    }

    public function getOrdersToday(Request $request)
    {
        $orders = Order::whereDate('reserved_from', Carbon::parse($request->from))
            ->where('position', $request->position)
            ->get();
        //if ($request->type = config('fields.types.volleyball')) {
            $mid = $bot = $top = $topright = $leftf = $bottomright = $left = [];
            foreach ($orders as $order) {
                switch ($order->position) {
                    case config('fields.positions.top'):
                        $top[] = [
                            'reserved_from' => $order->reserved_from,
                            'reserved_to' => $order->reserved_to,
                        ];
                        break;
                    case config('fields.positions.middle'):
                        $mid[] = [
                            'reserved_from' => $order->reserved_from,
                            'reserved_to' => $order->reserved_to,
                        ];
                        break;
                    case config('fields.positions.bottom'):
                        $bot[] = [
                            'reserved_from' => $order->reserved_from,
                            'reserved_to' => $order->reserved_to,
                        ];
                        break;
                    case config('fields.positions.left'):
                        $left[] = [
                            'reserved_from' => $order->reserved_from,
                            'reserved_to' => $order->reserved_to,
                        ];
                        break;
                    case config('fields.positions.leftf'):
                        $leftf[] = [
                            'reserved_from' => $order->reserved_from,
                            'reserved_to' => $order->reserved_to,
                        ];
                        break;
                    case config('fields.positions.topright'):
                        $topright[] = [
                            'reserved_from' => $order->reserved_from,
                            'reserved_to' => $order->reserved_to,
                        ];
                        break;
                    case config('fields.positions.bottomright'):
                        $bottomright[] = [
                            'reserved_from' => $order->reserved_from,
                            'reserved_to' => $order->reserved_to,
                        ];
                        break;
                }
            }
            if ($request->position == config('fields.positions.top')) {
                return response()->json($top);
            } elseif ($request->position == config('fields.positions.middle')) {
                return response()->json($mid);
            } elseif ($request->position == config('fields.positions.bottom')) {
                return response()->json($bot);
            } elseif ($request->position == config('fields.positions.left')) {
                return response()->json($left);
            } elseif ($request->position == config('fields.positions.leftf')) {
                return response()->json($leftf);
            } elseif ($request->position == config('fields.positions.topright')) {
                return response()->json($topright);
            } elseif ($request->position == config('fields.positions.bottomright')) {
                return response()->json($bottomright);
            } else {
                return response()->json([
                    'error' => 'no postition',
                ]);
            }
        //}
    }

    private function calculateEvent($event, $ordersCount)
    {
        if (Carbon::parse($event->ended_at)->lt(Carbon::now())) {
            return '100%';
        }

        //Каждый n день
        if ($event->type == 0) {
            if ($ordersCount % $event->value == 0) {
                return $this->calculateMeasure($event);
            }
        }

        return '100%';
    }

    private function calculateMeasure($event)
    {
        $discount = '100%';

        if ($event->measure == 0) {
            $discount = $event->discount . '%';
        } elseif ($event->measure == 1) {
            $discount = $event->discount . ' руб.';
        }

        return $discount;
    }

    /**
     *
     * @param $data
     * @return int
     */
    private function createOrder($data)
    {
        return Order::insertGetId([
            'user_id' => $data['user_id'],
            'field_id' => $data['field_id'],
            'field_as' => $data['field_as'],
            'position' => $data['position'],
            'discount' => $data['discount'],
            'status' => 0,
            'reserved_from' => $data['reserved_from'],
            'reserved_to' => $data['reserved_to']
        ]);
    }
}
