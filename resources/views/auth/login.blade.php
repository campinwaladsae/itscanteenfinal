@extends('layouts.app')

@section('content')

<div class="px-4">

    <div class="text-center mb-3 pt-4">
        <img src="{{asset('img/logo_its.png')}}" style="max-height: 150px" class="img-fluid" alt="">
    </div>
    <div class="mb-3">
        <h3 class="text-dark font-weight-bolder" style="font-size: 25px">Hi, Welcome Back!</h3>
        <p class="text-muted" style="font-size: 14px">Hello again, you've been missed!</p>
    </div>
    @if (Session::has('error'))
                        <div class="text-center w-100" style="margin-bottom: 15px;">
                            <x-flash-alert type="alert-danger" message="{{Session::get('error')}}"></x-flash-alert>
                        </div>
                    @endif
    <div class="form" style="margin-bottom: 13vh;font-size: 14px">
        <div class="form-group">
            <label for="email" class="text-dark">Email</label>
            <input type="text" name="email" id="email" class="form-control form-control-sm" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="password" class="text-dark">Password</label>
            <div class="input-group">
                <input type="password" name="" id="password" class="form-control " placeholder=""style="border-right: none !important">
                <div class="input-group-append">
                    <div class="input-group-text bg-white" style="border-left: none !important">
                        <i class="fa fa-eye" id="togglePassword" onclick="showPw()"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <div class="text-dark">
                <input type="checkbox" class="border-0"> Remember me
            </div>

            <a href="" class="text-danger">
                Forgot Password
            </a>
        </div>
    </div>
    <div class="form-group">
        <button id="btn-login" class="btn btn-primary btn-block font-weight-normal shadow" style="border-radius: 20px;border:none">Login</button>
    </div>
    <div class="text-dark py-3" >

        <p class="text-center w-100" style="border-bottom:1px solid black; line-height: 0.1em;">
            <span class="bg-white px-3">
                Or with
            </span>
        </p>
    </div>

    <div class="d-flex justify-content-between">
        <div class="col pl-0">
            <button class="btn btn-sm w-100" style="border:1px solid rgb(172, 172, 172); border-radius: 10px">
                <img src="{{asset('img/google.png')}}" style="max-height: 20px" alt="">
                Google
            </button>
        </div>

        <div class="col pr-0">
            <button class="btn btn-sm w-100" style="border:1px solid rgb(172, 172, 172); border-radius: 10px">
                <img src="{{asset('img/fb.png')}}" style="max-height: 20px" alt="">
                Facebook
            </button>
        </div>
    </div>


    <div class="text-center" style="font-size: 14px;margin-top: 70px">
        <p class="text-muted mt-3">Don't have an account? <a href="/register" class="text-primary">Sign Up</a></p>
    </div>
</div>
@endsection

@section('script')
    <script>
        function showPw() {
                var x = document.getElementById("password");
                if (x.type === "password") {
                    x.type = "text";
                    document.getElementById("togglePassword").classList.remove('fa-eye');
                    document.getElementById("togglePassword").classList.add('fa-eye-slash');
                } else {
                    x.type = "password";
                    document.getElementById("togglePassword").classList.remove('fa-eye-slash');
                    document.getElementById("togglePassword").classList.add('fa-eye');
                }
            }

        $('#btn-login').on('click', function () {
            $.ajax({
                url : "/api/login",
                type : "POST",
                data  : {
                    email : $('#email').val(),
                    password : $('#password').val()
                },
                success : function (data) {
                    console.log(data);
                    alertSuccess('Login Sukses')
                    if (data.data.user.role == 'admin') {
                        Cookies.set('admin_cookie', data.data.token)
                        setTimeout(() => {
                            location.href = '/admin'
                        }, 2000);
                    }else if (data.data.user.role == 'owner') {
                        Cookies.set('owner_cookie', data.data.token)
                        setTimeout(() => {
                            location.href = '/owner/dashboard'
                        }, 2000);
                    } else {
                        Cookies.set('user_cookie', data.data.token)
                        setTimeout(() => {
                            location.href = '/user/dashboard'
                        }, 2000);
                    }
                },
                error : function (data) {
                    alertError(data.responseJSON.message)
                }
            })
        })
    </script>
@endsection
