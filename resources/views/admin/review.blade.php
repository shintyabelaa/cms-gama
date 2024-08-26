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
                <h2 class="mb-md-0 mb-3 fw-bold tw-text-xl">
                    ULASAN PELANGGAN GAMA COFFEE HOUSE
                </h2>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Tabel Ulasan Pelanggan</h6>
                        <div class="table-responsive tw-h-[100vh]">
                            <table id="dataTableExample" class="table" style="table-layout: fixed; width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 20%;">Nama Customer</th>
                                        <th style="width: 10%;">Rating</th>
                                        <th style="width: 50%;">Deskripsi</th> <!-- Adjust width -->
                                        <th style="width: 20%;">Dibuat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reviews as $review)
                                        <tr>
                                            <td>{{ $review->customer->customer_nama }}</td>
                                            <td>{{ $review->ulasan_rating }}</td>
                                            <td style="word-wrap: break-word; overflow-wrap: break-word; white-space: normal">
                                                {{ $review->ulasan_deskripsi }}
                                            </td>
                                            <td>{{ $review->created_at }}</td>
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
