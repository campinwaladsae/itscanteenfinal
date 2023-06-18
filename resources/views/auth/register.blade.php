@extends('layouts.app')

@section('content')

<div class="px-4">

    <div class="text-center mb-3 pt-4">
        <img src="{{asset('img/logo_its.png')}}" style="max-height: 150px" class="img-fluid" alt="">
    </div>
    <div class="mb-3">
        <h3 class="text-dark font-weight-bolder" style="font-size: 25px">Create an account</h3>
        <p class="text-muted" style="font-size: 14px">Connect with your friends today!</p>
    </div>
    <div class="form" style="margin-bottom: 13vh;font-size: 14px">
        <div class="form-group">
            <label for="" class="text-dark">Name</label>
            <input type="text" id="name" placeholder="enter your name" class="form-control">
        </div>
        <div class="form-group">
            <label for="email" class="text-dark">Email Address</label>
            <input type="text" name="email" id="email" class="form-control " placeholder="Enter your email">
        </div>
        <div class="form-group">
            <label for="" class="text-dark">Register as</label>
            <select name="" class="form-control" id="role">
                <option value="">--- Choose One ---</option>
                <option value="owner">Owner</option>
                <option value="user">User</option>
            </select>
        </div>
        <div class="form-group">
            <label for="password" class="text-dark">Phone Number</label>
            <div class="input-group input-group-sm">
                <div class="input-group-prepend ">
                    <div class="input-group-text">
                       +62
                    </div>
                </div>
                <input type="text" name="password" id="phone" class="form-control " placeholder="Enter your phonenumber">
            </div>
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
        <button class="btn btn-primary btn-block font-weight-normal" id="btn-register" style="border-radius: 20px;border:none">Register</button>
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
        <p class="text-muted mt-3">Already have an account? <a href="{{url('/')}}" class="text-primary">Login</a></p>
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

    $('#btn-register').on('click', function () {
        $.ajax({
                url : "/api/register",
                type : "POST",
                data  : {
                    email : $('#email').val(),
                    name : $('#name').val(),
                    password : $('#password').val(),
                    phone : $('#phone').val(),
                    role : $('#role').val()
                },
                success : function (data) {
                    console.log(data);
                    alertSuccess('Register Sukses')

                    setTimeout(() => {
                        window.location.href = '/'
                    }, 2000);
                    // if (data.data.user.role == 'admin') {
                    //     Cookies.set('admin_cookie', data.data.token)
                    //     setTimeout(() => {
                    //         location.href = '/admin'
                    //     }, 2000);
                    // }else if (data.data.user.role == 'owner') {
                    //     Cookies.set('owner_cookie', data.data.token)
                    //     setTimeout(() => {
                    //         location.href = '/owner/dashboard'
                    //     }, 2000);
                    // } else {
                    //     Cookies.set('user_cookie', data.data.token)
                    //     setTimeout(() => {
                    //         location.href = '/user/dashboard'
                    //     }, 2000);
                    // }
                },
                error : function (data) {
                    alertError(data.responseJSON.message)
                }
            })
    })
</script>
@endsection
