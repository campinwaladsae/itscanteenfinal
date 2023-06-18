@extends('layouts.app-pages')

@section('content')
<div style="height:40vh">
    <div >
        <a href="/user/dashboard" class="btn " style="position:absolute;z-index:1000;top:10px;left:10px;border-radius: 20px;background: rgba(255, 255, 255, 0.572);backdrop-filter: blur(10px)">
            <i class="fas fa-chevron-left"></i>
        </a>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators" id="carousel-indicate">


            </ol>
            <div class="carousel-inner" id="list-img">

            </div>
            {{-- <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </button> --}}
          </div>
    </div>
</div>
<div class="mt-3 p-4">
    <div class="head text-dark">
        <div class="d-flex justify-content-between">
            <h2 style="font-weight: 900;font-size: 20px;" id="nama">Nasi Goreng Original</h2>
            <i class="far fa-star" onclick="addFavorite()" id="favorite" style="color:gold" data-id=""></i>
        </div>
        <p style="font-size: 14px;font-weight: 600" id="harga">Rp 12.000</p>
    </div>

    <div class="detail mt-4 text-dark" id="deskripsi">
        Nasi goreng dengan irisan bakso dan telur orak-arik
    </div>

    <div style="position: fixed; bottom: 50px;padding-bottom: 30px;width: 100vw;">
            <div class="d-flex">
                <div class="col-md-8 d-flex justify-content-between">
                    <button class="btn" style="background: #F3F6FB;border-radius: 25px;" id="btn-rm-qty">
                            <i class="fas fa-minus" style="color: #9EA0AE"></i>
                    </button>
                    <h2 class="text-dark m-0 my-auto mx-5" style="font-weight: 900;font-size: 20px;" id="qty">1</h2>
                    <button class="btn" style="background: #F3F6FB;border-radius: 25px;" id="btn-add-qty">
                            <i class="fas fa-plus" style="color: #9EA0AE"></i>
                    </button>
                </div>
                <div class="col-md-4 ">
                    <button id="btn-cart" class="btn btn-primary d-flex my-auto" style="border-radius: 20px;">
                        <span class="material-symbols-rounded" style="font-size: 20px">
                            shopping_cart
                            </span>
                            <p style="font-weight: 600;font-size: 13px" class="m-0">
                                Tambah
                            </p>
                    </button>
                </div>
            </div>
    </div>
</div>
@endsection

@section('script')

<script>
    var qty = 1;

    var id = urlParam('id');
    var harga = 0;
    $(document).ready(function () {
        $('#qty').html(qty);

        $.ajax({
            url : "/api/menu/" + id,
            type : 'GET',
            success : function (data) {
                console.log(data);
                var res = data.data.data
                var user = data.data.user
                var fav = JSON.parse(user.favorites)
                console.log(fav);
                var image = JSON.parse(res.gambar)
                image.forEach((element, idx) => {
                    $('#carousel-indicate').append(` <li data-target="#carouselExampleIndicators" data-slide-to="${idx}" class="active"></li>`)
                    $('#list-img').append(`
                    <div class="carousel-item ${idx == 0 ? 'active' : ""}">
                <img src="{{asset('storage/menu/${element}')}}" class="d-block w-100" style="height:40vh;object-fit:cover" alt="...">
              </div>`)
                });
                $('#nama').html(res.nama);
                $('#favorite').data('id', res.id)
                if (fav != null) {

                    if (fav.includes(res.id.toString())) {
                        // console.log("TRYE");
                        $('#favorite').removeClass('far').addClass('fas')
                    }else{
                        $('#favorite').removeClass('fas').addClass('far')

                    }
                }
                harga = res.harga
                $('#harga').html(rupiah(res.harga));
                $('#deskripsi').html(res.deskripsi)
            }
        })
    });

    function checkFavorite() {
        $.ajax({
            url : "/api/menu/" + id,
            type : 'GET',
            success : function (data) {
                console.log(data);
                var res = data.data.data
                var user = data.data.user
                var fav = JSON.parse(user.favorites)

                $('#favorite').data('id', res.id)
                $('#favorite').data('id', res.id)
                if (fav.includes(res.id.toString())) {
                    console.log("TRYE");
                    $('#favorite').removeClass('far').addClass('fas')
                }else{
                    $('#favorite').removeClass('fas').addClass('far')

                }

            }
        })
    }

    function addFavorite() {
        var id = $('#favorite').data('id');
        $.ajax({
            url : "/api/menu/favorite/" + id,
            type : "PUT",
            success : function () {
                checkFavorite()
            }
        })
    }

    $('#btn-add-qty').click(function () {
        console.log('tes');
        qty++;
        $('#qty').html(qty);
    });

    $('#btn-rm-qty').click(function () {
        if (qty > 1) {
            qty--;
            $('#qty').html(qty);
        }else{

            alert('Minimal 1');
        }
    });

    $('#btn-cart').on('click', function () {
        var menu_id = urlParam('id');
            var qty = $('#qty').text();
            var totalBayar = harga * qty
            var pembayaran = 'tunai'
            // console.log(totalBayar);
            $.ajax({
                url  : '/api/transaksi',
                type : 'POST',
                data : {
                    menu_id : menu_id,
                    qty : qty,
                    total : totalBayar,
                    pembayaran : pembayaran
                },
                success : function (data) {
                    // console.log(data);
                    alertSuccess("Berhasil di checkout")
                    setTimeout(() => {
                        var id = urlParam('id');
                        window.location.href = window.location.origin + '/user/checkout?id=' + data.data.order_id
                    }, 2000);
                }
            })

    })


</script>
@endsection
