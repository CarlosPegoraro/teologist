<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] #[Title('Register – Phrónesis')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        Session::regenerate();

        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="w-full bg-gray-800/40 backdrop-blur-sm border border-white/10 rounded-2xl p-8 shadow-2xl animate-fade-in-up">
    {{-- Header --}}
    <div class="text-center mb-8">
        <a href="{{ route('home') }}" wire:navigate class="inline-block mb-4">
            <x-app-logo class="w-auto h-10 text-white" />
        </a>
        <h1 class="text-2xl font-bold font-serif text-white">{{ __('Create an account') }}</h1>
        <p class="text-gray-400 mt-1 text-sm">{{ __('Join us by entering your details below.') }}</p>
    </div>

    <form wire:submit="register" class="space-y-6">
        {{-- Name --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-300 sr-only">{{ __('Name') }}</label>
            <input wire:model="name" id="name" type="text" autocomplete="name" required autofocus placeholder="Full name"
                   class="block w-full bg-gray-900/50 border-gray-700 rounded-md py-2.5 px-3 text-white placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-teal-500 sm:text-sm transition">
            @error('name') <span class="text-red-400 text-sm mt-2">{{ $message }}</span> @enderror
        </div>

        {{-- Email Address --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 sr-only">{{ __('Email address') }}</label>
            <input wire:model="email" id="email" type="email" autocomplete="email" required placeholder="email@example.com"
                   class="block w-full bg-gray-900/50 border-gray-700 rounded-md py-2.5 px-3 text-white placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-teal-500 sm:text-sm transition">
            @error('email') <span class="text-red-400 text-sm mt-2">{{ $message }}</span> @enderror
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-300 sr-only">{{ __('Password') }}</label>
            <input wire:model="password" id="password" type="password" autocomplete="new-password" required placeholder="Password"
                   class="block w-full bg-gray-900/50 border-gray-700 rounded-md py-2.5 px-3 text-white placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-teal-500 sm:text-sm transition">
            @error('password') <span class="text-red-400 text-sm mt-2">{{ $message }}</span> @enderror
        </div>

        {{-- Confirm Password --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 sr-only">{{ __('Confirm password') }}</label>
            <input wire:model="password_confirmation" id="password_confirmation" type="password" autocomplete="new-password" required placeholder="Confirm password"
                   class="block w-full bg-gray-900/50 border-gray-700 rounded-md py-2.5 px-3 text-white placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-teal-500 sm:text-sm transition">
        </div>

        {{-- Submit Button --}}
        <div>
            <button type="submit"
                    class="w-full group inline-flex items-center justify-center bg-teal-500 hover:bg-teal-600 text-white font-semibold px-8 h-11 rounded-lg shadow-lg shadow-teal-500/20 transition-all duration-300 transform hover:-translate-y-0.5">
                <span wire:loading.remove wire:target="register">{{ __('Create account') }}</span>
                <span wire:loading wire:target="register">{{ __('Processing...') }}</span>
            </button>
        </div>
    </form>

    {{-- Link to Login --}}
    <p class="mt-8 text-center text-sm text-gray-400">
        {{ __('Already have an account?') }}
        <a href="{{ route('login') }}" wire:navigate class="font-semibold leading-6 text-teal-400 hover:text-teal-300 transition-colors">
            {{ __('Log in') }}
        </a>
    </p>
</div>
