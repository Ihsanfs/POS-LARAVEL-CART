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

            <div class="class">
                <h3>Edit/Update</h3>
            </div>

            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route($role.'.simpan') }}" method="POST">
                        @csrf
                        @foreach ($produk as $key => $item)
                            <tr>
                                <td scope="row">{{ $key + 1 }}</td>
                                <td><input type="text" class="form-control" value="{{ $item->nama }}" name="nama[]"></td>
                                <td><input type="text" class="form-control" value="{{ $item->harga }}" name="harga[]"></td>
                                <td><input type="text" class="form-control" value="{{ $item->satuan }}" name="satuan[]"></td>
                                <input type="hidden" value="{{$item->id}}" name="id_produk[]">
                            </tr>
                        @endforeach
                        <div class="row justify-content-end sticky-top">
                            <div class="d-flex col-2 sticky-top bg-white p-2 ml-auto">
                                <button type="submit" class="btn btn-primary col-md-6">Simpan</button>
                            </div>
                        </div>
                        

                    </form>
                </tbody>
            </table>
            
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
