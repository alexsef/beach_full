<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    public function register(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'patronymic' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'patronymic' => $request->input('patronymic'),
            'fullname' => $request->input('surname')." ".$request->input('name')." ".$request->input('patronymic'),
            'email' => $request->input('email'),
            'user_group' => 1,
            'phone' => $request->input('phone'),
            'password' => bcrypt($request->input('password')),
        ]);

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

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
//        return User::create([
//            'name' => $data['name'],
//            'surname' => $data['name'],
//            'patronymic' => $data['name'],
//            'email' => $data['email'],
//            'user_group' => 1,
//            'phone' => $data['phone'],
//            'password' => bcrypt($data['password']),
//        ]);
    }
}
