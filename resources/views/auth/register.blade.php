@extends('frontend.layouts.layout')
@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('frontend.index')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
                </ol>
            </div>
        </nav>

        <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17"
             style="background-image: url('frontend/assets/images/backgrounds/login-bg.jpg')">
            <div class="container">
                <div class="form-box">
                    <div class="form-tab">
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <p class="nav-link">Sign Up</p>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <form method="POST" action="{{route('register')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="register-name">Name</label>
                                    <input type="text" class="form-control" id="register-name" name="name" autofocus required>
                                    @error('name')
                                    <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="register-email">Your email address</label>
                                    <input type="email" class="form-control" id="register-email" name="email" required>
                                    @error('email')
                                    <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="register-password">Password</label>
                                    <input type="password" class="form-control" id="register-password" name="password" required>
                                    @error('password')
                                    <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="register-password-2">Password Confirmation</label>
                                    <input type="password" class="form-control" id="register-password-2" name="password_confirmation" required>
                                    @error('password_confirmation')
                                    <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>SIGN UP</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>

                                    {{--                                    <div class="custom-control custom-checkbox">--}}
                                    {{--                                        <input type="checkbox" class="custom-control-input" id="register-policy-2"--}}
                                    {{--                                               required>--}}
                                    {{--                                        <label class="custom-control-label" for="register-policy-2">I agree to the <a--}}
                                    {{--                                                href="#">privacy policy</a> *</label>--}}
                                    {{--                                    </div>--}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
