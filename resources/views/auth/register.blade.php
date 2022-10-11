<x-guest-layout>
    <div class="card-body">
        <div class="pt-4 pb-2">
            <h5 class="card-title text-center pb-0 fs-4">Register new Account</h5>
            <p class="text-center small">Enter your account details to register</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="row g-3">
            @csrf

            <!-- Name -->
            {{-- <div class="col-12">
                <x-input-label for="name" :value="__('Name')" />
                <div class="input-group">
                    <input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="alert alert-danger" />
                </div>
            </div> --}}
            <div class="col-12">
                <x-input-label for="name" :value="__('Name')" />
                <div class="input-group">
                    <div class="col-md-12">
                        <input id="name" class="form-control" type="text" name="name" :value="old('name')" required />
                    </div>
                    <div class="col-md-12">
                        <code>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </code>
                    </div>
                </div>
            </div>

            <!-- Email Address -->
            <div class="col-12">
                <x-input-label for="email" :value="__('Email')" />
                <div class="input-group">
                    <div class="col-md-12">
                        <input id="email" class="form-control" type="email" name="email" :value="old('email')" required />
                    </div>
                    <div class="col-md-12">
                        <code>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </code>
                    </div>
                </div>
            </div>

            <!-- Password -->
            {{-- <div class="col-12">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div> --}}
            <div class="col-12">
                <x-input-label for="password" :value="__('Password')" />
                <div class="input-group">
                    <div class="col-md-12">
                        <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                    </div>
                    <div class="col-md-12">
                        <code>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </code>
                    </div>
                </div>
            </div>

            <!-- Confirm Password -->
            {{-- <div class="col-12">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div> --}}
            <div class="col-12">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <div class="input-group">
                    <div class="col-md-12">
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required />
                    </div>
                    <div class="col-md-12">
                        <code>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </code>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <button class="btn btn-primary">
                    Register
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
