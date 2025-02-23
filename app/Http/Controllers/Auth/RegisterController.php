<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:tbl_user',
            'email' => 'required|string|email|max:255|unique:tbl_user',
            'password' => 'required|string|min:6|confirmed',
            'profile' => 'required|string|max:255',
        ],
        [
            'username.unique' => 'Пользователь с таким именем уже существует',
            'email.unique' => 'Пользователь с такой почтой уже существует',
            'password.min' => 'В пароле должно быть минимум 6 символов',
            'password.confirmed' => 'Пароли не совпадают'
        ]);

        $salt = '';
        for ($i = 0; $i < 6; $i++) {
            $salt .= chr(mt_rand(33, 126));
        }
        $saltedPassword = $salt . $request->get('password');

        $user = User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($saltedPassword),
            'salt' => $salt,
            'profile' => $request['profile'],
        ]);

        event(new Registered($user));
        Auth::login($user);
        return redirect()->route('index')->with('success', 'Вы успешно зарегистрировались. Вход выполнен');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
