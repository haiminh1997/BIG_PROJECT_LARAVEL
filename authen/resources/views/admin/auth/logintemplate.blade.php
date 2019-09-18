
@extends('admin.layouts.admin')

@section('content')

    <div id="page-wrapper" style="min-height: 279px; margin-left: 0">
        <div class="main-page login-page ">
            <h2 class="title1">{{ __('Login Admin') }}</h2>
            <div class="widget-shadow">
                <div class="login-body">
                    <form action="{{ route('admin.auth.loginAdmin') }}" method="post">
                        @csrf
                        <input type="email" class="user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Your Email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input id="password" type="password" class="lock @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="forgot-grid">
                            <label class="checkbox">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <i></i>Remember me
                            </label>

                            @if (Route::has('password.request'))
                                <div class="forgot">
                                    <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                </div>
                            @endif
                            <div class="clearfix"> </div>
                        </div>
                        <input type="submit" name="Sign In" value="{{ __('Login Admin') }}">
                        <div class="registration">
                            Don't have an account ?
                            <a class="" href="signup.html">
                                Create an account
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


@endsection
