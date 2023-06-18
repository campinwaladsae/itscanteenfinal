@extends('layouts.app-pages')

@section('content')

<div class="p-4">
    <div class="d-flex mb-4 mt-5">
        <div class="p-0 col-2 my-auto" onclick="dismissPop()">
            <a href="/owner/dashboard">
                <i class="fas fa-chevron-left text-primary" style="font-size: 20px;"></i>
            </a>
        </div>
        <div class="col-8 text-center " onclick="dismissPop()">
            <p class="m-0 text-dark my-auto" style="font-size: 20px;font-weight: 700;">Daftar Menu</p>
        </div>
        <div class="col-2 p-0 my-auto text-right">
            <button class="btn " id="btn-add-menu">
                <i class="fas fa-plus text-primary" style="font-size: 20px;"></i>
            </button>
            <div class="card shadow border-0" hidden  id="pop-add-menu" style="width: 150px;position: absolute;right: 10px;z-index: 1000;">
                <div  class="card-body text-left" >
                    <li>
                        <a href="/owner/tambah-menu" style="text-decoration: none;color:black;font-size: 14px;">
                            Menu
                        </a>

                    </li>
                    <hr>
                    <li>
                        <a href="/owner/tambah-kategori" style="text-decoration: none;color:black;font-size: 14px;">
                            Kategori
                        </a>
                    </li>
                </div>

            </div>
        </div>
    </div>

    <div class="menu" onmouseover="dismissPop()" onclick="dismissPop()" id="list-menu">
        {{-- <div class="menus p-3 mb-4" style="background: #F3F6FB;border-radius: 20px;">
            <p style="font-weight: 600;font-size: 13px;" class="m-0 mb-2 text-black-50">MAKANAN</p>
            <div class="d-flex mb-3">
                <div class="col-2 p-0">
                    <img src="{{asset('menu/menu1.png')}}" class="img-fluid text-left" style="max-width: 60px;border-radius: 10px" alt="">
                </div>
                <div class="col-8">
                    <div >
                        <p class="m-0" style="font-size: 13px;font-weight: 600;color:black">Nasi Goreng Original</p>
                        <p style="font-size: 12px;font-weight: 600;color:grey">Rp 12.000</p>
                    </div>
                </div>
                <div class="col-2 p-0 text-right my-auto">
                    <a href="" style="text-decoration: none;color: grey">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
            <p class="m-0 text-black-50" style="font-size: 14px;font-weight: 600">
            Nasi goreng dengan irisan bakso dan telur orak-arik.
            </p>
        </div>
        <div class="menus p-3 mb-4" style="background: #F3F6FB;border-radius: 20px;">
            <p style="font-weight: 600;font-size: 13px;" class="m-0 mb-2 text-black-50">MAKANAN</p>
            <div class="d-flex mb-3">
                <div class="col-2 p-0">
                    <img src="{{asset('menu/menu2.png')}}" class="img-fluid text-left" style="max-width: 60px;border-radius: 10px" alt="">
                </div>
                <div class="col-8">
                    <div >
                        <p class="m-0" style="font-size: 13px;font-weight: 600;color:black">Nasi Goreng Kari</p>
                        <p style="font-size: 12px;font-weight: 600;color:grey">Rp 14.000</p>
                    </div>
                </div>
                <div class="col-2 p-0 text-right my-auto">
                    <a href="" style="text-decoration: none;color: grey">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
            <p class="m-0 text-black-50" style="font-size: 14px;font-weight: 600">
            Nasi goreng dengan kari dengan irisan daging ayam dan telur orak-arik.
            </p>
        </div> --}}
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $.ajax({
                url: "/api/menu",
                type : "GET",
                success : function (data) {
                    var res = data.data;
                    res.forEach(el => {
                        console.log(el.gambar);

                        var gambar = JSON.parse(el.gambar)
                        // console.log(gambar[0]);
                        $('#list-menu').append(`
            <div class="menus p-3 mb-4" style="background: #F3F6FB;border-radius: 20px; " data-id=${el.id}>
            <p style="font-weight: 600;font-size: 13px;" class="m-0 mb-2 text-black-50 text-uppercase">${el.kategori.nama}</p>
            <div class="d-flex mb-3">
                <div class="col-2 p-0">
                    <img src="{{asset('storage/menu/${gambar[0]}')}}" class="img-fluid text-left" style="height:60px;width: 60px;border-radius: 10px;object-fit:cover" alt="">
                </div>
                <div class="col-8">
                    <div >
                        <p class="m-0" style="font-size: 13px;font-weight: 600;color:black">${el.nama}</p>
                        <p style="font-size: 12px;font-weight: 600;color:grey">${rupiah(el.harga)}</p>
                    </div>
                </div>
                <div class="col-2 p-0 text-right my-auto">
                    <a href="" style="text-decoration: none;color: grey">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
            <p class="m-0 text-black-50" style="font-size: 14px;font-weight: 600">
                ${strLimit(el.deskripsi)}
            </p>
        </div>
        `)
                    });
                }
            })
        });


        $('body').on('click', '.menus',function () {
            var id = $(this).data('id')
            window.location.href =  window.location.origin + "/owner/edit-menu?id=" + id
        })

        $('#btn-add-menu').on('click', function () {
            // console.log("TEST");
            $('#pop-add-menu').attr('hidden',false)
        })

        function dismissPop() {
            console.log("OVER");
            if ( $('#pop-add-menu').attr('hidden',false)) {

                $('#pop-add-menu').attr('hidden',true)
            }
        }
    </script>
@endsection
