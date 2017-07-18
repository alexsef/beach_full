<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Order;
use App\User;
use Storage;
use Auth;
use DB;

class AdminController extends Controller
{
    public function test() {
//        $to = Carbon::parse('2017-05-15 7:00');
//        $from = Carbon::parse('2017-05-15 24:00');
//        $ordersToday = Order::whereDate('reserved_from', $from->toDateString())
//            ->where('position', 0)
//            ->where(function ($q) use ($to, $from) {
//                $q->where(function ($q) use ($to, $from) {
//                    $q->where('reserved_from', '>', $from)
//                        ->where('reserved_to', '<', $to);
//                })
//                    ->orWhere(function ($q) use ($to, $from) {
//                        $q->where('reserved_from', '<', $from)
//                            ->where('reserved_to', '>', $to);
//                    })
//                    ->orWhere(function ($q) use ($to, $from) {
//                        $q->whereBetween('reserved_from', [$from->addMinute(), $to->subMinute()])
//                            ->orWhere(function ($q) use ($to, $from) {
//                                $q->whereBetween('reserved_to', [$from->addMinute(), $to->subMinute()]);
//                            });
//                    });
//            })
//            ->get();
    }

    public function users(Request $request, $id = 0) {
        $users = User::where('user_group', 1);

        $users = $id != 0 ? $users->where('id', $id) : $users;

        return view('admin.users', [
            'users' => $users->get()
        ]);
    }

    public function orders(Request $request) {
        $orders = Order::with(['user', 'field']);
        $date = $request->date ? $request->date : '';
        $orders = $date ? $orders->whereDate('reserved_from', $date) : $orders;

        $orders = $orders->get();

        return view('admin.orders', [
            'orders' => $orders,
            'date' => $date
        ]);
    }

    public function editGallery() {
        $data = DB::select("SELECT * FROM `api_gallery`");
        $links = [];
        foreach ($data as $d) {
            $links[] = [
                'url' => 'http://api.plyazhspb.ru/uploads/'.$d->path,
                'id' => $d->image_id,
                'album_name' => $d->album_name
            ];
        }
        return view('admin.edit_gallery', ['images' => $links]);
    }

    public function uploadPhoto(Request $request) {
        $now = Carbon::now();
        $file = $request->file('photo');
        $newName = md5($file->getClientOriginalName()).".".$file->getClientOriginalExtension();
        $path = Storage::disk('uploads')->putFileAs("{$now->day}{$now->month}{$now->year}", $file, "{$newName}");
        DB::insert('INSERT INTO `api_gallery` SET `path` = ?', [$path]);
        return redirect('/edit/gallery');
    }

    public function deletePhoto(Request $request) {
        $data = DB::select("SELECT * FROM `api_gallery` WHERE `image_id` = {$request->id}");
        Storage::disk('uploads')->delete($data[0]->path);
        DB::delete("DELETE FROM `api_gallery` WHERE `image_id` = ?", [$request->id]);
    }

    public function loginForm() {
        if(!Auth::check()) {
            return view('auth.login');
        } else {
            return view('admin.main');
        }
    }

    public function login(Request $request) {
        if(User::whereEmail('meatfay@gmail.com')->first()->user_group == 0) {
            Auth::attempt(['email' => $request->email, 'password' => $request->password], true);
        }
        return redirect('/admin');
    }

    public function logout() {
        Auth::logout();
        return redirect('/admin');
    }

}
