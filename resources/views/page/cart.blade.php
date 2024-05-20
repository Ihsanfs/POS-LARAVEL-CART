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
                <h3>Keranjang</h3>
            </div>
            <table id="cart" class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th style="width:50%">Nama</th>
                        <th style="width:10%">Harga</th>
                        <th style="width:8%">Quantity</th>
                        <th style="width:22%" class="text-center">Subtotal</th>
                        <th style="width:10%"></th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0 @endphp
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                            @php $total += $details['harga'] * $details['quantity'] @endphp
                            <tr data-id="{{ $id }}">
                                <td data-th="Product">
                                    <div class="row">
                                       
                                        <div class="col-sm-9">
                                            <h4 class="nomargin">{{ $details['nama'] }}</h4>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Price">{{ number_format($details['harga'],2) }}</td>
                                <td data-th="Quantity">
                                    <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />
                                </td>
                                <input type="hidden" value="{{$id}}">
                                <td data-th="Subtotal" class="text-center">{{ number_format($details['harga'] * $details['quantity'],2) }}</td>
                                <td class="actions" data-th="">
                                    <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-right"><h3><strong>Total {{ number_format($total,2) }}</strong></h3></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right">
                            <a href="{{ route($role.('.produk.data')) }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                            <a href="{{ route($role.('.checkout')) }}" class="btn btn-success">Checkout <i class="fa fa-angle-right"></i> </a>

                            {{-- <button class="btn btn-success">Checkout</button> --}}
                        </td>
                    </tr>
                </tfoot>
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

    <script type="text/javascript">
  
        $(".update-cart").change(function (e) {
            e.preventDefault();
      
            var ele = $(this);
      
            $.ajax({
                url: '{{ route($role.'.update.cart') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id"), 
                    quantity: ele.parents("tr").find(".quantity").val()
                },
                success: function (response) {
                   window.location.reload();
                }
            });
        });
      
        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
      
            var ele = $(this);
      
            if(confirm("Are you sure want to remove?")) {
                $.ajax({
                    url: '{{ route($role.'.remove.from.cart') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}', 
                        id: ele.parents("tr").attr("data-id")
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
      
    </script>
@endpush
