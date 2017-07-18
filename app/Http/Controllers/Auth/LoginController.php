<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function makeAuth(Request $request) {
        if(Auth::check()) {
            DB::table('sessions')->where('user_id', Auth::id())->delete();
            return redirect('/');
        }
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
            $hash = hash('sha256', str_random(64));
            DB::table('sessions')->insert([
                'sid' => $hash,
                'user_id' => Auth::id(),
            ]);
            return redirect('http://lk.plyazhspb.ru/sid?sid='.$hash);
        }
        return redirect('/');
    }
}
