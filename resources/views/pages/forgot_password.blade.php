@extends('layout.layout')
@section('title', 'Forgot Password')
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
            <form action="{{ route('login') }}" class="forgot_pwd" method="POST">
                @csrf
                <div class="field">
                    <label for="username">Email</label>
                    <div class="input_box">
                        <i class="fas fa-user input_icon"></i>
                        <input type="text" class="input_field" name="email" required
                            data-parsley-required-message="Email is required" value="admin" />
                    </div>
                    @error('email')
                        <div class="bg-danger text-light px-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <a href="/login" style="float: right;text-decoration: none;">Login</a>

                        <div class="text-center" style="margin-top:50px;">
                            <button type="submit" class="t_button">Send Reset Link</button>
                        </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.forgot_pwd').parsley();
        });
    </script>
@endsection
