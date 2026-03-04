<?php

use App\Enums\FlashTypeEnum;
use Inertia\Testing\AssertableInertia as Assert;

describe('AuthController tests', function () {
    it('loads login page', function () {
        $this->get(route('login'))
             ->assertInertia(
                 fn (Assert $page) => $page->component('Login')
             );
    });

    it('logs user into admin', function () {
        $params = [
            'email'    => config('users.main.email'),
            'password' => config('users.main.password'),
        ];

        $this->post(route('login', $params))
             ->assertRedirect(route('profile.view'));
    });

    it('shows flash message after failed login', function () {
        $params = [
            'email'    => 'invalid@mail.com',
            'password' => 'invalid'
        ];

        $this->post(route('login', $params))
             ->assertInertiaFlash('message', 'An error occurred logging into the user account')
             ->assertInertiaFlash('type', FlashTypeEnum::ERROR);
    });

    it('logs out user and redirects to login page', function () {
        $this->post(route('logout'))
             ->assertRedirect(route('login'));
    });
});
