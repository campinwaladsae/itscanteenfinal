@extends('layouts.app-pages')

@section('content')
<div class="p-4" style="margin-bottom: 200px;">
    <div class="mt-5 my-4">
        <h3 style="font-size: 30px;font-weight: 700;" class="text-dark">Pesanan</h3>
    </div>

    <div class="detail" id="list-pesanan">

        {{-- <div class="detail-pesanan p-3 mb-3" style="background: #F3F6FB;border-radius: 10px">
            <div class="d-flex justify-content-between">
                <div class="col-9 p-0">
                    <p style="font-size: 13px;font-weight: 700;color:black" class="m-0" id="kode_tr">#3210938919293</p>
                </div>
                <div class="col-3 text-right p-0">
                    <span class="badge badge-pills badge-secondary">Status</span>
                </div>
            </div>
            <div class="d-flex">

                <div class="col-5 p-0">
                    <div >
                        <p class="m-0" style="font-size: 10px;font-weight: 600;color:black" id="nama_menu">Auful</p>
                        <p style="font-size: 12px;font-weight: 600;color:grey" id="harga">350000</p>
                    </div>
                </div>


            </div>
        </div> --}}
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $.ajax({
            url : '/api/transaksi/pesanan',
            type : 'GET',
            success : function (data) {
                console.log(data);
                var res = data.data
                console.log(res);
                res.forEach(el => {
                    $('#list-pesanan').append(`
                    <div class="detail-pesanan p-3 mb-3" style="background: #F3F6FB;border-radius: 10px">
            <div class="d-flex justify-content-between">
                <div class="col-9 p-0">
                    <p style="font-size: 13px;font-weight: 700;color:black" class="m-0" id="kode_tr">#${el.order_id}</p>
                </div>
                <div class="col-3 text-right p-0">
                    <span class="badge badge-pills badge-secondary">${el.status}</span>
                </div>
            </div>
            <div class="d-flex">

                <div class="col-5 p-0">
                    <div >
                        <p class="m-0" style="font-size: 10px;font-weight: 600;color:black" id="nama_menu">${el.menu.nama}</p>
                        <p style="font-size: 12px;font-weight: 600;color:grey" id="harga">${rupiah(el.total)}</p>
                    </div>
                </div>


            </div>
        </div>`)
                });
            }
        })
    })
</script>
@endsection
