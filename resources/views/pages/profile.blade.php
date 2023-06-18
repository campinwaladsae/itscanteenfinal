@extends('layouts.app-pages')

@section('content')
    @php
    $menu = [
        [
            'nama' => "Profile",
            'link' => '/profile'
        ],
        [
            'nama' => "Metode Pembayaran",
            'link' => '/metode'
        ],
        [
            'nama' => "Alamat Tersimpan",
            'link' => '/alamat-tersimpan'
        ]
    ];

    $pengaturan = [
        [
            'nama' => "Notifikasi",
            'link' => '/profile'
        ],
        [
            'nama' => "Bantuan",
            'link' => '/metode'
        ],
        [
            'nama' => "Keluar",
            'link' => '/'
        ]
    ]
    @endphp
    <div class="p-4" style="margin-bottom: 200px;">
        <div class="mt-5 my-4">
            <h3 style="font-size: 30px;font-weight: 900;" class="text-dark">Akun</h3>
        </div>

        <div class="photo d-flex">
            <div class="col-3 pl-0">
                <img src="{{asset('img/profile.png')}}" class="img-fluid " style="max-height: 100px;clip-path: circle()"  alt="">
            </div>
            <div class="col-md-10 p-0 my-auto">
                <p style="font-weight: 900;font-size: 16px;" class="text-dark m-0">{{Auth::user()->name}}</p>
                <button class="btn btn-sm btn-primary px-3" style="border-radius: 25px;font-size: 12px;font-weight: 700;">
                    <i class="fas fa-pencil-alt"></i>&nbsp;ubah
                </button>
            </div>
        </div>

        <div class="list-menu mt-3">
            @foreach ($menu as $item)
            <a href="{{$item['link']}}" class="d-flex justify-content-between text-dark py-2 mb-2" style="border-bottom: 1px solid #F3F6FB">
                <p class="m-0 text-bold" style="font-weight: 500; font-size: 15px;">{{$item['nama']}}</p>
                <i class="fas fa-chevron-right" style="color:#adadad"></i>
            </a>
            @endforeach
        </div>

        <div class="pengaturan my-3 ">
            <p style="font-size: 15px;font-weight: 900;" class="m-0 text-dark">Pengaturan</p>
        </div>
        <div class="list-menu">
            @foreach ($pengaturan as $itm)
            @if ($itm['nama'] == 'Keluar')
                <button id="btn-logout-user" class="d-flex w-100 p-0 btn justify-content-between text-dark py-2 mb-2" style="border-bottom: 1px solid #F3F6FB">
                    <p class="m-0 text-bold" style="font-weight: 500; font-size: 15px;">{{$itm['nama']}}</p>
                    <i class="fas fa-chevron-right" style="color:#adadad"></i>
                </button>
            @else
                <a href="{{$itm['link']}}" class="d-flex justify-content-between text-dark py-2 mb-2" style="border-bottom: 1px solid #F3F6FB">
                    <p class="m-0 text-bold" style="font-weight: 500; font-size: 15px;">{{$itm['nama']}}</p>
                    <i class="fas fa-chevron-right" style="color:#adadad"></i>
                </a>
            @endif
            @endforeach
        </div>
    </div>

@endsection


@section('script')
<script>
    $(document).ready(function () {
        checkURL();
    })

    $('#btn-logout-user').on('click', function () {
        console.log("TEST");
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda akan logout dari sistem",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Logout!'
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url : '/api/logout',
                    type: 'POST',
                    success : function (data) {
                        console.log(data);
                        alertSuccess("Berhasil Logout");
                        setTimeout(() => {
                            window.location.href = window.location.origin + '/'
                        }, 2000);
                    },
                    error : function (err) {
                        alertError(err.responseJSON.message);

                    }
                })
            }
          })
    })
</script>
@endsection
