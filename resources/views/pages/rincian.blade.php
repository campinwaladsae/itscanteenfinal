@extends('layouts.app-pages')

@section('content')
    <div class="p-4">
        <div class="d-flex">
            <div class="col-2">
                <a href="/user/cart">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </div>
            <div class="col-8 text-center" >
                <p class="m-0 text-dark" style="font-size: 17px;font-weight: 700;">Rincian</p>
            </div>
            <div class="col-2 p-0">

            </div>
        </div>

        <div class="detail text-center">
            <p class="m-0 text-black-50" style="font-size: 13px;" id="tgl_tr">12:21 10 Juni 2023</p>
                <p class="m-0 text-black-50" style="font-size: 13px;">Order ID <span id="orderid"></span></p>
        </div>

        <div class="d-flex p-3 my-3 text-dark alamat-antar" style="background: #F3F6FB;border-radius: 15px">
            <div class="col-md-11 p-0">
                <small style="font-size: 10px;">Antar ke</small>
                <p style="font-size: 14px;font-weight: 800" class="m-0">Departemen Sistem Informasi</p>
            </div>
        </div>

        <div class="detail">
            <p style="font-size: 13px;font-weight: 700;color:black" class="m-0" id="nama_owner">Nasi Goreng Mamita</p>
            <p style="font-size: 13px;font-weight: 500;color:grey">Kantin Pusat ITS</p>

            <div class="d-flex">
                <div class="col-2 p-0">
                    <img src="{{asset('menu/menu1.png')}}" id="gambar" class="img-fluid text-left" style="height: 50px;width: 50px;border-radius: 10px" alt="">
                </div>
                <div class="col-5 pl-0">
                    <div >
                        <p class="m-0" style="font-size: 10px;font-weight: 600;color:black" id="nama_menu">Nasi Goreng Original</p>
                        <p style="font-size: 12px;font-weight: 600;color:grey" id="harga">Rp 12.000</p>
                    </div>
                </div>
            </div>

            <div class="detail-harga my-3 p-3" style="background: #F3F6FB;border-radius: 15px">
                <table class="w-100 text-dark" style="font-size: 13px">
                    <tr>
                        <td>Total Makanan</td>
                        <td class="text-right" style="font-weight: 800" id="harga-menu">Rp 12.000</td>
                    </tr>
                    <tr>
                        <td>Biaya Ongkir dan Platform</td>
                        <td class="text-right"  style="font-weight: 800" id="ongkir">Rp 5.000</td>
                    </tr>
                    <tr>
                        <td class="pt-2" style="font-size: 14px;font-weight: 800" id="total-bayar">Rp 17.000</td>
                        <td class="text-right pt-2 text-success">
                            <i class="fas fa-money-bill "></i> <span class="m-0" style="font-weight: 700">Tunai</span>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="status text-center mb-3" style="font-size: 13px;">
                <p class="text-black-50 mb-1" >Status</p>
                <p class="text-dark" style="font-weight: 900" id="status">Diantar</p>
            </div>

            <a href="" id="btn-lacak" class="btn btn-sm w-100 btn-primary text-bold py-2" style="border-radius: 25px; font-weight: 800">
                Lacak
            </a>
        </div>
    </div>
@endsection


@section('script')
    <script>
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

                    $('#btn-lacak').attr('href', "/user/review?id=" + dataTr.order_id)

                    $('#gambar').attr('src', window.location.origin + '/storage/menu/' + image[0]);
                    $('#nama_owner').html(res.user.name);
                    $('#nama_menu').html(res.nama);

                    $('#qty').html(dataTr.qty);
                    $('#orderid').html(dataTr.order_id)
                    // $('#harga')

                    $('#harga').html(rupiah(res.harga ));
                    $('#harga-menu').html(rupiah(res.harga * dataTr.qty ));
                    $('#deskripsi').html(res.deskripsi)
                    // total = res.harga
                    ongkir = 5000
                    // totalByr = dataTr.total+ongkir;
                    // $('#total_makanan').html(rupiah(total * $('#qty').text()))
                    $('#ongkir').html(rupiah(ongkir))
                    $('#total-bayar').html(rupiah(dataTr.total))

                    $('#status').html(dataTr.status)

                    var date = new Date(dataTr.updated_at);
                    // console.log(date.getMonth());
                    var months = [
                        'Januari',
                        'Februari',
                        'Maret',
                        'April',
                        'Mei',
                        'Juni',
                        'Juli',
                        'Agustus',
                        'September',
                        'Oktober',
                        'November',
                        'Desember'
                    ];

                    var day = date.getDate();
                    var month = months[date.getMonth()];
                    var year = date.getFullYear();

                    var hour = date.getHours();
                    var minute= date.getMinutes();

                    var h = hour < 10 ? '0' + hour  : hour
                    var m = minute < 10 ? '0' + minute  : minute

                    var dayAll = h + ':' + m + " " + day + " " + month + " " + year
                    $('#tgl_tr').html(dayAll)
                }
            })
        })
    </script>
@endsection
