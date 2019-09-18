@extends('admin.layouts.admin')

@section('content')

    <div id="page-wrapper" style="min-height: 444px ;margin-left: 0">
        <div class="main-page signup-page">
            <h2 class="title1">{{ __('Register Admin') }}</h2>
            <div class="sign-up-row widget-shadow">
                <h5>Personal Information :</h5>
                <form action="{{ route('admin.register.store') }}" method="post">
                    @csrf
                    <div class="sign-u">


                        <input type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="clearfix"> </div>
                    </div>
                    <div class="sign-u">

                        <input type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="clearfix"> </div>
                    </div>
                    <h6>Login Information :</h6>
                    <div class="sign-u">


                        <input  type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="clearfix"> </div>
                    </div>
                    <div class="sign-u">

                        <input type="password"  name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                    </div>
                    <div class="clearfix"> </div>
                    <div class="sub_home">
                        <input type="submit" value="Submit">
                        <div class="clearfix"> </div>
                    </div>
                    <div class="registration">
                        Already Registered.
                        <a class="" href="{{ route('admin.auth.login') }}">
                            Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
