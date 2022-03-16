<x-guest-layout>
    <div class="container-fluid p-3 p-md-5 shadow-lg" >
        <img src="{{url('images/logo.png')}}" class="img-fluid"></img>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Enter your email address for the reset password link.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="button shadow-md">
                    {{ __('Send Email') }}
                </x-button>
            </div>
        </form>
        <p>v.1.1.1</p>
    </div>
</x-guest-layout>
