<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="row g-3">
        @csrf
        <div class="col-md-6">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
        </div>
        <div class="col-md-6">
            <x-input-label for="password" :value="__('Password')" />
            <input type="password" class="form-control" id="password" name="password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                <label class="form-check-label" for="gridCheck">
                    {{ __('Remember me') }}
                </label>
            </div>
        </div>

        <div class="row">
            <div class="col">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="col">
                <button type="submit" class="btn btn-primary">
                    {{ __('Log in') }}
                </button>
            </div>
        </div>
    </form>
</x-guest-layout>
