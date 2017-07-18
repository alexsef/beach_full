<?php namespace App\Http\Controllers;

use App\PriceEvent;
use App\Review;
use App\Slide;
use App\Slider;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Order;
use App\Page;
use App\User;
use Storage;

/**
 * Class AdminController
 * @author Павел Мясоедов <meatfay@gmail.com>
 * @package App\Http\Controllers
 */
class AdminController extends Controller {
    /**
     * AdminController конструктор. Проверяет авторизированность администратора.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Dashboard администратора. Выводит 5 последних заказов и
     * 5 последних зарегистрированных пользователей
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $orders = Order::with('user')->orderBy('order_id', 'desc')->take(5)->get();
        $latestUsers = User::with('orders')->orderBy('id', 'desc')->take(5)->get();

        $fields = config('fields.fields');
        $statuses = config('fields.statuses');

        return view('admin.dashboard', [
            'orders' => $orders,
            'fields' => $fields,
            'statuses' => $statuses,
            'users' => $latestUsers
        ]);
    }

    /**
     * Список заказов. Выдает все заказы,
     * разделенные постранично по 15 штук
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orders(Request $request) {
        $orders = Order::with('user');
        if($request->user && $request->user > 0) {
            $orders = $orders->where('user_id', $request->user);
        }
        $orders = $orders->orderBy('order_id', 'desc')->paginate(15);
        $fields = config('fields.fields');
        $statuses = config('fields.statuses');

        return view('admin.orders', [
            'orders' => $orders->appends(Input::except('page')),
            'fields' => $fields,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Возвращает JSON наполненный информацией о пользователе
     * для получения инфы о юзере из списка заказов
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserInfo(Request $request) {
        if($request->user_id) {
            $user = User::with('orders')->where('id', $request->user_id)->first();

            if($user) {
                $avatar = $user->avatar ? "/avatars/$user->avatar" : '/img/avatar.png';

                return response()->json([
                    'result' => true,
                    'data' => [
                        'avatar' => $avatar,
                        'user_id' => $user->id,
                        'fullname' => $user->fullname,
                        'phone' => $user->phone,
                        'email' => $user->email,
                        'register_date' => $user->created_at,
                        'orders_count' => $user->orders->count()
                    ]
                ]);
            }
        } else {
            return response()->json([
                'result' => false,
                'message' => 'Can not find needed param'
            ]);
        }
    }


    /**
     * Обновялет информацию о заказа со страницы просмотра заказа.
     * В ответ отпраляет отрендеренный HTML строки таблицы с данным заказом.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function saveOrderData(Request $request) {
        $order = Order::where('order_id', $request->order_id)->first();
        $user = User::where('id', $order->user_id)->first();

        $order->points = $request->points;
        $order->position = $request->field;
        $order->reserved_from = Carbon::parse($request->from);
        $order->reserved_to= Carbon::parse($request->to);
        $order->status = $request->status;

        $order->save();

        $fields = config('fields.fields');
        $statuses = config('fields.statuses');

        return view('admin.one_order_row', [
            'user' => $user,
            'order' => $order,
            'fields' => $fields,
            'statuses' => $statuses,
        ]);
    }


    /**
     * Удаление выбранного заказа.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteOrder(Request $request) {
        $order = Order::where('order_id', $request->order_id)->first();

        if($order) {
            if($order->delete()) {
                return response()->json([
                    'result' => true
                ]);
            }
            return response()->json([
                'result' => false,
                'message' => 'Не удалось удалить заказ'
            ]);
        }
        return response()->json([
            'result' => false,
            'message' => 'Не удалось найти выбранный заказ. Возможно он уже был удален.'
        ]);
    }

    /**
     * Таблица пользователей
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function users() {
        $users = User::with('orders')->where('user_group', 1)->orderBy('id', 'desc')->paginate(15);

        return view('admin.users', [
            'users' => $users
        ]);
    }

    public function review() {
        $reviews = Review::with('user')->orderBy('status')->paginate(15);

        $statuses = [
            ['id' => '0', 'text' => 'Не отображать'],
            ['id' => '1', 'text' => 'Отображать'],
        ];

        return view('admin.reviews', [
            'reviews' => $reviews,
            'statuses' => $statuses
        ]);
    }

    public function updateReview(Request $request) {
        Review::where('review_id', $request->review_id)->update([
            'message' => $request->message,
            'status' => $request->status
        ]);

        return response()->json([
            'result' => true
        ]);
    }

    public function deleteReview(Request $request) {
        Review::where('review_id', $request->review_id)->delete();

        return response()->json([
            'result' => true
        ]);
    }

    public function discounts() {
        return view('admin.discounts');
    }

    public function jsonDiscounts() {
        $events = PriceEvent::all();
        $discounts = [];
        foreach ($events as &$event) {
            $discounts[] = [
                'id' => $event->price_event_id,
                'name' => $event->name,
                'type' => $event->type,
                'discount' => $event->discount,
                'value' => $event->value,
                'measure' => $event->measure,
                'status' => $event->status,
                'ended_at' => $event->ended_at
            ];
        }
        return response()->json($discounts);
    }

    public function deleteDiscount(Request $request) {
        if($request->id) {
            PriceEvent::where('price_event_id', $request->id)->delete();
        }
    }

    public function addDiscount(Request $request) {

    }

    public function updateDiscount(Request $request) {

    }

    /**
     * Список страниц возможных для редактирования
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPageList() {
        $pages = Page::with('child')
            ->where('parent_id', 0)
            ->where('type', 1)
            ->get();

        $news = Page::where('parent_id', 0)
            ->where('type', 2)
            ->get();

        $sliders = Slider::All();

        return view('admin.pages', [
            'pages' => $pages,
            'news' => $news,
            'sliders' => $sliders
        ]);
    }

    /**
     * Страница редактирования страницы
     * @param $page_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPage($page_id) {
        $page = Page::where('page_id', $page_id)
            ->where('type', 1)
            ->first();
        $pages = Page::all();

        $parents = [];

        foreach ($pages as $p) {
            if($p->page_id != $page->page_id) {
                $parents[] = [
                    'id' => $p->page_id,
                    'title' => $p->title
                ];
            }
        }

        // Прекращает выполнение кода и выводит ошибку 404(Страница не найдена)
        // Если страница была не найдена.
        abort_if(!$page, 404, "Not Found");

        return view('admin.edit_page', [
            'page' => $page,
            'parents' => $parents
        ]);
    }

    /**
     * Сохранение измененных данных о странице
     * @param Request $request
     * @param $page_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function savePage(Request $request, $page_id) {
        $this->validate($request, [
            'title' => 'required|string|min:3',
            'content' => 'required|string',
        ]);

        Page::where('page_id', $page_id)
            ->where('type', 1)
            ->update([
            'title' => $request->input('title'),
            'parent_id' => $request->input('parent_id'),
            'content' => $request->input('content'),
            'meta_title' => $request->input('meta_title'),
            'meta_keywords' => $request->input('meta_keywords'),
            'meta_description' => $request->input('meta_description'),
        ]);
        return redirect()->back();
    }

    public function editNewsList() {
        return view('admin.newslist');
    }

    public function addNewsForm() {
        return view('admin.add_news');
    }

    public function addNews(Request $request) {
        $img = '';
        if($request->file('image')) {
            $now = Carbon::now();
            $file = $request->file('image');
            $newName = md5($file->getClientOriginalName()) . "." . $file->getClientOriginalExtension();
            $img = 'https://lk.plyazhspb.ru/uploads/' . Storage::disk('uploads')
                    ->putFileAs("{$now->day}{$now->month}{$now->year}", $file, "{$newName}");
        }
        Page::firstOrCreate([
            'parent_id' => 0,
            'type' => 2,
            'img' => $img,
            'title' => $request->title,
            'seo_url' => '',
            'content' => $request->input('content'),
            'preview' => $request->preview,
            'template' => '',
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'editable' => 1,
            'status' => 1,
        ]);
        return redirect('/admin/pages');
    }

    public function editNewsForm($news_id) {
        $news = Page::where('page_id', $news_id)
            ->where('type', 2)->first();

        abort_if(!$news, 404);
        return view('admin.edit_news', [
            'news' => $news
        ]);
    }

    public function saveNews(Request $request, $news_id) {
        $news = Page::where('page_id', $news_id)
            ->where('type', 2)->first();
        abort_if(!$news, 404);

        $img = $news->img;
        if($request->file('image')) {
            $now = Carbon::now();
            $file = $request->file('image');
            $newName = md5($file->getClientOriginalName()) . "." . $file->getClientOriginalExtension();
            $img = 'https://lk.plyazhspb.ru/uploads/' . Storage::disk('uploads')
                    ->putFileAs("{$now->day}{$now->month}{$now->year}", $file, "{$newName}");
        }

        Page::where('page_id', $news_id)
            ->where('type', 2)->update([
                'img' => $img,
                'title' => $request->title,
                'seo_url' => '',
                'content' => $request->input('content'),
                'preview' => $request->preview,
                'template' => '',
                'meta_title' => $request->meta_title,
                'meta_keywords' => $request->meta_keywords,
                'meta_description' => $request->meta_description,
            ]);
        return redirect('/admin/news/'.$news_id);
    }

    public function addSliders(Request $request) {
        $slider_id = Slider::insertGetId([
            'name' => $request->name,
            'type' => 1
        ]);

        return redirect('/admin/sliders/'.$slider_id);
    }

    public function editSliders($slider_id) {
        $slider = Slider::where('slider_id', $slider_id)->first();
        $slides = Slide::where('slider_id', $slider_id)->get();
        return view('admin.edit_slider', [
            'slider' => $slider,
            'slides' => $slides
        ]);
    }

    public function saveSliders(Request $request, $slider_id) {
        Slider::where('slider_id', $slider_id)->update([
            'name' => $request->name
        ]);
    }

    public function updateSlide(Request $request) {
        $slide = Slide::where('slide_id', $request->slide_id)->first();
        if($slide) {
            $img = $slide->img;
            if($request->file('slide_image')) {
                $now = Carbon::now();
                $file = $request->file('slide_image');
                $newName = md5($file->getClientOriginalName()) . "." . $file->getClientOriginalExtension();
                $img = 'https://lk.plyazhspb.ru/uploads/' . Storage::disk('uploads')->putFileAs("{$now->day}{$now->month}{$now->year}", $file, "{$newName}");
            }
            Slide::where('slide_id', $request->slide_id)->update([
                'alt' => $request->slide_alt,
                'img' => $img
            ]);
            return response()->json([
                'result' => true,
                'img' => $img,
            ]);
        }
        return response()->json(['result' => false, 'message' => 'slide not found']);
    }

    public function deleteSlide(Request $request) {
        Slide::where('slide_id', $request->slide_id)->delete();
        return response()->json([
            'result' => true
        ]);
    }

    public function sendToAll() {
        $users = User::where('id', 1)->get();
        foreach ($users as $user) {
            $password = str_random(8);

            User::where('id', $user->id)->update([
                'password' => bcrypt($password)
            ]);

            $message = "Ранее Вы создавали заказ на сайте plyazhspb.ru </br>";
            $message .= "Информацию по своему заказу, Вы можете увидеть в личном кабинете.</br>";
            $message .= "Авторизируйтесь по следующим данным: </br>";
            $message .= "E-Mail: ". $user->email. "</br>";
            $message .= "Пароль: ".$password. "</br>";

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type:text/html;charset=utf-8' . "\r\n";
            $headers .= 'From: Администрация ЦПС Пляж <info@plyazhspb.ru>' . "\r\n";
            mail($user->email, "Личный кабинет", $message, $headers);
        }
    }

    public function addSlide(Request $request) {
        $img = '';
        if($request->file('slide_image')) {
            $now = Carbon::now();
            $file = $request->file('slide_image');
            $newName = md5($file->getClientOriginalName()) . "." . $file->getClientOriginalExtension();
            $img = 'https://lk.plyazhspb.ru/uploads/' . Storage::disk('uploads')->putFileAs("{$now->day}{$now->month}{$now->year}", $file, "{$newName}");
        }
        $slide_id = Slide::insertGetId([
            'slider_id' => $request->slider_id,
            'img' => $img,
            'alt' => $request->slide_alt
        ]);
        return view('admin.addedslide', [
            'slide_id' => $slide_id,
            'alt' => $request->slide_alt,
            'img' => $img
        ]);
    }
}
