@extends('layouts.app-pages')

@section('content')

<style>
    label {
        color : #000;
        font-weight: 700;
    }
</style>

<div class="p-4">
    <div class="d-flex mb-4 mt-5">
        <div class="p-0 col-2 my-auto">
            <a href="/owner/menu">
                <i class="fas fa-chevron-left text-primary" style="font-size: 20px;"></i>
            </a>
        </div>
        <div class="col-8 text-center " >
            <p class="m-0 text-dark my-auto" style="font-size: 20px;font-weight: 700;">Tambah Kategori</p>
        </div>
        <div class="col-2 p-0 my-auto text-right">

        </div>
    </div>

    <div class="mt-4">
        <div class="form-group">
            <label for="">Nama Kategori</label>
            <input type="text" class="form-control" id="nama-kategori" placeholder="Nama dari hidanganmu" style="border-radius: 15px">
        </div>
    </div>
</div>
@endsection


@section('script')
    <script>
        $('#btn-save-menu').on('click' ,function () {
            var name = $('#nama-kategori').val()
            console.log("TEST");
            $.ajax({
                url: '/api/kategori',
                type : "POST",
                data : {
                    nama: name
                },
                success : function (data) {
                    alertSuccess("Data Kategori Berhasil ditambahkan");
                    setTimeout(() => {
                        window.location.href = window.location.origin + '/owner/menu'
                    }, 2000);
                },
                error : function (data) {
                    // console.log(data);
                    alertError(data.responseJSON.message)
                }
            })
        })
    </script>
@endsection
