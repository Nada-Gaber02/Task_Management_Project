<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div class="auth-form">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login" class="auth-form">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="form.password" id="password" type="password" name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="form-check">
            <label for="remember" class="form-check-label">
                <input wire:model="form.remember" id="remember" type="checkbox" class="form-check-input" name="remember">
                {{ __('Remember me') }}
            </label>
        </div>

        <div class="d-flex align-items-center justify-content-between gap-3">
            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="px-4">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
n
    @if (Route::has('register'))
        <div class="auth-divider">NEW TO TASKFLOW?</div>
        <a class="btn btn-outline-primary w-100" href="{{ route('register') }}" wire:navigate>{{ __('Register') }}</a>
    @endif
</div>
