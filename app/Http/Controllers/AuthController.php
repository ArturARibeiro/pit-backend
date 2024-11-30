<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AttemptRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\SidRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('auth.login');
    }

    public function signIn(): View
    {
        return view('auth.sign-in');
    }

    public function register(RegisterRequest $request): View|RedirectResponse
    {
        $user = User::query()->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'phone' => $request->get('phone'),
        ]);

        if ($user) {
            Auth::login($user);
            return redirect()->intended();
        }

        return back()->withErrors([
            'credentials' => 'Falha ao criar uma nova conta',
        ]);
    }

    public function attempt(AttemptRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = User::query()->where('email', $request->get('email'))->first();

        $password = Hash::make(Str::random(8));
        if ($user) {
            $password = $user->password;
        }

        if (Hash::check($request->get('password'), $password)) {
            Auth::loginUsingId($user->id);
            return redirect()->intended();
        }

        return back()->withErrors([
            'credentials' => 'As credenciais fornecidas são inválidas.',
        ]);
    }

    public function sid(SidRequest $request): View
    {
        return view('auth.sid', [
            'redirect' => $request->get('redirect', '/'),
        ]);
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
