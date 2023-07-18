@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        
                        <div class="form-group row mb-3">
                             <div class="col-md-6 offset-md-3">
                                <a href="{{ route('login.google') }}" class="btn btn-outline-secondary form-control mb-2">
                                    <img width="20px" src="{{ asset('assets/images/social-icon/Google__G__Logo.svg.png') }}" alt="Google sign-in">
                                    Login  With  Google</a>
                                <a href="{{ route('login.facebook') }}" class="btn btn-outline-secondary form-control mb-2">
                                    <img width="20px" src="{{ asset('assets/images/social-icon/2021_Facebook_icon.svg.png') }}" alt="facebook login">
                                    Login With Facebook</a>
                                <a href="{{ route('login.github') }}" class="btn btn-outline-secondary form-control">
                                    <img width="20px" src="{{ asset('assets/images/social-icon/GitHub_Invertocat_Logo.svg.png') }}" alt="facebook login">

                                    Login With Github</a>
                            </div>        
                        </div>

                        <p style="text-align: center">OR Login with Email</p>

                        <div class="form-group row mb-3">
                            <div class="col-md-6 offset-md-3">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-md-6 offset-md-3">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                   {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
