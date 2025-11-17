<x-guest-layout>
    <!-- ✅ Status Session -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    @if (session('status'))
        <div class="mb-4 p-3 rounded-md text-green-800 bg-green-100 border border-green-300">
            {{ session('status') }}
        </div>
    @endif

    <!-- ✅ Form Login -->
    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- ✅ reCAPTCHA -->
        <div class="pt-2">
            {!! NoCaptcha::display() !!}
            @if ($errors->has('g-recaptcha-response'))
                <p class="text-red-600 text-sm mt-1">{{ $errors->first('g-recaptcha-response') }}</p>
            @endif
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-3">
            <label for="remember_me" class="inline-flex items-center text-sm text-gray-600">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 hover:text-indigo-800 font-medium"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-between mt-6 gap-3">
            <p class="text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                    Daftar di sini
                </a>
            </p>

            {!! NoCaptcha::renderJs() !!}


            <x-primary-button class="w-full sm:w-1/2 text-center justify-center">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
