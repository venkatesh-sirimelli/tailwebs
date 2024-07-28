@extends('layout.layout')
@section('title', 'Login')
@section('content')
    <style>
        .site_background {
            padding: 0;
        }

        .site_title {
            position: absolute;
            top: 100px;
            text-align: center;
            display: block;
            right: 0;
            left: 0;
        }
    </style>
    <div class="login_box">
        <div class="main_div">
            <a href="/home" class="site_title">tailwebs.</a>
            @error('login_error')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{$message}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @enderror
            <form action="{{ route('login') }}" class="login_form" method="POST">
                @csrf
                <div class="field">
                    <label for="username">Username</label>
                    <div class="input_box">
                        <i class="fas fa-user input_icon"></i>
                        <input type="text" class="input_field" name="username" required
                            data-parsley-required-message="Username is required" value="admin" />
                    </div>
                    @error('username')
                        <div class="bg-danger text-light px-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="field">
                        <label for="username">Password</label>
                        <div class="input_box">
                            <i class="fas fa-lock input_icon"></i>
                            <input type="password" class="input_field" name="password" value="admin@123" required
                                data-parsley-required-message="Password is required" data-parsley-minlength="6"
                                data-parsley-minlength-message="Password must be at least 6 characters long" />

                            <i class="fa fa-eye  password_icon" aria-hidden="true"></i>
                        </div>
                        <a href="/forgot-password" style="float: right;text-decoration: none;">Forgot Password</a>
                        @error('password')
                            <div class="bg-danger text-light px-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="text-center" style="margin-top:50px;">
                            <button type="submit" class="t_button">Login</button>
                        </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.login_form').parsley();
            $(document).on('click', '.password_icon', function() {
                if ($(this).hasClass('fa-eye')) {
                    $(this).removeClass('fa-eye');
                    $(this).addClass('fa-eye-slash');
                    $(this).parent().find('.input_field').attr('type', 'text');
                } else {
                    $(this).removeClass('fa-eye-slash');
                    $(this).addClass('fa-eye');
                    $(this).parent().find('.input_field').attr('type', 'password');
                }
            });
        });
    </script>
@endsection
