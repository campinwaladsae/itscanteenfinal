@extends('layouts.app-pages')

@section('content')
<div class="p-4">
    <div class="d-flex mb-4 mt-5">
        <div class="p-0 col-2 my-auto">
            <a href="/owner/menu">
                <i class="fas fa-chevron-left text-primary" style="font-size: 20px;"></i>
            </a>
        </div>
        <div class="col-8 text-center " >
            <p class="m-0 text-dark my-auto" style="font-size: 20px;font-weight: 700;">Tambah Menu</p>
        </div>
        <div class="col-2 p-0 my-auto text-right">

        </div>
    </div>

    <style>
        .btn-menu::-webkit-scrollbar {
            display: none;
        }
    </style>
    <div class="btn-menu my-3" style="overflow-x: auto;overflow-y: hidden;white-space: nowrap;-ms-overflow-style: none;scrollbar-width: none;" id="list-gambar">

        <button class="btn p-0" id="btn-add-gambar">
            <i class="fas fa-plus text-black-50 fa-2x p-4 h-100" style="font-weight: 600;background:#F3F6FB;border:3px solid rgb(226, 226, 226);border-radius: 15px ">

            </i>
        </button>
        <input type="file" hidden id="add-gambar">


    </div>
    <style>
        label {
            color : #000;
            font-weight: 700;
        }
    </style>

    <div class="form">
        <div class="form-group">
            <label for="">Nama Hidangan</label>
            <input type="text" class="form-control" id="nama" placeholder="Nama dari hidanganmu" style="border-radius: 15px">
        </div>
        <div class="form-group">
            <label for="">Deskripsi</label>
            <textarea name="" cols="30" rows="5" id="deskripsi" class="form-control" placeholder="Jelaskan tentang hidanganmu" style="border-radius: 15px"></textarea>
        </div>
        <div class="form-group">
            <label for="">Harga</label>
            <input type="text" class="form-control" id="harga" placeholder="Harga hidanganmu" style="border-radius: 15px">
        </div>
        <div class="form-group">
            <label for="">Kategori Hidangan</label>
            {{-- <input type="text" class="form-control" placeholder="Pilih Kategori" style="border-radius: 15px"> --}}
            <select name="" id="kategori" class="form-control" style="border-radius: 15px"></select>
        </div>
    </div>
</div>


  <!-- Modal -->
  <div class="modal fade" id="modal-detail-gambar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <div class="modal-body">
            <img src="" id="detail-gambar" class="img-fluid" alt="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')
    <script>
        // var listImages = [];
        var data = new FormData();
        $(document).ready(function () {
            $.ajax({
                url : "/api/kategori",
                type : "GET",
                success : function (data) {
                    // console.log(data);
                    var res = data.data;
                    $('#kategori').prepend($('<option>'), {value: "", text:"-- pilih salah satu --"})
                    res.forEach(el => {
                        console.log(el);
                        $('#kategori').append($('<option>', {value: el.id, text: el.nama}))
                    });
                }
            })
            // $('#kategori')
        })

        var images = [];
        let base64String = "";

        function imageUploaded() {
            let file = document.querySelector(
                'input[type=file]')['files'][0];

            let reader = new FileReader();
            console.log("next");

            reader.onload = function () {
                base64String = reader.result.replace("data:", "")
                    .replace(/^.+,/, "");

                imageBase64Stringsep = base64String;

                // alert(imageBase64Stringsep);
                console.log(base64String);
            }
            reader.readAsDataURL(file);
        }

        $('#btn-add-gambar').on('click',function () {
            $('#add-gambar').click();
        })

        $('#add-gambar').on('change', function () {
            let file = $(this)[0].files[0];
            let reader = new FileReader();
            console.log("next");

            reader.onload = function () {
                base64String = reader.result.replace("data:", "")
                    .replace(/^.+,/, "");

                imageBase64Stringsep = base64String;

                // alert(imageBase64Stringsep);
                $('#list-gambar').prepend(`
                    <button class="btn btn-gambar" data-url="${reader.result}">
                        <img src="${reader.result}" class="img-fluid text-left mr-1" style="height: 85px;width: 85px;border-radius: 10px" alt="">
                    </button>
                `)
            }

            reader.readAsDataURL(file);
            // console.log(file);
            data.append('gambars[]', file)
            images.push(file);
        })

        $('body').on('click', '.btn-gambar', function () {
            var url = $(this).data('url');
            $('#modal-detail-gambar').modal('show');
            $('#detail-gambar').attr('src', url);
        });

        $('#btn-save-menu').on('click', function () {
            var url = $(this).data('url');

            var foto = $('body .btn-gambar').data('url')
            console.log(data);
            // var fd = new FormData();
            // fd.append('gambar[]', );
            data.append('nama', $('#nama').val())
            data.append('deskripsi', $('#deskripsi').val())
            data.append('harga', $('#harga').val())
            data.append('kategori_id', $('#kategori').val())
            $.ajax({
                url : '/api/menu',
                type : 'POST',
                processData: false,
                contentType: false,
                data : data,
                success : function (data) {
                    console.log(data);
                    alertSuccess("Makanan Berhasil Disimpan")
                    setTimeout(() => {
                        window.location.href = window.location.origin + '/owner/menu'
                    }, 2000);
                }
            })
        })
    </script>
@endsection
