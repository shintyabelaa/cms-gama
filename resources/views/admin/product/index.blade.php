@extends("admin.template")
@section("content")
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Data Table
                </li>
            </ol>
        </nav>
        <div
            class="d-flex justify-content-between align-items-center grid-margin flex-wrap"
        >
            <div>
                <h2 class="mb-md-0 mb-3 fw-bold tw-text-xl">DAFTAR MENU GAMA COFFEE HOUSE</h2>
            </div>
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                <a
                    href="{{ route('products.create') }}"
                    class="d-flex btn btn-primary btn-icon-text mb-md-0 mb-2"
                >
                    <i class="btn-icon-prepend" data-feather="plus"></i>
                    Add New Menu
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Tabel Menu</h6>
                        <div class="table-responsive tw-h-[100vh]">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Menu ID</th>
                                        <th>Nama Menu</th>
                                        <th>Kategori</th> <!-- Add this line -->
                                        <th>Deskripsi</th>
                                        <th>Gambar</th>
                                        <th>Harga</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->product_id }}</td>
                                            <td>{{ $product->product_nama }}</td>
                                            <td>{{ $product->product_kategori }}</td> <!-- Add this line -->
                                            <td>{{ $product->product_deskripsi }}</td>
                                            <td>
                                                <img src="{{ Storage::url($product->product_gambar) }}" alt="{{ $product->product_nama }}" width="80">
                                            </td>
                                            <td>{{ $product->product_harga }}</td>
                                            <td>
                                                <div class="d-flex tw-gap-4">
                                                    <a href="{{ route('products.edit', $product->product_id) }}" class="btn btn-lg btn-info">Edit</a>
                                                    <form action="{{ route('products.destroy', $product->product_id) }}" method="POST">
                                                        @csrf
                                                        @method("DELETE")
                                                        <button type="submit" class="btn btn-danger btn-lg">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
