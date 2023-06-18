@extends('layouts.app-pages')

@section('content')
<div class="p-4" style="margin-bottom: 200px;">
    <div class="mt-5">
        <h3 style="font-size: 30px;font-weight: 900;" class="text-dark">Keranjang</h3>

        <div id="alamat-antar" class="d-flex px-2 py-2 text-dark" style="background: #F3F6FB;border-radius: 10px">
            <div class="col-md-11">
                <small style="font-size: 10px;">Antar ke</small>
                <p style="font-size: 12px;font-weight: 800">Departemen Sistem Informasi</p>
            </div>
            <div class="col my-auto">
                <i class="fas fa-chevron-right text-dark" >

                </i>
            </div>
        </div>

    </div>
    <div id="catatan" class="my-4">
        <button class="btn btn-primary d-flex" style="border-radius:25px;">
            <i class="fas fa-pencil-alt my-auto"></i>&nbsp;&nbsp;
            <p style="font-size: 13px;" class="m-0 my-auto">Tambah Catatan</p>
        </button>
    </div>

    <div class="detail ">
        <p style="font-size: 13px;font-weight: 700;color:black" class="m-0" id="nama_owner">Nasi Goreng Mamita</p>
        <p style="font-size: 13px;font-weight: 500;color:grey">Kantin Pusat ITS</p>

        <div class="detail-pesanan p-3" style="background: #F3F6FB;border-radius: 10px">
            <div class="d-flex">
                <div class="col-2 p-0">
                    <img id="gambar" src="{{asset('menu/menu1.png')}}" class="img-fluid text-left" style="height: 50px;width: 50px;border-radius: 10px;object-fit: cover" alt="">
                </div>
                <div class="col-5">
                    <div >
                        <p class="m-0" style="font-size: 10px;font-weight: 600;color:black" id="nama_menu">Nasi Goreng Original</p>
                        <p style="font-size: 12px;font-weight: 600;color:grey" id="harga">Rp 12.000</p>
                        <button class="btn btn-primary btn-sm d-flex py-0" style="border-radius:25px;">
                            <i class="fas fa-pencil-alt my-auto" style="font-size: 10px"></i>&nbsp;
                            <p style="font-size: 10px;" class="m-0 my-auto "> Catatan</p>
                        </button>
                    </div>
                </div>
                <div class="col-5">
                    <div class="d-flex justify-content-end align-content-end" style="position: absolute;bottom: 0;right: 0;">
                        {{-- <button class="btn py-1 px-2" style="background: #fff;border-radius: 25px;" id="btn-rm-qty"> --}}
                            <i class="fas fa-minus p-2" style="color: #9EA0AE;font-size: 8px; background: #fff;border-radius: 25px;" id="btn-rm-qty"></i>
                        {{-- </button> --}}
                        <h2 class="text-dark my-auto m-0  mx-3" style="font-weight: 900;font-size: 8px;" id="qty">1</h2>
                        {{-- <button class="btn" style="background: #fff;border-radius: 50px;" id="btn-add-qty"> --}}
                            <i class="fas fa-plus p-2" style="color: #9EA0AE;font-size: 8px; background: #fff;border-radius: 25px;" id="btn-add-qty"></i>
                        {{-- </button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="promo" class="py-4">
        <button class="btn btn-sm d-flex w-100 justify-content-center" style="border: 2px solid #DEDFE9;border-radius: 25px;">
            {{-- <i class="fas fa-badge-percent  my-auto"></i>&nbsp;&nbsp; --}}
            <span class="fa-stack" style="vertical-align: top;font-size: ">
                <i class="fas fa-certificate fa-stack-2x"></i>
                <i class="fas fa-percentage fa-stack-1x text-white"></i>
              </span>&nbsp;
            <p style="font-size: 13px;" class="m-0 my-auto">Tambahkan Promo</p>
        </button>
    </div>

    <div id="total " class="text-dark">
        <table class="w-100">
            <tr>
             <td>
                 <p style="font-size: 13px;font-weight: 500">
                     Total Makanan
                    </p>
             </td>
             <td class="text-right">
                 <p style="font-size: 13px;font-weight: 900" id="total_makanan">Rp 12.000</p>
             </td>
            </tr>
            <tr>
             <td>
                 <p style="font-size: 13px;font-weight: 500">
                     Biaya Ongkir dan Platform
                     </p>
             </td>
             <td class="text-right">
                 <p style="font-size: 13px;font-weight: 900" id="ongkir">Rp 5.000</p>
             </td>
            </tr>
        </table>
    </div>
</div>

@endsection


@section('script')
    <script>
        var total = 0;
        var ongkir = 0;
        var totalByr = 0;

        $(document).ready(function () {
            var id = urlParam('id');
            $.ajax({
                url : "/api/transaksi/" + id,
                type : 'GET',
                success : function (data) {
                    console.log(data);
                    var dataTr = data.data
                    var res = data.data.menu
                    var user = data.data.menu.user
                    var fav = JSON.parse(user.favorites)
                    console.log(res);
                    var image = JSON.parse(res.gambar)

                    $('#gambar').attr('src', window.location.origin + '/storage/menu/' + image[0]);
                    $('#nama_owner').html(res.user.name);
                    $('#nama_menu').html(res.nama);

                    $('#qty').html(dataTr.qty);
                    // $('#harga')

                    $('#harga').html(rupiah(res.harga));
                    $('#deskripsi').html(res.deskripsi)
                    total = res.harga
                    ongkir = 5000
                    totalByr = dataTr.total+ongkir;
                    $('#total_makanan').html(rupiah(total * $('#qty').text()))
                    $('#ongkir').html(rupiah(ongkir))
                    $('#harga-bayar').html(rupiah(totalByr))
                }
            })
        })

        $('#btn-add-qty').click(function () {
            // console.log('tes');
            qty =  $('#qty').text();
            qty++;
            $('#qty').html(qty);
            totalByr = total * $('#qty').text() + ongkir
            $('#total_makanan').html(rupiah(total * $('#qty').text()))
            $('#harga-bayar').html(rupiah(totalByr))
        });

        $('#btn-rm-qty').click(function () {
            if (qty > 1) {
                qty--;
                $('#qty').html(qty);
                totalByr = total * $('#qty').text() + ongkir
                $('#total_makanan').html(rupiah(total * $('#qty').text()))
                $('#harga-bayar').html(rupiah(totalByr))
            }else{

                alertError('Minimal Pesanan 1');
            }
        });

        $('#rincian').on('click', function () {
            var menu_id = urlParam('id');
            var qty = $('#qty').text();
            var totalBayar = totalByr
            var pembayaran = 'tunai'
            // console.log(totalBayar);
            $.ajax({
                url  : '/api/transaksi/' + menu_id,
                type : 'PUT',
                data : {
                    menu_id : menu_id,
                    qty : qty,
                    total : totalBayar,
                    pembayaran : pembayaran,
                    status : 'checkout'
                },
                success : function (data) {
                    // console.log(data);
                    alertSuccess("Berhasil di checkout")

                    setTimeout(() => {
                        // var id = urlParam('id');
                        window.location.href = window.location.origin + '/user/rincian?id=' + menu_id
                    }, 2000);
                    // console.log('href="/user/rincian"');
                }
            })
        })
    </script>
@endsection
