<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="{{asset('owlcarousel/dist/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('owlcarousel/dist/assets/owl.theme.default.min.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
    <script src="https://kit.fontawesome.com/5f712d1a25.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap');
    </style>

<style>
    .mobile-container {
        max-width: 100vw;
        max-height: 100vh;
        margin: auto;
        background-color: ;
        color: white;
    }

    .btn-primary, .bg-primary{
        background: #12397B !important;
        border: 0;
    }

    .text-primary{
        color: #12397B !important;
    }

    .mobile-container .mobile-nav {
        max-width: 100vw;
        margin: auto;
        background-color: ;
        color: white;
    }


    .material-symbols-rounded {
        font-variation-settings:
        'FILL' 0,
        'wght' 700,
        'GRAD' 0,
        'opsz' 48
    }

    /* .material-symbols-rounded  {
        font-variation-settings:
        'FILL' 1,
        'wght' 700,
        'GRAD' 0,
        'opsz' 48
    } */
    .owl-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span {
    background: #12397B;
    width: 25px;
    transition: all 0.3s ease;
    }


</style>
<body >



    <div id="inner" style="font-family: 'Poppins', sans-serif;" >
        <div class="mobile-container">

            @yield('content')
            @include('layouts.navbar')
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script src="{{asset('owlcarousel/dist/owl.carousel.min.js')}}"></script>

    <script>
         var curCookie = Cookies.get('admin_cookie') ?? (Cookies.get('owner_cookie') ?? Cookies.get('user_cookie'));
         $(document).ready(function () {
            var urlNow = window.location.href.split('/')
            // console.log();
            if (urlNow[urlNow.length - 1].split('?')[0] == 'checkout') {
                $('#section-co').attr('hidden', false)
            }else{
                $('#section-co').attr('hidden', true)
            }

            if (window.location.pathname == "/owner/tambah-kategori") {
                $('#btn-save-menu').data(window.location.origin + "/api/kategori")
            }

            if (window.location.pathname == '/owner/tambah-menu') {
                $('#btn-save-menu').data(window.location.origin + "/api/tugas")
            }
        })

        const rupiah = (number)=>{
            return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR"
            }).format(number);
        }

        function strLimit(data) {
            return data.length > 80 ? data.substring(0,80) + '...' : data
        }


        function checkURL() {
            console.log(window.location.pathname);
            $('.btn-item').removeClass('text-primary').addClass('text-secondary')
            switch (window.location.pathname) {
                case '/owner/dashboard':
                    return $('#btn-home-owner').addClass('text-primary').removeClass('text-secondary');
                    break;
                case '/owner/pemasukan':
                    return $('#btn-pemasukan').addClass('text-primary').removeClass('text-secondary');
                    break;
                case '/owner/inbox':
                    return $('#btn-inbox').addClass('text-primary').removeClass('text-secondary');
                    break;
                case '/user/dashboard':
                    return $('#btn-home-user').addClass('text-primary').removeClass('text-secondary');
                    break;
                case '/user/cart':
                    return $('#btn-cart-user').addClass('text-primary').removeClass('text-secondary');
                    break;
                case '/user/favorite':
                    return $('#btn-favorite').addClass('text-primary').removeClass('text-secondary');
                    break;
                case '/user/profile':
                    return $('#btn-profile-user').addClass('text-primary').removeClass('text-secondary');
                    break;
                case '/owner/profile':
                    return $('#btn-profile-owner').addClass('text-primary').removeClass('text-secondary');
                    break;
                default:
                    break;
            }
        }

        function alertSuccess(msg) {
            Swal.fire({
                title : "Berhasil",
                icon: "success",
                text : msg,
                timer: 2000,
                showConfirmButton :false,
                timerProgressBar: true
            })
        }

        function alertError(msg) {
            Swal.fire({
                title : "Gagal",
                icon: "error",
                text : msg,
                timer: 2000,
                showConfirmButton :false,
                timerProgressBar: true
            })
        }

        urlParam = function (name) {
            var results = new RegExp('[\?&]' + name + '=([^&#]*)')
                            .exec(window.location.search);

            return (results !== null) ? results[1] || 0 : false;
        }

        function ribuan(x) {
            return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
        }
    </script>

    @yield('script')

</body>
</html>
