@extends('layouts.app-pages')

@section('content')
<div class="p-4" style="margin-bottom: 200px;">
    <div class="mt-5 my-4">
        <h3 style="font-size: 30px;font-weight: 700;" class="text-dark">Pemasukan</h3>
    </div>

    <div class="wallet bg-primary p-3 shadow" style="border-radius: 25px;">
        <div class="d-flex">
            <div class="col-2 my-auto">
                <i class="fas fa-wallet fa-2x"></i>
            </div>
            <div class="col">
                <p class="m-0" style="font-weight: 700;font-size: 15px">Penjualan hari ini</p>
                <div class="d-flex">
                    <p class="m-0 mt-auto">Rp</p>&nbsp;<p id="pendapatan" class="m-0" style="font-size: 25px;font-weight: 600" id="pendapatan">500.000</p>
                </div>
                <p class="m-0" style="font-weight: 600" id="pesanan">12 pesanan</p>
            </div>
            <div class="col-1 my-auto">
                <i class="fas fa-chevron-right text-right">
                </i>
            </div>
        </div>
    </div>

    <div class="list text-dark">
        <p class="m-0 my-3" style="font-size: 20px;font-weight: 600">Hari ini</p>
        <div id="list-pemasukan">
            {{-- <div class="list-harga p-3 mb-4" style="background: #F3F6FB;border-radius: 20px;">
                <table class="w-100">
                    <tr style="font-size: 14px;font-weight: 600;color: #9EA0AE">
                        <td>8 Desember 2022</td>
                        <td class="text-right">12:59</td>
                    </tr>
                    <tr   style="font-size: 14px;font-weight: 600;color: #000">
                        <td class="pb-2">Jumlah Item</td>
                        <td class="text-right pb-2">2</td>
                    </tr>
                    <tr >
                        <td style="font-size: 18px;font-weight: 600;color: #000">Rp 24.000</td>
                        <td class="d-flex justify-content-end">
                            <i class="fas fa-money-bill text-success my-auto"></i>&nbsp;
                            <p class="m-0 text-success " style="font-size: 15px;font-weight: 600;">Tunai</p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="list-harga p-3 mb-4" style="background: #F3F6FB;border-radius: 20px;">
                <table class="w-100">
                    <tr style="font-size: 14px;font-weight: 600;color: #9EA0AE">
                        <td>8 Desember 2022</td>
                        <td class="text-right">12:59</td>
                    </tr>
                    <tr   style="font-size: 14px;font-weight: 600;color: #000">
                        <td class="pb-2">Jumlah Item</td>
                        <td class="text-right pb-2">1</td>
                    </tr>
                    <tr >
                        <td style="font-size: 18px;font-weight: 600;color: #000">Rp 18.000</td>
                        <td class="d-flex justify-content-end">
                            <i class="fas fa-money-bill text-success my-auto"></i>&nbsp;
                            <p class="m-0 text-success " style="font-size: 15px;font-weight: 600;">Tunai</p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="list-harga p-3 mb-4" style="background: #F3F6FB;border-radius: 20px;">
                <table class="w-100">
                    <tr style="font-size: 14px;font-weight: 600;color: #9EA0AE">
                        <td>8 Desember 2022</td>
                        <td class="text-right">12:59</td>
                    </tr>
                    <tr   style="font-size: 14px;font-weight: 600;color: #000">
                        <td class="pb-2">Jumlah Item</td>
                        <td class="text-right pb-2">4</td>
                    </tr>
                    <tr >
                        <td style="font-size: 18px;font-weight: 600;color: #000">Rp 52.000</td>
                        <td class="d-flex justify-content-end">
                            <i class="fas fa-money-bill text-success my-auto"></i>&nbsp;
                            <p class="m-0 text-success " style="font-size: 15px;font-weight: 600;">Tunai</p>
                        </td>
                    </tr>
                </table>
            </div> --}}
        </div>
    </div>
</div>
@endsection


@section('script')
    <script>
        checkURL()

        $.ajax({
            url : '/api/transaksi/pemasukan',
            type : "GET",
            success : function (data) {
                console.log(data);
                var res = data.data.data
                var psn = data.data.pesanan
                $('#pendapatan').html(ribuan(res[0]['total']))
                $('#pesanan').html(res[0]['pesanan'] + ' pesanan')
                psn.forEach(el => {
                    var date = new Date(el.waktu);
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
                    var hr = h + ':' + m ;
                    var day = day + " " + month + " " + year;
                    $('#list-pemasukan').append(`
                    <div class="list-harga p-3 mb-4" style="background: #F3F6FB;border-radius: 20px;">
                <table class="w-100">
                    <tr style="font-size: 14px;font-weight: 600;color: #9EA0AE">
                        <td>${day}</td>
                        <td class="text-right">${hr}</td>
                    </tr>
                    <tr   style="font-size: 14px;font-weight: 600;color: #000">
                        <td class="pb-2">Jumlah Item</td>
                        <td class="text-right pb-2">${el.qty}</td>
                    </tr>
                    <tr >
                        <td style="font-size: 18px;font-weight: 600;color: #000">Rp ${ribuan(el.harga)}</td>
                        <td class="d-flex justify-content-end">
                            <i class="fas fa-money-bill text-success my-auto"></i>&nbsp;
                            <p class="m-0 text-success " style="font-size: 15px;font-weight: 600;">Tunai</p>
                        </td>
                    </tr>
                </table>
            </div>`);
                });
            }
        })
    </script>
@endsection
