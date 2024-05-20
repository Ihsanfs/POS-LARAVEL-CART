@extends('layout.app')

@section('title', 'Produk')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <form action="{{route($role.'.pesan')}}" method="POST">
                @csrf
            @foreach ($produk as $key => $item)
            <div class="row produk-item">
                <div class="col-md-2">
                    <label for="">Nama Produk</label>
                    <div class="card">
                        <input type="text" class="form-control" name="nama" value="{{ $item->nama }}" readonly>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="harga{{ $key }}">Harga</label>
                    <input type="text" name="harga[]" id="harga{{ $key }}" class="form-control harga-produk" value="{{ number_format($item->harga, 2) }}" readonly>
                </div>
                <div class="col-md-2">
                    <label for="quantity{{ $key }}">Quantity</label>
                    <input type="number" name="quantity[]" id="quantity{{ $key }}" class="form-control quantity-produk" data-key="{{ $key }}">
                </div>
                <div class="col-md-2">
                    <label for="total{{ $key }}">Total</label>
                    <input type="text" name="total[]" id="total{{ $key }}" class="form-control total-produk" readonly>
                </div>
                <input type="hidden" value="{{$item->id}}" name="id_produk[]">

            </div>
        @endforeach
        <div class="row justify-content-end sticky-top">
            <div class="d-flex col-2 sticky-top bg-white p-2 ml-auto">
                <button type="submit" class="btn btn-primary col-md-6">Simpan</button>
            </div>
        </div>

    </form>
          
                
          
        </section>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('.quantity-produk').on('keyup', function () {
            let key = $(this).data('key');
            let harga = parseFloat($('#harga' + key).val().replace(',', '')) || 0; // Mengganti koma jika harga diambil dari format mata uang
            let quantity = parseFloat($(this).val()) || 0;

            let total = harga * quantity;
           
            if (quantity === 0) {
            $('#total' + key).val('');
        } else {
            $('#total' + key).val(total.toLocaleString());
        }
        });
    });
</script>



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
