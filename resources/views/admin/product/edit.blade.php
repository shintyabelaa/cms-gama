@extends('admin.template')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/easymde/easymde.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/dropify/dist/dropify.min.css') }}">
@endsection
@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Data Table
                </li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between align-items-center grid-margin flex-wrap">
            <div>
                <h4 class="mb-md-0 mb-3">EDIT MENU</h4>
            </div>
        </div>
        <div class="row w-100 mx-0 auth-page">
            <div class="mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="ps-md-0">
                            <div class="auth-form-wrapper px-4 pt-2 pb-5">
                                <form action="{{ route('products.update', $product->product_id) }}" method="POST" enctype="multipart/form-data">
                                    @method('PATCH')
                                    @csrf
                                    <input type="hidden" name="author" value="{{ auth()->user()->name }}">
                                    <div class="mb-3">
                                        <label class="form-label">Kategori Menu</label>
                                        <select name="product_kategori"
                                            class="select2 form-select @error('product_kategori') is-invalid @enderror"
                                            data-width="100%">
                                            <option selected disabled>Pilih Kategori Menu</option>
                                            <option @selected(old('product_kategori') == 'Coffee') value="Coffee">Coffee</option>
                                            <option @selected(old('product_kategori') == 'Signature') value="Signature">Signature</option>
                                            <option @selected(old('product_kategori') == 'Non-Coffee') value="Non-Coffee">Non-Coffee</option>
                                            <option @selected(old('product_kategori') == 'Mocktails') value="Mocktails">Mocktails</option>
                                            <option @selected(old('product_kategori') == 'Artisan Tea') value="Artisan Tea">Artisan Tea</option>
                                            <option @selected(old('product_kategori') == 'Snacks') value="Snacks">Snacks</option>
                                            <option @selected(old('product_kategori') == 'All-Day Breakfast') value="All-Day Breakfast">All-Day Breakfast</option>
                                            <option @selected(old('product_kategori') == 'Mains') value="Mains">Mains</option>
                                            <option @selected(old('product_kategori') == 'Dessert') value="Dessert">Dessert</option>
                                        </select>
                                        @error('product_kategori')
                                            <span class="tw-text-red-500 tw-text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="product_nama" class="form-label">Package Name</label>
                                        <input type="text" name="product_nama" class="form-control @error('product_nama') is-invalid @enderror" id="product_nama" value="{{ $product->product_nama }}" placeholder="Nama Menu">
                                        @error('product_nama')
                                            <span class="tw-text-red-500 tw-text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="product_harga" class="form-label">Harga</label>
                                        <input id="product_harga" name="product_harga" value="{{ $product->product_harga }}"
                                            data-inputmask="'alias': 'currency', 'prefix':'Rp '" placeholder="Rp 0.00"
                                            class="!tw-text-start form-control mb-4 mb-md-0 @error('product_harga') is-invalid @enderror" />
                                        @error('product_harga')
                                            <span class="tw-text-red-500 tw-text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="product_deskripsi" class="form-label">Deskripsi</label>
                                        <textarea class="form-control" class="@error('product_deskripsi') is-invalid @enderror" name="product_deskripsi" id="product_deskripsi" rows="10">{{ $product->product_deskripsi }}</textarea>
                                        @error('product_deskripsi')
                                            <span class="tw-text-red-500 tw-text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="product_gambar" class="form-label">Gambar Menu</label>
                                        <input name="product_gambar" data-default-file="{{ Storage::url($product->product_gambar) }}" class="dropify @error('product_gambar') is-invalid @enderror" type="file" accept="image/*" id="product_gambar" />
                                        @error('product_gambar')
                                            <span class="tw-text-red-500 tw-text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="product_gambar" value="{{$product->product_gambar}}">
                                    
                                    <div class="mb-3">
                                        <label for="status_publish" class="form-label">Publish Status</label>
                                        <div class="form-check">
                                            <input class="form-check-input @error('status_publish') is-invalid @enderror" type="radio" name="status_publish" id="publish_yes" value="Y" {{ old('status_publish') == 'Y' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="publish_yes">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input @error('status_publish') is-invalid @enderror" type="radio" name="status_publish" id="publish_no" value="N" {{ old('status_publish') == 'N' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="publish_no">
                                                No
                                            </label>
                                        </div>
                                        @error('status_publish')
                                            <span class="tw-text-red-500 tw-text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <button class="btn btn-primary" type="submit">Edit Menu</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/admin/vendors/easymde/easymde.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/easymde.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/dropify/dist/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/dropify.js') }}"></script>
@endsection
