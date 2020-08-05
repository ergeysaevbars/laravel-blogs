<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $months = $this->allMonths();
        return view('auth.register', compact('months'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data,
            [
                'name' => ['required', 'string', 'max:255'],
                'surname' => ['required', 'string', 'max:255'],
                'year' => ['required', 'not_in:0'],
                'month' => ['required', 'not_in:0'],
                'day' => ['required', 'not_in:0'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                ],
            [
                /*validation for name*/
                'name.required' => "Имя обязательно для заполнения",
                'name.max' => "Длина имени должна быть не более 255 символов",
                /*validation for name*/

                /*validation for surname*/
                'surname.required' => "Фамилия обязательна для заполнения",
                'surname.max' => "Длина фамилии должна быть не более 255 символов",
                /*validation for surname*/

                /*validation for email*/
                'email.required' => "Не указан E-mail адрес",
                'email.email' => "Указан некорректный E-mail адрес",
                'email.max' => "Длина E-mail адреса должна быть не болееп 255 символов",
                'email.unique' => "Введённый E-mail адрес уже используется",
                /*validation for email*/

                /*validation for birthdate*/
                'year.not_in' => 'Не указан год',
                'month.not_in' => 'Не указан месяц',
                'day.not_in' => 'Не указан день',
                /*validation for birthdate*/

                /*validation for password*/
                'password.required' => "Пароль обязателен для заполнения",
                'password.min' => "Длина пароля должна быть не менее 8 символов",
                'password.confirmed' => "Пароли не совпадают",
                /*validation for password*/
            ]
        );
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
            'surname' => $data['surname'],
            'birth_date' => $data['year'] . '-' . $data['month'] . '-' . $data['day'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
