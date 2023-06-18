@extends('layouts.app-pages')

@section('content')
<div class="p-4" style="margin-bottom: 200px;">
    <div class="mt-5 my-4">
        <h3 style="font-size: 30px;font-weight: 700;" class="text-dark">Riwayat Pesanan</h3>
    </div>

    <div class="detail" id="list-co">


    </div>
</div>
@endsection

@section('script')
<script>
    checkURL();
    $(document).ready(function () {
        $.ajax({
            url : '/api/transaksi',
            type : 'GET',
            success : function (data) {
                console.log(data);
                var res = data.data
                res.forEach(el => {

                    var menu = el.menu
                    var img = JSON.parse(menu.gambar)
                    var url = el.status == 'cart' ? 'checkout' : 'rincian';
                    $('#list-co').append(`
                <a href="/user/${url}?id=${el.order_id}">
                    <div class="detail-pesanan p-3 mb-3" style="background: #F3F6FB;border-radius: 10px">
                <p style="font-size: 13px;font-weight: 700;color:black" class="m-0" id="nama_owner">${menu.user.name}</p>
                <p style="font-size: 13px;font-weight: 500;color:grey">Kantin Pusat ITS</p>
                <div class="d-flex">
                    <div class="col-2 p-0">
                        <img id="gambar" src="{{asset('storage/menu/${img[0]}')}}" class="img-fluid text-left" style="height: 50px;width: 50px;border-radius: 10px;object-fit:cover" alt="">
                    </div>
                    <div class="col-5">
                        <div >
                            <p class="m-0" style="font-size: 10px;font-weight: 600;color:black" id="nama_menu">${menu.nama}</p>
                            <p style="font-size: 12px;font-weight: 600;color:grey" id="harga">${rupiah(menu.harga)}</p>

                        </div>
                    </div>

                </div>
            </div>
        </a>`);
                });
            }
        })
    })
</script>
@endsection
