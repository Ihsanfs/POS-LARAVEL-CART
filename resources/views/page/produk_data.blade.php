@extends('layout.app')

@section('title', 'Produk')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">

        <style>
            .main-section{
    background-color: #F8F8F8;
}
#dropdown-cart{
    float:right;
    padding-right: 30px;
}

.dropdown .dropdown-menu{
    padding:20px;
    top:30px !important;
    width:350px !important;
    left:-110px !important;
    box-shadow:0px 5px 30px black;
}
.total-header-section{
    border-bottom:1px solid #d2d2d2;
}
.total-section p{
    margin-bottom:20px;
}
.cart-detail{
    padding:15px 0px;
}
.cart-detail-img img{
    width:100%;
    height:100%;
    padding-left:15px;
}
.cart-detail-product p{
    margin:0px;
    color:#000;
    font-weight:500;
}
.cart-detail .price{
    font-size:12px;
    margin-right:10px;
    font-weight:500;
}
.cart-detail .count{
    color:#C2C2DC;
}
.checkout{
    border-top:1px solid #d2d2d2;
    padding-top: 15px;
}
.checkout .btn-primary{
    border-radius:50px;
    height:50px;
}
/* .dropdown-menu:before{
    content: " ";
    position:absolute;
    top:-20px;
    right:50px;
    border:10px solid transparent;
    border-bottom-color:#fff;
} */
        </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>

            {{-- session produk --}}
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-12 main-section">
                        <div class="dropdown" id="dropdown-cart">
                            <button type="button" class="btn btn-info" data-toggle="dropdown">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                            </button>
                            <div class="dropdown-menu">
                                <div class="row total-header-section">
                                    <div class="col-lg-6 col-sm-6 col-6">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                                    </div>
                                    @php $total = 0 @endphp
                                    @foreach((array) session('cart') as $id => $details)
                                        @php $total += $details['harga'] * $details['quantity'] @endphp
                                    @endforeach
                                    <div class="col-lg-8 col-sm-8 col-8 total-section text-right">
                                        <p>Total: <span class="text-info">{{ number_format($total,2) }}</span></p>
                                    </div>
                                </div>
                                @if(session('cart'))
                                    @foreach(session('cart') as $id => $details)
                                        <div class="row cart-detail">
                                            
                                            <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                                <p>{{ $details['nama'] }}</p>
                                                <span class="harga text-info"> {{ number_format($total,2) }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                        <a href="{{ route($role.'.cart') }}" class="btn btn-primary btn-block">View all</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
              
            <div class="class">
                <h3>item produk</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($produk as $item)
                    <div class="col-md-3">
                        
                            <div class="card-title">
                                <a href="{{ route($role.'.add.to.cart', $item->id) }}" class="form-control">{{$item->nama}}</a>
                            </div>
                       
                    </div>
                    @endforeach
                  
                </div>
            </div>
          
            
            
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
