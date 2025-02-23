<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
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
            'email' => 'required|string|email|max:255|exists:tbl_user,email',
            'password' => 'required|string|min:6',
        ],
        [
            'email.exists' => 'Пользователь с такой почтой не найден',
            'password.min' => 'В пароле должно быть минимум 6 символов'
        ]);

        $user = User::where('email', $request['email'])->first();
        $passwordSalt = $user['salt'] . $request['password'];

        if (Hash::check($passwordSalt, $user['password'])) {
            Auth::login($user);
            return redirect()->intended(route('index'))->with('success', 'Вход выполнен успешно');
        } else {
            return back()->with('errorAuth', 'Не удалось выполнить вход');
        }
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
    public function destroy(Request $request)
    {
        Auth::guard($request->route()->parameter('guard'))->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Вы успешно вышли из аккаунта');
    }
}
