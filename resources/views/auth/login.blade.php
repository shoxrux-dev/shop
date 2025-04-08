@extends('frontend.layouts.layout')
@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('frontend.index')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sign In</li>
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
                                <p class="nav-link">Sign In</p>
                            </li>
                        </ul>
                        @error('error')
                            <p style="color: red">{{ $message }}</p>
                        @enderror
                        <div class="tab-content">
                            <form method="POST" action="{{route('login')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="singin-email">Email</label>
                                    <input type="email" class="form-control" id="singin-email" name="email" autofocus required>
                                </div>

                                <div class="form-group">
                                    <label for="singin-password">Password</label>
                                    <input type="password" class="form-control" id="singin-password" name="password" required>
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>LOG IN</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>

                                    {{--                                    <div class="custom-control custom-checkbox">--}}
                                    {{--                                        <input type="checkbox" class="custom-control-input" id="signin-remember-2">--}}
                                    {{--                                        <label class="custom-control-label" for="signin-remember-2">Remember Me</label>--}}
                                    {{--                                    </div>--}}

                                    {{--                                    <a href="#" class="forgot-link">Forgot Your Password?</a>--}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
