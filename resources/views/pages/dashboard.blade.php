@extends('layouts.app-pages')

@section('content')

<div class="px-4 mt-4">
    <div class="head">
        <div class="d-flex text-dark">
            <p style="font-size: 12px" class="m-0">Pesan ke</p>&nbsp;<i class="fas fa-chevron-down"></i>
        </div>
        <h3 style="font-size: 15px" class="font-weight-bolder text-black-50">Gedung Sistem Informasi</h3>
    </div>

    <div class="search my-4">
        <div class="d-flex">
            <div class="col-md-11 p-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text" style="background: #F3F6FB; border:none;border-radius:22.5px 0 0px 22.5px">
                            <span class="material-symbols-rounded">
                                search
                                </span>
                        </div>
                    </div>
                    <input type="text" class="form-control" style="background: #F3F6FB;border:none;border-radius:0 22.5px 22.5px 0" placeholder="">
                </div>
            </div>
            <div class="col pr-0">
                <button class="btn w-100" style="background: #F3F6FB; border-radius: 22.5px; padding-top:3px;padding-bottom:1px;">
                    <span class="material-symbols-rounded mt-1">
                        tune
                        </span>
                </button>
            </div>
        </div>
    </div>

    <div class="carousel-promo">
        <div class="owl-carousel owl-theme">
            <div class="item">
                <img src="{{asset('banner/banner1.png')}}" alt="">
            </div>
            <div class="item">
                <img src="{{asset('banner/banner1.png')}}" alt="">
            </div>
            <div class="item">
                <img src="{{asset('banner/banner1.png')}}" alt="">
            </div>
            <div class="item">
                <img src="{{asset('banner/banner1.png')}}" alt="">
            </div>
            <div class="item">
                <img src="{{asset('banner/banner1.png')}}" alt="">
            </div>
            <div class="item">
                <img src="{{asset('banner/banner1.png')}}" alt="">
            </div>
            <div class="item">
                <img src="{{asset('banner/banner1.png')}}" alt="">
            </div>

        </div>
    </div>

    <style>
        .btn-menu::-webkit-scrollbar {
            display: none;
        }
    </style>
    <div class="btn-menu my-3" style="overflow-x: auto;overflow-y: hidden;white-space: nowrap;-ms-overflow-style: none;scrollbar-width: none;">
            <button class="btn btn-primary mr-2" style="border-radius: 12px;">
                <div class="d-flex">
                    <span class="material-symbols-rounded" style="font-size: 20px;">
                        rice_bowl
                        </span>
                        <p class="ml-2 m-0 my-auto" style="font-size: 13px;">
                            Rice
                        </p>
                </div>
            </button>
            <button class="btn btn-primary mr-2 " style="border-radius: 12px;">
                <div class="d-flex">
                    <span class="material-symbols-rounded" style="font-size: 20px;">
                        ramen_dining
                        </span>
                        <p class="ml-2 m-0 my-auto" style="font-size: 13px;">
                            Mie
                        </p>
                </div>
            </button>
            <button class="btn btn-primary mr-2 " style="border-radius: 12px;">
                <div class="d-flex">
                    <span class="material-symbols-rounded" style="font-size: 20px;">
                        water_full
                        </span>
                        <p class="ml-2 m-0 my-auto" style="font-size: 13px;">
                            Minuman
                        </p>
                </div>
            </button>

            <button class="btn btn-primary mr-2" style="border-radius: 12px;">
                <div class="d-flex">
                    <span class="material-symbols-rounded" style="font-size: 20px;">
                        rice_bowl
                        </span>
                        <p class="ml-2 m-0 my-auto" style="font-size: 13px;">
                            Rice
                        </p>
                </div>
            </button>
            <button class="btn btn-primary mr-2 " style="border-radius: 12px;">
                <div class="d-flex">
                    <span class="material-symbols-rounded" style="font-size: 20px;">
                        ramen_dining
                        </span>
                        <p class="ml-2 m-0 my-auto" style="font-size: 13px;">
                            Mie
                        </p>
                </div>
            </button>
            <button class="btn btn-primary mr-2 " style="border-radius: 12px;">
                <div class="d-flex">
                    <span class="material-symbols-rounded" style="font-size: 20px;">
                        water_full
                        </span>
                        <p class="ml-2 m-0 my-auto" style="font-size: 13px;">
                            Minuman
                        </p>
                </div>
            </button>


    </div>


    <div class="makanan row d-flex" id="list-menu-user" style="padding-bottom: 100px">
        {{-- <div class="col">
            <a href="/detail">
                <div class="card border-0 shadow" style="border-radius: 10px;" >
                    <img src="{{asset('menu/menu1.png')}}" class="card-img-top border-0" style="border-radius: 10px 10px 0 0" alt="...">
                    <div class="card-body p-2 text-dark">
                      <p style="font-size: 2.8vw;font-weight: 700">Nasi Goreng Mamita</p>
                      <p style="font-size: 10px;color: rgb(105, 105, 105)">Kantin Pusat ITS</p>
                    </div>
                  </div>
            </a>
        </div>
        <div class="col">
            <div class="card border-0 shadow" style="border-radius: 10px" >
                <img src="{{asset('menu/menu2.png')}}" class="card-img-top img-fluid" style="border-radius: 10px 10px 0 0" alt="...">
                <div class="card-body p-2 text-dark">
                    <p style="font-size: 2.8vw;font-weight: 700">Rumah Seblak</p>
                    <p style="font-size: 10px;color: rgb(105, 105, 105)">Kantin Pusat ITS</p>
                </div>
              </div>

        </div> --}}
    </div>
</div>

@endsection

@section('script')
    <script>
        $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})

    $(document).ready(function () {
        $.ajax({
            url:'/api/menu/all',
            type : 'GET',
            success : function (data) {
                console.log(data);
                var res = data.data;
                res.forEach(el => {

                        console.log(el.gambar);

                        var gambar = JSON.parse(el.gambar)
                    $('#list-menu-user').append(`
                    <div class="col-6 mb-4">
                <a href="/user/detail?id=${el.id}">
                    <div class="card border-0 shadow" style="border-radius: 10px;" >
                        <img src="{{asset('storage/menu/${gambar[0]}')}}" class="card-img-top border-0" style="border-radius: 10px 10px 0 0;max-height:100px;object-fit:cover" alt="...">
                        <div class="card-body p-2 text-dark">
                          <p style="font-size: 2.8vw;font-weight: 700">${el.nama}</p>
                          <p style="font-size: 10px;color: rgb(105, 105, 105)">${el.user.name}</p>
                        </div>
                      </div>
                </a>
            </div>`)
                });
            }
        })
    })
    </script>
@endsection
