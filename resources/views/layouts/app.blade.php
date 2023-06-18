<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/5f712d1a25.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;700&display=swap');
    </style>

<style>
    .mobile-container {
        max-width: 480px;
        /* max-height: 100vh; */
        margin: auto;
        background-color: ;
        color: white;
    }

    .input-icons i {
            position: absolute;
        }

        .input-icons {
            width: 100%;
            margin-bottom: 10px;
        }

        .icon {
            padding: 10px;
            min-width: 40px;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            text-align: center;
        }

        html, body {
        height: 100%;
        font-family: 'Poppins', sans-serif;
    }


    .btn-primary, .bg-primary{
        background: #12397B !important;
        border: 0;
    }

    .text-primary{
        color: #12397B !important;
    }

</style>
<body >

    <div id="splash">
        @include('layouts.splash')
    </div>

    <div id="inner" style="font-family: 'Poppins', sans-serif;" >
        <div class="mobile-container ">
            @yield('content')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    @yield('script')
    <script>
        $(document).ready(function(){
            var isFirst = localStorage.getItem('isFirst');
            if (isFirst == null || isFirst == true || isFirst == undefined) {
                localStorage.setItem('isFirst', 'true');
                $('#splash').show();
                $('#inner').hide();

                setTimeout(() => {
                    $('#splash').hide();
                    $('#inner').show();
                    localStorage.setItem('isFirst', 'false');
                }, 3000);
            } else{
                $('#splash').hide();
                $('#inner').show();
            }

        }
        );

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
    </script>
</body>
</html>
