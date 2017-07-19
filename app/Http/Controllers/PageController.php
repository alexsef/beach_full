<?php

namespace App\Http\Controllers;

use App\Page;
use App\Review;
use App\User;
use App\Slide;
use App\Slider;
use App\Infoslide;
use Auth;
use DB;
use Illuminate\Http\Request;
use Mail;

class PageController extends Controller
{
    public function index(Request $request) {
        \Blade::setContentTags('<%', '%>');
        \Blade::setEscapedContentTags('<%%', '%%>');

        $reviews_out = DB::select('select * from api_reviews, api_users where status = 1 and api_users.id = api_reviews.user_id');
        // var_dump($reviews_out);
        foreach($reviews_out as $rev) {
            if(!$rev->avatar) {
                $rev->avatar = "img/default-user.png";
            }
        }

        $slides = Slide::inRandomOrder()->take(10)->get();
        $infoslides = Infoslide::take(4)->get();

        // $reviews = Review::with('user')->where('status', 1)->orderBy('created_at', 'desc')->limit(5)->first();
        return view('pages.index', [
            'reviews' => $reviews_out,
            'slides' => $slides,
            'i_slides' => $infoslides
        ]);
    }

    public function sendReviews(Request $request)
    {
        $reviews = new Review;
        $reviews->message = $request->message_rev;
        $usr_id = User::where('email', "$request->email_rev")->value('id');

        $reviews->user_id = $usr_id;

        $reviews->save();

        return redirect('/');
    }

    public function getAlbum(Request $request, $id)
    {
        $page = Page::with('parent')->where('seo_url', 'gallery')->first();
        abort_if(!$page, 404);

        if(preg_match('/\[slider=(.*)\]/', $page->content, $match) && isset($match[1])) {
            $slider = Slider::where('name', $match[1])->first();

            $sl = DB::table('album')->get();
            $id = DB::table('album')->where('id', $id)->value('id');
            $album_name = DB::table('album')->where('id', $id)->value('album_name');

            $slides = Slide::where('album_id', $id)->get();
            $view = view('pages.slider', [
                'slider' => $slides
            ])->render();
            $page->content = preg_replace('/\[slider=(.*)\]/', $view, $page->content);
        }


        return view('pages.'.$page->template, [
            'page' => $page,
            'sl' => $sl,
            'album_name' => $album_name
        ]);

    }

    public function getPage(Request $request, $name) {
        $page = Page::with('parent')->where('seo_url', $name)->first();
        abort_if(!$page, 404);


        if(preg_match('/\[slider=(.*)\]/', $page->content, $match) && isset($match[1])) {
            $slider = Slider::where('name', $match[1])->first();
            $slides = Slide::where('slider_id', $slider->slider_id)->get();
            $view = view('pages.slider', [
                'slider' => $slides
            ])->render();
            $page->content = preg_replace('/\[slider=(.*)\]/', $view, $page->content);
        }

        $sl = DB::table('album')->get();
        if($name == "gallery") {
            return view('pages.'.$page->template, [
            'page' => $page,
            'sl' => $sl
        ]);
        }
        // ---- ПРОВЕРКИ ----
        //---- ДЕТСКИЕ СЕКЦИИ ----
        if($request->fio_par) {
            $this->validate($request, [
                'fio_par' => 'required|string|min:10',
                'fio_child' => 'required|string|min:10',
                'mobile_phone_par' => 'required|max:20',
                'mail_par' => 'required|email|max:50'
            ]);
        }
        // --- ВЗРОСЛЫЕ СЕКЦИИ ----
        if($request->fio) {
            $this->validate($request, [
                'fio' => 'required|string|min:10',
                'mobile_phone' => 'required|max:20',
                'mail' => 'required|email|max:50'
            ]);
        }

        // ---- ДЕТСКИЕ ПРАЗДНИКИ ----
        if($request->fio_par_hol) {
            $this->validate($request, [
                'fio_par_hol' => 'required|string|min:10',
                'fio_child_hol' => 'required|string|min:10',
                'mobile_phone_par' => 'required|max:20',
                'mail_par' => 'required|email|max:50'
            ]);
        }

        // ---- ДЛЯ БИЗНЕСА ----
        if($request->name_corp) {
            $this->validate($request, [
                'name_corp' => 'required|string|min:4',
                'phone_corp' => 'required|string|max:20',
                'corp' => 'required|min:3',
                'info_corp' => 'required|string|max:255'
            ]);
        }

        // ---- ДЛЯ СПОРТА ----
        if($request->name_corp_sport) {
            $this->validate($request, [
                'name_corp_sport' => 'required|string|min:4',
                'phone_corp_sport' => 'required|string|max:20',
                'corp_sport' => 'required|min:3',
                'info_corp_sport' => 'required|string|max:255'
            ]);
        }

        //---- ОТПРАВКА ПИСЕМ ----
        //---- ДЕТСКИЕ СЕКЦИИ ----
        if($request->fio_par && $request->fio_child && $request->mobile_phone_par && $request->mail_par) {
            $fio_par = $request->fio_par;
            $fio_child = $request->fio_child;
            $mobile_phone_par = $request->mobile_phone_par;
            $mail_par = $request->mail_par;

            $subject = "=?utf-8?B?". base64_encode("Заявка в секцию по пляжному волейболу (дети)"). "?=";
            $message = "Поступила новая заявка <br> Пользователь: {$fio_par}<br>";
            $message .= "ФИО ребенка: {$fio_child}<br>";
            $message .= "Почта клиента: {$mail_par} <br>";
            $message .= "Мобильный номер клиента:  {$mobile_phone_par} <br>";

            $headers= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n";
            $headers .= 'From: Детская секция <zakaz@plyazhspb.ru>' . "\r\n";

            mail('zakaz@plyazhspb.ru', $subject, $message, $headers);

            $headers_out = "MIME-Version: 1.0\r\n";
            $headers_out .= "Content-type: text/html; charset=utf-8\r\n";
            $headers_out .= 'From: PLYAZHSPB.RU <zakaz@plyazhspb.ru>' . "\r\n";
            $subject_out = "=?utf-8?B?". base64_encode("Ваша заявка успешно получена"). "?=";
            mail($mail_par, $subject_out, 'Ваша заявка успешно получена', $headers_out);

            return redirect('/page/childrens_sections')
            ->with('status', 'Ваша заявка успешно принята. Администратор в скором времени свяжется с Вами!');
        }

        //---- ВЗРОСЛЫЕ СЕКЦИИ ----
        if($request->fio && $request->mobile_phone && $request->mail) {
            $fio = $request->fio;
            $mobile_phone = $request->mobile_phone;
            $mail = $request->mail;
            if($request->newcomer == "newcomer") {
                $level = true;
            } else {
                $level = false;
            }

            $subject="=?utf-8?B?". base64_encode("Тема: Заявка в секцию по пляжному волейболу (взрослые)"). "?=";
            $message = "Поступила новая заявка <br> Пользователь: {$fio}<br>";
            $message .= "Почта клиента: {$mail} <br>";
            $message .= "Мобильный номер клиента:  {$mobile_phone} <br>";
            if($level) {
                $message .= "Уровень: новичок<br>";
            } else {
                $message .= "Уровень: любитель<br>";
            }
            $headers= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n";
            $headers .= 'From: Взрослая секция <zakaz@plyazhspb.ru>' . "\r\n";

            $headers_out = "MIME-Version: 1.0\r\n";
            $headers_out .= "Content-type: text/html; charset=utf-8\r\n";
            $headers_out .= 'From: PLYAZHSPB.RU <zakaz@plyazhspb.ru>' . "\r\n";
            $subject_out = "=?utf-8?B?". base64_encode("Ваша заявка успешно получена"). "?=";
            $subject_out = "=?utf-8?B?". base64_encode("Ваша заявка успешно получена"). "?=";
            mail('zakaz@plyazhspb.ru', $subject, $message, $headers);
            mail($mail, $subject_out, 'Ваша заявка успешно получена', $headers_out);

            return redirect('/page/adult_sections')
            ->with('status', 'Ваша заявка успешно принята. Администратор в скором времени свяжется с Вами!');
        }

        // ---- ДЕТСКИЕ ПРАЗДНИКИ ----
        if($request->fio_par_hol && $request->fio_child_hol && $request->mobile_phone_par && $request->mail_par) {
            $fio_par = $request->fio_par_hol;
            $fio_child = $request->fio_child_hol;
            $mobile_phone_par = $request->mobile_phone_par;
            $mail_par = $request->mail_par;
            if($request->info) {
                $info = $request->info;
            }

            $subject = "=?utf-8?B?". base64_encode("Заявка на детский праздник"). "?=";
            $message = "Поступила новая заявка <br> Пользователь: {$fio_par}<br>";
            $message .= "ФИО ребенка: {$fio_child}<br>";
            if($info) {
                $message .= "Дополнительная инфомация: {$info}<br>";
            }
            $message .= "Почта клиента: {$mail_par} <br>";
            $message .= "Мобильный номер клиента:  {$mobile_phone_par} <br>";

            $headers= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n";
            $headers .= 'From: Детский праздник <zakaz@plyazhspb.ru>' . "\r\n";

            mail('zakaz@plyazhspb.ru', $subject, $message, $headers);

            $headers_out = "MIME-Version: 1.0\r\n";
            $headers_out .= "Content-type: text/html; charset=utf-8\r\n";
            $headers_out .= 'From: PLYAZHSPB.RU <zakaz@plyazhspb.ru>' . "\r\n";
            $subject_out = "=?utf-8?B?". base64_encode("Ваша заявка успешно получена"). "?=";
            mail($mail_par, $subject_out, 'Ваша заявка успешно получена', $headers_out);

            return redirect('/page/children_holidays')
            ->with('status', 'Ваша заявка успешно принята. Администратор в скором времени свяжется с Вами!');
        }

        // ---- ДЛЯ БИЗНЕСА ----
        if($request->name_corp && $request->corp && $request->phone_corp && $request->info_corp) {
            $name_corp = $request->name_corp;
            $corp = $request->corp;
            $phone_corp = $request->phone_corp;
            $info_corp = $request->info_corp;

            $subject = "=?utf-8?B?". base64_encode("Заявка от компании"). "?=";
            $message = "Поступила новая заявка <br> Пользователь: {$name_corp}<br>";
            $message .= "Название организации:  {$corp} <br>";
            $message .= "Мобильный номер клиента:  {$phone_corp} <br>";
            $message .= "Информация об организации:  {$info_corp} <br>";

            $headers= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n";
            $headers .= 'From: Детский праздник <zakaz@plyazhspb.ru>' . "\r\n";

            mail('zakaz@plyazhspb.ru', $subject, $message, $headers);

            return redirect('/page/forbusiness')
            ->with('status', 'Ваша заявка успешно принята. Администратор в скором времени свяжется с Вами!');
        }

        // ---- ДЛЯ СПОРТА ----
        if($request->name_corp_sport && $request->corp_sport && $request->phone_corp_sport && $request->info_corp_sport) {
            $name_corp_sport = $request->name_corp_sport;
            $corp_sport = $request->corp_sport;
            $phone_corp_sport = $request->phone_corp_sport;
            $info_corp_sport = $request->info_corp_sport;

            $subject = "=?utf-8?B?". base64_encode("Заявка от спортивной компании или клуба"). "?=";
            $message = "Поступила новая заявка <br> Пользователь: {$name_corp_sport}<br>";
            $message .= "Название организации:  {$corp_sport} <br>";
            $message .= "Мобильный номер клиента:  {$phone_corp_sport} <br>";
            $message .= "Информация об организации:  {$info_corp_sport} <br>";

            $headers= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n";
            $headers .= 'From: Детский праздник <zakaz@plyazhspb.ru>' . "\r\n";

            mail('zakaz@plyazhspb.ru', $subject, $message, $headers);

            return redirect('/page/forsport')
            ->with('status', 'Ваша заявка успешно принята. Администратор в скором времени свяжется с Вами!');
        }

        return view('pages.'.$page->template, [
            'page' => $page
        ]);
    }

    public function news(Request $request, $id = 0) {
        if(!$id) {
            $views = [];

            $news = Page::where('type', 2)->get();

            foreach ($news as $new) {
                $views[] = view('pages.onenew', [
                    'news' => $new
                ])->render();
            }

            return view('pages.news', [
                'news' => $views
            ]);
        }
        $news = Page::where('type', 2)->where('page_id', $id)->first();

        abort_if(!$news, 404);
        return view('pages.newstemp', [
            'news' => $news
        ]);
    }
}
