@extends("layouts.app")
@section("content")


    @section('title', 'Profile')

    <div class="max-w-2xl mx-auto bg-toolbar-background p-6 rounded-lg border border-muted">
        <h2 class="text-lg font-semibold mb-6">Profile Information</h2>

        @if(session('status'))
            <div class="mb-4 text-sm text-primary">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="space-y-4">
                <!-- Name -->
                <div>
                    <input placeholder="Name" id="name" name="name" type="text" value="{{ old('name', $user->name) }}" 
                           class="form-input mt-1 block w-full input-field" required autocomplete="name">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div><br>
                
                <!-- Email -->
                <div>
                    <input placeholder="Email" id="email" name="email" type="email" value="{{ old('email', $user->email) }}" 
                           class="form-input mt-1 block w-full input-field" required autocomplete="email">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div><br>

                <div class="flex items-center gap-4">
                    <button type="submit" class="btn btn-primary px-4 py-2">Save</button>
                </div>
            </div>
        </form>

        <h2 class="text-lg font-semibold mt-8 mb-6">Update Password</h2>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <!-- Current Password -->
                <div>
                    <input placeholder="Current Password" id="current_password" name="current_password" type="password" 
                           class="form-input mt-1 block w-full input-field" required autocomplete="current-password">
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                </div><br>

                <!-- New Password -->
                <div>
                    <input placeholder="New Password" id="password" name="password" type="password" 
                           class="form-input mt-1 block w-full input-field" required autocomplete="new-password">
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div><br>

                <!-- Confirm Password -->
                <div>
                    <input placeholder="Confirm Password" id="password_confirmation" name="password_confirmation" type="password" 
                           class="form-input mt-1 block w-full input-field" required autocomplete="new-password">
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div><br>

                <div class="flex items-center gap-4">
                    <button type="submit" class="btn btn-primary px-4 py-2">Update Password</button>
                </div>
            </div>
        </form>
    </div>
@endsection