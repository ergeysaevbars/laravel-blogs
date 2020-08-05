<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $age = DB::selectOne('SELECT get_users_age(?) age', [$user->id])->age;
        return view('home', compact('user', 'age'));
    }

    public function profileEdit()
    {
        $user = Auth::user();
        $months = $this->allMonths();
        $user->birth_date = Carbon::createFromFormat('Y-m-d', $user->birth_date);
        return view('user.edit', compact('months', 'user'));
    }

    public function editProfile(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'year' => ['required', 'not_in:0'],
            'month' => ['required', 'not_in:0'],
            'day' => ['required', 'not_in:0'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ], [
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

        ]);
        $user = Auth::user();
        $avatar = $request->file('avatar');
        if($avatar) {
            if ($user->avatar != 'nophoto.jpg') {
                Storage::delete('avatars/' . $user->avatar);
            }
            $avatar->storeAs('avatars', "user_" . $user->id . "." . $avatar->extension());
            $user->avatar = "user_" . $user->id . "." . $avatar->extension();
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
        }
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->birth_date = $request->year . '-' . $request->month . '-' . $request->day;
        if(!is_null($request->password))
            $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('home');
    }
}
