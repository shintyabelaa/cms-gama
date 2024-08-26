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
                    DAFTAR PESANAN GAMA COFFEE HOUSE
                </h2>
            </div>
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                <a
                    href="{{ route("orders.create") }}"
                    class="d-flex btn btn-primary btn-icon-text mb-md-0 mb-2"
                >
                    <i class="btn-icon-prepend" data-feather="plus"></i>
                    Add Pesanan
                </a>
            </div>
        </div>
        <div class="btn-group" role="group" aria-label="Filter Orders">
            <a
                href="{{ route("orders.index", ["filter" => "today"]) }}"
                class="btn {{ request("filter") == "today" ? "btn-primary" : "hover:tw-border-none" }}"
            >
                Hari Ini
            </a>
            <a
                href="{{ route("orders.index", ["filter" => "this_week"]) }}"
                class="btn {{ request("filter") == "this_week" ? "btn-primary" : "hover:tw-border-none" }}"
            >
                Minggu Ini
            </a>
            <a
                href="{{ route("orders.index", ["filter" => "this_month"]) }}"
                class="btn {{ request("filter") == "this_month" ? "btn-primary" : "hover:tw-border-none" }}"
            >
                Bulan Ini
            </a>
        </div>

        <div class="row mt-3">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Tabel Pesanan</h6>
                        <div class="table-responsive tw-h-[100vh]">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Tanggal</th>
                                        <th>Nama Customer</th>
                                        <th>No. Tabel</th>
                                        <th>Items</th>
                                        <th>subtotal</th>
                                        <th class="!tw-font-bold">Total</th>
                                        <th>Status</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->order_id }}</td>
                                            <td>
                                                {{ $order->created_at->format("d M Y") }}
                                            </td>
                                            <td class="tw-capitalize">
                                                {{ $order->customer->customer_nama }}
                                            </td>
                                            <td class="tw-capitalize">
                                                {{ $order->table_no }}
                                            </td>
                                            <td>
                                                <ul>
                                                    @foreach ($order->cartItems as $cartItem)
                                                        @if ($cartItem->quantity < 1)
                                                            <div></div>
                                                        @else
                                                            <li>
                                                                {{ $cartItem->quantity }}
                                                                {{ $cartItem->product->product_nama }}
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                Rp{{ number_format($order->subtotal, 0, ",", ".") }}
                                            </td>
                                            <!-- Add this line -->
                                            <td class="tw-font-bold">
                                                Rp{{ number_format($order->total, 0, ",", ".") }}
                                            </td>
                                            <td
                                                class="{{ "status-" . strtolower($order->status) }}"
                                            >
                                                {{ ucfirst($order->status) }}
                                            </td>
                                            <td>
                                                <form
                                                    action="{{ route("orders.changeStatus", $order->order_id) }}"
                                                    method="POST"
                                                    id="statusForm{{ $order->order_id }}"
                                                >
                                                    @csrf
                                                    @method("PUT")
                                                    <input
                                                        type="hidden"
                                                        name="status"
                                                        id="statusInput{{ $order->order_id }}"
                                                    />
                                                </form>

                                                <div class="dropdown">
                                                    <button
                                                        class="btn tw-inline-flex tw-items-center tw-justify-between tw-bg-primary tw-text-white hover:tw-bg-primary hover:tw-text-white hover:tw-shadow-md focus:tw-border-none focus:tw-bg-primary focus:tw-text-white"
                                                        type="button"
                                                        id="dropdownMenuButton{{ $order->order_id }}"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >
                                                        {{ ucfirst($order->status) }}
                                                        <i
                                                            data-feather="chevron-down"
                                                            class="tw-text-sm tw-text-white"
                                                        ></i>
                                                    </button>
                                                    <ul
                                                        class="dropdown-menu"
                                                        aria-labelledby="dropdownMenuButton{{ $order->order_id }}"
                                                    >
                                                        <li>
                                                            <a
                                                                class="dropdown-item"
                                                                href="#"
                                                                onclick="changeStatus('{{ $order->order_id }}', 'process')"
                                                            >
                                                                Process
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a
                                                                class="dropdown-item"
                                                                href="#"
                                                                onclick="changeStatus('{{ $order->order_id }}', 'unpaid')"
                                                            >
                                                                Unpaid
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a
                                                                class="dropdown-item"
                                                                href="#"
                                                                onclick="changeStatus('{{ $order->order_id }}', 'paid')"
                                                            >
                                                                Paid
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex tw-gap-4">
                                                    {{-- <a href="{{ route('products.edit', $product->product_id) }}" class="btn btn-lg btn-info">Edit</a> --}}
                                                    <form
                                                        action="{{ route("orders.destroy", $order->order_id) }}"
                                                        method="POST"
                                                    >
                                                        @csrf
                                                        @method("DELETE")
                                                        <button
                                                            type="submit"
                                                            class="btn btn-danger btn-lg"
                                                        >
                                                            Delete
                                                        </button>
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

@section("scripts")
    <script>
        function changeStatus(orderId, status) {
            document.getElementById('statusInput' + orderId).value = status;
            document.getElementById('statusForm' + orderId).submit();
        }
    </script>
@endsection
