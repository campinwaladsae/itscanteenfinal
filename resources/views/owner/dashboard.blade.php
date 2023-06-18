@extends('layouts.app-pages')

@section('content')
<div class="p-4" style="margin-bottom: 200px;">
    <div class="mt-5 my-4">
        <h3 style="font-size: 30px;font-weight: 700;" class="text-dark m-0" id="nama_owner">Nasi Goreng Mamita</h3>
        <p class="text-dark" style="font-weight: 600">Kantin Pusat ITS</p>
    </div>

    <div class="wallet bg-primary p-3 shadow" style="border-radius: 25px;">
        <div class="d-flex">
            <div class="col-2 my-auto">
                <i class="fas fa-wallet fa-2x"></i>
            </div>
            <div class="col">
                <p class="m-0" style="font-weight: 700;font-size: 15px">Penjualan hari ini</p>
                <div class="d-flex">
                    <p class="m-0 mt-auto">Rp</p>&nbsp;<p id="pendapatan" class="m-0" style="font-size: 25px;font-weight: 600">500.000</p>
                </div>
                <p class="m-0" style="font-weight: 700" id="pesanan">12 pesanan</p>
            </div>
            <div class="col-1 my-auto">
                <i class="fas fa-chevron-right">
                </i>
            </div>
        </div>
    </div>

    <div class="d-flex my-5 justify-content-around">
        <div class="col-3 text-center" ">
            <a href="/owner/pesanan" style="color:#000;">
                <span class="material-symbols-rounded p-3" style="font-size: 35px;border:2px solid #DEDFE9;border-radius: 15px">
                    assignment
                    </span>
                    <p class=" m-0 mt-1" style="font-size: 14px;font-weight: 400;">
                        Pesanan
                    </p>
            </a>
        </div>
        <div class="col-3 text-center"  style="color:#000">
            <a href="/owner/menu" style="color:#000;">
                <span class="material-symbols-rounded  p-3" style="font-size: 35px;border:2px solid #DEDFE9;border-radius: 15px">
                    ramen_dining
                    </span>
                    <p class=" m-0 mt-1" style="font-size: 14px;font-weight: 400;">Menu</p>
            </a>
        </div>
        <div class="col-3 text-center"  style="color:#000;width: ;">
            <span class="material-symbols-rounded  p-3" style="font-size: 35px;border:2px solid #DEDFE9;border-radius: 15px">
                percent
                </span>
                <p class="m-0 mt-1 " style="font-size: 14px;font-weight: 400;">Promosi</p>
        </div>
    </div>

    <div class="berita">
        <p class="text-dark m-0 my-3" style="font-size: 20px;font-weight: 700;">Berita</p>

        <div class="card w-100  border-0 shadow mb-3" style="border-radius: 20px; border:2px solid #DEDFE9">
            <div style="background: url({{asset('berita/sby.png')}});background-repeat: no-repeat;background-size:cover;height:150px;border-radius: 20px 20px 0 0">

            </div>
            {{-- <img src="{{asset('berita/sby.png')}}" class="img-fluid" style="height: 100px" alt=""> --}}
            <div class="card-body">
                <p class="header text-dark m-0 my-2" style="font-size: 18px;font-weight: 700;">
                    Ayo mitra, mari rayakan Hari Jadi Surabaya!
                </p>
                <p class="body text-black-50 m-0" style="font-size: 15px;">
                    Dengan datangnya Hari Jadi Kota Surabaya, rayakan dengan promo berikut ini...
                </p>
            </div>
        </div>
        <div class="card w-100  border-0 shadow mb-3" style="border-radius: 20px; border:2px solid #DEDFE9">
            <div style="background: url({{asset('berita/sby.png')}});background-repeat: no-repeat;background-size:cover;height:150px;border-radius: 20px 20px 0 0">

            </div>
            {{-- <img src="{{asset('berita/sby.png')}}" class="img-fluid" style="height: 100px" alt=""> --}}
            <div class="card-body">
                <p class="header text-dark m-0 my-2" style="font-size: 18px;font-weight: 700;">
                    Ayo mitra, mari rayakan Hari Jadi Surabaya!
                </p>
                <p class="body text-black-50 m-0" style="font-size: 15px;">
                    Dengan datangnya Hari Jadi Kota Surabaya, rayakan dengan promo berikut ini...
                </p>
            </div>
        </div>
        <div class="card w-100  border-0 shadow mb-3" style="border-radius: 20px; border:2px solid #DEDFE9">
            <div style="background: url({{asset('berita/sby.png')}});background-repeat: no-repeat;background-size:cover;height:150px;border-radius: 20px 20px 0 0">

            </div>
            {{-- <img src="{{asset('berita/sby.png')}}" class="img-fluid" style="height: 100px" alt=""> --}}
            <div class="card-body">
                <p class="header text-dark m-0 my-2" style="font-size: 18px;font-weight: 700;">
                    Ayo mitra, mari rayakan Hari Jadi Surabaya!
                </p>
                <p class="body text-black-50 m-0" style="font-size: 15px;">
                    Dengan datangnya Hari Jadi Kota Surabaya, rayakan dengan promo berikut ini...
                </p>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
    <script>
        $.ajax({
            url : '/api/dashboard',
            type : 'GET',
            success :function (data) {
                console.log(data);
                var res= data.data
                $('#pesanan').html(res.pesanan.pesanan + ' pesanan')
                $('#pendapatan').html(ribuan(res.pesanan.total))
            }
        })
    </script>
@endsection
