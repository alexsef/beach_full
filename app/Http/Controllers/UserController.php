<?php namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use App\Order;
use App\User;
use Storage;
use Auth;

/**
 * Class UserController
 * @author Павел Мясоедов <meatfay@gmail.com>
 * @package App\Http\Controllers
 */
class UserController extends Controller {
    /**
     * UserController конструктор. Проверяет авторизированность пользователя.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Dashboard пользовтеля. Отображает сводную информацию о пользователе
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $user = Auth::user();
        $ordesCount = Order::where('user_id', Auth::id())->count();
        $avatar = $user->avatar ? "/avatars/$user->avatar" : '/img/avatar.png';
        return view('user.dashboard', [
            'user' => $user,
            'avatar' => $avatar,
            'ordersCount' => $ordesCount
        ]);
    }

    /**
     * Страница заказов пользователя.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userOrders() {
        $orders = Order::where('user_id', Auth::id())->get();
        $fields = config('fields.fields');

        return view('user.orders', [
            'orders' => $orders,
            'fields' => $fields
        ]);
    }

    /**
     * Страница редактирования настроек пользовательских данных.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settingsView() {
        $user = Auth::user();
        $avatar = $user->avatar ? "/avatars/$user->avatar" : '/img/avatar.png';
        return view('user.settings', [
            'user' => $user,
            'avatar' => $avatar
        ]);
    }

    /**
     * Сохраняет измененные данные пользователя в БД.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function settingsSave(Request $request) {
        $this->validate($request, [
            'name' => 'required|string',
            'surname' => 'required|string',
            'patronymic' => 'required|string',
            'phone' => 'required|string',
            'avatar' => 'file|image',
        ]);

        $path = Auth::user()->avatar;

        if($request->file('avatar')) {
            $newName = $newName = md5($request->file('avatar')->getClientOriginalName())
                        . "." . $request->file('avatar')->getClientOriginalExtension();

            $path = Storage::disk('avatars')->putFileAs(Auth::id(), $request->file('avatar'), $newName);
        }
        $fullname = $request->input('surname') . " " . $request->input('name') . " " . $request->input('patronymic');

        User::where('id', Auth::id())
            ->update([
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
                'patronymic' => $request->input('patronymic'),
                'fullname' => $fullname,
                'phone' => $request->input('phone'),
                'avatar' => $path
            ]);

        return redirect('/settings')
            ->with('status', 'Ваши настройки успешно сохранены');
    }

    /**
     * Страница формы для отрпавки вопросов поддержке
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function supportView() {
        return view('user.support');
    }

    /**
     * Отправка вопроса пользователя для поддержки.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function supportSend(Request $request) {
        $this->validate($request, [
            'message' => 'required|string|min:10'
        ]);

        $user = Auth::user();
        $message = "Пользователь {$user->fullname} <br> {$user->email} <br> Задал вопрос:<br>";
        $message .= $request->message;

        \mail("meatfay@gmail.com", "Вопрос от клиента", $message, "Content-type:text/html;charset=utf-8");

        return redirect('/support')
            ->with('status', 'Сообщение успешно отправлено. Менеджер в скором времени свяжется с Вами!');
    }

    public function toCoach() {
        return view('user.coach');
    }

    public function review() {
        // code...
        return view('user.review');
    }

    public function reviewSend(Request $request) {
        $this->validate($request, [
            'message' => 'required|string|min:10'
        ]);

        Review::insertGetId([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'status' => '0'
        ]);

        return redirect('/review')->with('status', 'Отзыв успешно отправлен.');
    }
}