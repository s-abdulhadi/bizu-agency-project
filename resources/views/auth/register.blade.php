@extends('layouts.app')

@section('title', 'Sign Up | Bizu Agency')

@section('content')
    <section class="section-padding"
        style="min-height: 80vh; display: flex; align-items: center; justify-content: center; background-color: var(--color-surface);">
        <div class="card" style="max-width: 500px; width: 100%; padding: 3rem;">
            <div class="text-center mb-lg">
                <h1 class="mb-sm">Create Account</h1>
                <p class="text-light">Join us to get started.</p>
            </div>

            <form action="{{ route('register.post') }}" method="POST">
                @csrf

                <div class="form-group mb-md">
                    <label for="name" class="form-label font-bold text-sm mb-xs block">Full Name</label>
                    <input type="text" id="name" name="name" class="form-input w-full"
                        style="padding: 0.75rem; border: 1px solid var(--color-border); border-radius: var(--radius-sm);"
                        required value="{{ old('name') }}" autofocus>
                    @error('name')
                        <span class="text-error mt-xs block" style="color: red; font-size: 0.8rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-md">
                    <label for="email" class="form-label font-bold text-sm mb-xs block">Email Address</label>
                    <input type="email" id="email" name="email" class="form-input w-full"
                        style="padding: 0.75rem; border: 1px solid var(--color-border); border-radius: var(--radius-sm);"
                        required value="{{ old('email') }}">
                    @error('email')
                        <span class="text-error mt-xs block" style="color: red; font-size: 0.8rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-md">
                    <label for="password" class="form-label font-bold text-sm mb-xs block">Password</label>
                    <input type="password" id="password" name="password" class="form-input w-full"
                        style="padding: 0.75rem; border: 1px solid var(--color-border); border-radius: var(--radius-sm);"
                        required>
                    @error('password')
                        <span class="text-error mt-xs block" style="color: red; font-size: 0.8rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-lg">
                    <label for="password_confirmation" class="form-label font-bold text-sm mb-xs block">Confirm
                        Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-input w-full"
                        style="padding: 0.75rem; border: 1px solid var(--color-border); border-radius: var(--radius-sm);"
                        required>
                </div>

                <button type="submit" class="btn btn-primary w-full"
                    style="padding: 1rem; border-radius: var(--radius-sm); font-size: 1rem;">Create Account</button>

                <div class="text-center mt-md text-sm">
                    <p>Already have an account? <a href="{{ route('login') }}"
                            style="color: var(--color-primary); font-weight: bold;">Sign In</a></p>
                </div>
            </form>
        </div>
    </section>
@endsection