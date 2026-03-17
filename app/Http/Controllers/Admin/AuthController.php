<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Auth\LoginAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\{Inertia, Response};
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthController extends Controller
{
    public function index(): Response|RedirectResponse
    {
        if (Auth::check()) {
            return to_route('profile.view');
        }
        return Inertia::render('Login');
    }

    public function userLogin(LoginRequest $request): RedirectResponse
    {
        return resolve(LoginAction::class)->execute($request);
    }

    public function demoLogin(Request $request): RedirectResponse
    {
        $request->merge([
            'email'    => config('users.demo.email'),
            'password' => config('users.demo.password'),
        ]);
        return resolve(LoginAction::class)->execute($request);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('login');
    }
}
