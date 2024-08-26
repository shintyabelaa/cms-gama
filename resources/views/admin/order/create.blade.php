@extends("admin.template")

@section("styles")
    <link
        rel="stylesheet"
        href="{{ asset("assets/vendors/flatpickr/flatpickr.min.css") }}"
    />
@endsection

@section("content")
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Orders</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Create Order
                </li>
            </ol>
        </nav>
        <div
            class="d-flex justify-content-between align-items-center grid-margin flex-wrap"
        >
            <div>
                <h4 class="mb-md-0 mb-3">Create New Order</h4>
            </div>
        </div>
        <div class="row w-100 mx-0 auth-page">
            <div class="mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="ps-md-0">
                            <div class="auth-form-wrapper px-4 pt-2 pb-5">
                                <form
                                    action="{{ route("orders.store") }}"
                                    method="POST"
                                >
                                    @csrf

                                    <div id="new_customer_div">
                                        <div class="mb-3">
                                            <label
                                                for="customer_nama"
                                                class="form-label"
                                            >
                                                Customer Name
                                            </label>
                                            <input
                                                type="text"
                                                name="customer_nama"
                                                class="form-control"
                                                placeholder="Customer Name"
                                                required
                                            />
                                        </div>
                                        <div class="mb-3">
                                            <label
                                                for="customer_phone"
                                                class="form-label"
                                            >
                                                Customer Phone
                                            </label>
                                            <input
                                                type="text"
                                                name="customer_phone"
                                                class="form-control"
                                                placeholder="Customer Phone"
                                                required
                                            />
                                        </div>
                                        <!-- Add other customer fields as needed -->
                                    </div>

                                    <!-- Select Products -->
                                    <div class="mb-3">
                                        <label
                                            for="products"
                                            class="form-label"
                                        >
                                            Select Products
                                        </label>
                                        <div class="tw-grid tw-grid-cols-4 tw-gap-4">
                                        @foreach ($products->groupBy("product_kategori") as $category => $groupedProducts)
                                            <div class="category-group tw-flex tw-flex-col tw-gap-1">
                                                <h5 class="tw-text-primary tw-font-semibold">{{ $category }}</h5>
                                                <!-- Category name -->
                                                @foreach ($groupedProducts as $product)
                                                    <div class="form-check">
                                                        <input
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            name="products[]"
                                                            value="{{ $product->product_id }}"
                                                            id="product{{ $product->product_id }}"
                                                        />
                                                        <label
                                                            class="form-check-label"
                                                            for="product{{ $product->product_id }}"
                                                        >
                                                            {{ $product->product_nama }}
                                                            -
                                                            Rp{{ number_format($product->product_harga, 0, ",", ".") }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>

                                        @error("products")
                                            <span
                                                class="tw-text-xs tw-text-red-500"
                                            >
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Order Status -->
                                    <div class="mb-3">
                                        <label for="status" class="form-label">
                                            Order Status
                                        </label>
                                        <input
                                            type="text"
                                            name="status"
                                            class="form-control"
                                            value="process"
                                            readonly
                                        />
                                    </div>

                                    <!-- Submit Button -->
                                    <button
                                        class="btn btn-primary"
                                        type="submit"
                                    >
                                        Create Order
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script src="{{ asset("assets/vendors/flatpickr/flatpickr.min.js") }}"></script>
    <script src="{{ asset("assets/js/flatpickr.js") }}"></script>
@endsection
