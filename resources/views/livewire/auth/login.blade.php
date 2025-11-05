<?php

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Title;
use Laravel\Fortify\Features;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] #[Title('Login – Phrónesis')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        $user = $this->validateCredentials();

        if (Features::canManageTwoFactorAuthentication() && $user->hasEnabledTwoFactorAuthentication()) {
            Session::put([
                'login.id' => $user->getKey(),
                'login.remember' => $this->remember,
            ]);

            $this->redirect(route('two-factor.login'), navigate: true);

            return;
        }

        Auth::login($user, $this->remember);

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('blogs.index', absolute: false), navigate: true);
    }

    /**
     * Validate the user's credentials.
     */
    protected function validateCredentials(): User
    {
        $user = Auth::getProvider()->retrieveByCredentials(['email' => $this->email, 'password' => $this->password]);

        if (! $user || ! Auth::getProvider()->validateCredentials($user, ['password' => $this->password])) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => 'Credenciais Inválidas',
            ]);
        }

        return $user;
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}; ?>

<div class="w-full bg-card/40 backdrop-blur-sm border border-border rounded-2xl p-8 shadow-2xl animate-fade-in-up">
    {{-- Header --}}
    <div class="text-center mb-8">
        <a href="{{ route('home') }}" wire:navigate class="inline-block mb-4">
            <x-app-logo class="w-auto h-10 text-foreground" />
        </a>
        <h1 class="text-2xl font-bold font-serif text-foreground">{{ __('Log in to your account') }}</h1>
        <p class="text-muted-foreground mt-1 text-sm">{{ __('Welcome back! Please enter your details.') }}</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

    <form wire:submit="login" class="space-y-6">
        {{-- Email Address --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 sr-only">{{ __('Email address') }}</label>
            <input wire:model="email" id="email" type="email" autocomplete="email" required autofocus placeholder="email@example.com"
                   class="block w-full bg-background/50 border-border rounded-md py-2.5 px-3 text-foreground placeholder:text-muted-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500 sm:text-sm transition">
            @error('email') <span class="text-red-400 text-sm mt-2">{{ $message }}</span> @enderror
        </div>

        {{-- Password --}}
        <div>
            <div class="flex items-center justify-between">
                <label for="password" class="block text-sm font-medium text-gray-300 sr-only">{{ __('Password') }}</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" wire:navigate class="text-sm font-semibold text-primary hover:text-teal-300 transition-colors ml-auto">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
            <div class="mt-2">
                <input wire:model="password" id="password" type="password" autocomplete="current-password" required placeholder="••••••••"
                       class="block w-full bg-background/50 border-border rounded-md py-2.5 px-3 text-foreground placeholder:text-muted-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500 sm:text-sm transition">
            </div>
        </div>

        {{-- Remember Me --}}
        <div class="flex items-center">
            <input wire:model="remember" id="remember" type="checkbox" class="h-4 w-4 rounded border-gray-600 bg-card text-teal-500 focus:ring-teal-600 cursor-pointer">
            <label for="remember" class="ml-3 block text-sm text-gray-300 cursor-pointer">{{ __('Remember me') }}</label>
        </div>

        {{-- Submit Button --}}
        <div>
            <button type="submit"
                    class="w-full group inline-flex items-center justify-center bg-primary hover:bg-teal-600 text-foreground font-semibold px-8 h-11 rounded-lg shadow-lg shadow-teal-500/20 transition-all duration-300 transform hover:-translate-y-0.5">
                <span wire:loading.remove wire:target="login">{{ __('Log in') }}</span>
                <span wire:loading wire:target="login">{{ __('Processing...') }}</span>
            </button>
        </div>
    </form>

    {{-- Link to Register --}}
    @if (Route::has('register'))
        <p class="mt-8 text-center text-sm text-muted-foreground">
            {{ __("Don't have an account?") }}
            <a href="{{ route('register') }}" wire:navigate class="font-semibold leading-6 text-primary hover:text-teal-300 transition-colors">
                {{ __('Sign up') }}
            </a>
        </p>
    @endif
</div>
