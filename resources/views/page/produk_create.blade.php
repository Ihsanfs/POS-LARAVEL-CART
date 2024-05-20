@extends('layout.app')

@section('title', 'Produk')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>

            <div class="class">
                <h3>Create produk</h3>
            </div>


            <form action="{{ route($role . '.simpan.produk') }}" method="POST" id="produkForm">
                @csrf
            
                <div id="produkFields">
                    <div class="produk-field">
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" class="form-control" name="nama[]" placeholder="Nama Produk">
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" class="form-control" name="harga[]" placeholder="Harga">
                        </div>
                        <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" class="form-control" name="satuan[]" placeholder="Satuan">
                        </div>
                       
                    </div>
                </div>
            
                <div class="row justify-content-end sticky-top">
                    <div class="col-12 col-md-6">
                        <button type="button" class="btn btn-success btn-block" id="addBtn">Add Product</button>
                    </div>
                    <div class="col-12 col-md-6">
                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    </div>
                </div>
            </form>
            

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addBtn = document.getElementById('addBtn');
            const produkFields = document.getElementById('produkFields');
    
            addBtn.addEventListener('click', function() {
                const newField = document.createElement('div');
                newField.classList.add('produk-field');
                newField.innerHTML = `
                <hr>
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" class="form-control" name="nama[]" placeholder="Nama Produk">
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" class="form-control" name="harga[]" placeholder="Harga">
                    </div>
                    <div class="form-group">
                        <label>Satuan</label>
                        <input type="text" class="form-control" name="satuan[]" placeholder="Satuan">
                    </div>
                    <button type="button" class="btn btn-danger remove-btn mb-2">Remove</button>
                `;
                produkFields.appendChild(newField);
                updateRemoveButtons();
            });
    
            produkFields.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-btn')) {
                    e.target.parentElement.remove();
                    updateRemoveButtons();
                }
            });
    
            function updateRemoveButtons() {
                const fields = produkFields.querySelectorAll('.produk-field');
                fields.forEach((field, index) => {
                    const removeBtn = field.querySelector('.remove-btn');
                    if (index > 0) {
                        removeBtn.style.display = 'inline-block'; // Show remove button if it's not the first field
                    } else {
                        removeBtn.style.display = 'none'; // Hide remove button for the first field
                    }
                });
            }
        });
    </script>
    
    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
