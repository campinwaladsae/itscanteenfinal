

<div class="checkout fixed-bottom bg-white" style="box-shadow: 0 -1px 8px 0 rgba(0, 0, 0, 0.2);margin:auto;">

    <div class=" py-3 px-4" id="section-co" hidden>
        <div id="checkout" class="d-flex justify-content-between pb-3">
            <div class="col p-0 my-auto">
                <p style="font-size: 13px; font-weight: 900" class="text-dark m-0 my-auto" id="harga-bayar">Rp 17.000</p>
            </div>
            <div class="col p-0 text-right">
                    <button class="btn btn-sm text-success"><i class="fas fa-money-bill text-success"></i> <span class="m-0" style="font-weight: 700">Tunai</span>  <i class="fas fa-chevron-right text-secondary my-auto" style="font-size: 13px"></i></button>
            </div>
        </div>
        <div >
            <button id="rincian"  class="btn btn-sm btn-primary w-100 py-2 d-flex justify-content-center" style="border-radius: 25px;">
                <i class="fas fa-motorcycle my-auto"></i>&nbsp;
                <p class="m-0" style="font-weight: 700">Pesan</p>
            </button>
        </div>
    </div>
    @if (Request::segment(2) == 'tambah-menu' || Request::segment(2) == 'tambah-kategori' || Request::segment(2) == 'edit-menu' )
    <div class="px-4 pb-5 pt-3" >
        <button class="btn btn-primary w-100" id="btn-save-menu" data-url="" style="border-radius: 20px">
            Lanjut
        </button>
    </div>
    @else

    <div class=" d-flex justify-content-around  text-center" >
        @if (Request::segment(1) == 'owner'  )

        <div class="col ">
            <div class="p-2 bd-highlight">
                <a href="/owner/dashboard"  >
                    <span class="material-symbols-rounded my-2 text-primary btn-item" id="btn-home-owner">
                        home
                        </span>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="p-2 bd-highlight">
                <a href="/owner/pemasukan">
                    <span class="material-symbols-rounded my-2 text-secondary btn-item"  id="btn-pemasukan">
                        payments
                        </span>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="p-2 bd-highlight">
                <a href="/owner/inbox" >
                    <span class="material-symbols-rounded my-2 btn-item text-secondary" id="btn-inbox">
                        inbox
                        </span>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="p-2 bd-highlight">
                <a href="/owner/profile">
                    <span class="material-symbols-rounded my-2 text-secondary btn-item" id="btn-profile-owner">
                        person
                        </span>
                </a>
            </div>
        </div>

        @elseif(Request::segment(1) == 'user'  )


        <div class="col ">
            <div class="p-2 bd-highlight">
                <a href="/user/dashboard"  >
                    <span class="material-symbols-rounded my-2 text-primary btn-item" id="btn-home">
                        home
                        </span>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="p-2 bd-highlight">
                <a href="/user/favorite">
                    <span class="material-symbols-rounded my-2 text-secondary btn-item"  id="btn-favorite">
                        favorite
                        </span>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="p-2 bd-highlight">
                <a href="/user/cart">
                    <span class="material-symbols-rounded my-2  text-secondary btn-item" id="btn-cart-user">
                        shopping_cart
                        </span>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="p-2 bd-highlight">
                <a href="/user/profile">
                    <span class="material-symbols-rounded my-2 text-secondary btn-item" id="btn-profile-user">
                        person
                        </span>
                </a>
            </div>
        </div>
        @endif



    </div>
    @endif

</div>

