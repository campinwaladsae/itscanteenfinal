@extends('layouts.app-pages')

@section('content')
<div class="p-4" style="margin-bottom: 200px;">
    <div class="mt-5 my-4">
        <h3 style="font-size: 30px;font-weight: 900;" class="text-dark">Favorit</h3>
    </div>


    <div id="list-favorite">

    </div>

    {{-- <div  style="background: #F3F6FB;border-radius: 20px">
        <div class="item d-flex w-100 px-2 pt-3">
            <div class="col-md-11">
                <p style="font-size: 13px;font-weight: 700;color:black" class="m-0">Rumah Seblak</p>
                <p style="font-size: 13px;font-weight: 500;color:grey">Kantin Geomatika</p>

                <div class="d-flex">
                    <div class="col-3 p-0">
                        <img src="{{asset('menu/menu2.png')}}" class="img-fluid text-left" style="max-width: 50px;border-radius: 10px" alt="">
                    </div>
                    <div class="col-9 pl-0">
                        <div >
                            <p class="m-0" style="font-size: 13px;font-weight: 600;color:black">Seblak Premium</p>
                            <p style="font-size: 13px;font-weight: 600;color:grey">Rp 18.000</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col flex-column">
                <div class="d-flex mb-auto text-dark">
                    <i class="fas fa-star" style="color: gold"></i> &nbsp; <p class="m-0" style="font-weight: 900;font-size: 13px">4.8</p>
                </div>
            </div>
        </div>
        <div class="text-right px-4 pb-3">
            <i class="fas fa-plus p-2" style="color: #9EA0AE;font-size: 8px; background: #fff;border-radius: 25px;"></i>
        </div>
    </div> --}}

</div>
@endsection


@section('script')
    <script>
        $(document).ready(function () {
            checkURL();

            $.ajax({
                url : '/api/menu/favorite',
                type : "GET",
                success : function (data) {
                    console.log(data);
                    var res = data.data;
                    res.forEach(el => {
                        var img = JSON.parse(el.gambar);
                        $('#list-favorite').append(`
                        <div class="mb-3"  style="background: #F3F6FB;border-radius: 20px">
            <div class="item d-flex w-100 px-2 pt-3">
                <div class="col-md-11">
                    <p style="font-size: 13px;font-weight: 700;color:black" class="m-0">${el.user.name}</p>
                    <p style="font-size: 13px;font-weight: 500;color:grey">Kantin Pusat ITS</p>

                    <div class="d-flex">
                        <div class="col-3 p-0">
                            <img src="{{asset('storage/menu/${img[0]}')}}" class="img-fluid text-left" style="object-fit:cover;height:50px;width: 50px;border-radius: 10px" alt="">
                        </div>
                        <div class="col-9 pl-0">
                            <div >
                                <p class="m-0" style="font-size: 13px;font-weight: 600;color:black">${el.nama}</p>
                                <p style="font-size: 13px;font-weight: 600;color:grey">${rupiah(el.harga)}</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col flex-column">
                    <div class="d-flex mb-auto text-dark">
                        <i class="fas fa-star" style="color: gold"></i> &nbsp; <p class="m-0" style="font-weight: 900;font-size: 13px">4.8</p>
                    </div>
                </div>
            </div>
            <div class="text-right px-4 pb-3">
                <i class="fas fa-plus p-2" style="color: #9EA0AE;font-size: 8px; background: #fff;border-radius: 25px;"></i>
            </div>
        </div>`);
                    });
                }
            })
        })
    </script>
@endsection
