<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;

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
     * Where to redirect users after registration.
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
        $messages = [
            'name.required' => 'Nazwa użytkownika jest wymagana.',
            'name.max' => 'Nazwa nie powinna być dłuższa niż 255 znaków.',
            'email.required' => 'Adres e-mail jest wymagany.',
            'email.max' => 'Adres e-mail nie powinien być dłuższy niż 255 znaków.',
            'email.email' => 'Wprowadzony adres e-mail jest nieprawidłowy.',
            'email.unique' => 'Adres e-mail jest już zajęty.',
            'password.required' => 'Hasło jest wymagane.',
            'password.min' => 'Hasło powinno zawierać więcej niż 3 znaki.',
            'password.confirmed' => 'Wprowadzone hasła nie są takie same.'
        ];

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function guard()
    {
        return Auth::guard('user');
    }

    public function showRegistrationForm()
    {
        return view('auth.register')
            ->with('hideTopContent', true)
            ->with('hideSidebar', true)
            ;
    }
}
