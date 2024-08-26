@extends('admin.template')
@section('content')
<div class="page-content">
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex" role="alert">
            <i data-feather="alert-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center grid-margin flex-wrap">
        <div>
            <h4 class="mb-md-0 mb-3">Welcome to  {{ ucfirst(Auth::user()->role) }} Dashboard</h4>
        </div>
        <div class="input-group flatpickr wd-200 mb-md-0 mb-2 me-2" id="dashboardDate">
            <span class="input-group-text input-group-addon" data-toggle>
                <i data-feather="calendar" class="text-primary"></i>
            </span>
            <input type="text" class="form-control bg-transparent" placeholder="Select date" data-input id="currentDate" readonly/>
        </div>
    </div>

    <!-- Row for the cards -->
    <div class="row">
        
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between font-card" style="background-color: #6C757D; border-radius: 14px">
                    <div class="d-flex row align-items-baseline">
                        <h6 class="card-title mb-0">Total Menu Items</h6>
                        <h1 style="font-size: 2.5rem; font-weight: 500">{{ number_format($totalMenuItems) }}</h1>
                    </div>
                    <i class="icon-xxl" data-feather="list"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between font-card"  style="background-color: #FFC107; border-radius: 14px">
                    <div class="d-flex row align-items-baseline">
                        <h6 class="card-title mb-0">Orders in Process</h6>
                        <h1 style="font-size: 2.5rem; font-weight: 500">{{ number_format($ordersInProcess) }}</h1>
                    </div>
                    <i class="icon-xxl" data-feather="refresh-cw"></i>
                </div>
            </div>
        </div>
        
        
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between font-card font-card" style="background-color: #9A583F; border-radius: 14px">
                    <div class="d-flex row align-items-baseline">
                        <h6 class="card-title mb-0">Total Orders</h6>
                        <h1 style="font-size: 2.5rem; font-weight: 500">{{ number_format($totalOrders) }}</h1>
                    </div>
                    <i class="icon-xxl" data-feather="shopping-cart"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Row for the cards -->

    <div class="row mt-3">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Tabel Pesanan dalam Proses</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Tanggal</th>
                                    <th>Nama Customer</th>
                                    <th>No. Tabel</th>
                                    <th>Items</th>
                                    <th>Subtotal</th>
                                    <th class="!tw-font-bold">Total</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->order_id }}</td>
                                        <td>{{ $order->created_at->format('d M Y') }}</td>
                                        <td class="tw-capitalize">{{ $order->customer->customer_nama }}</td>
                                        <td class="tw-capitalize">{{ $order->table_no }}</td>
                                        <td>
                                            <ul>
                                                @foreach ($order->cartItems as $cartItem)
                                                    @if ($cartItem->quantity > 0)
                                                        <li>{{ $cartItem->quantity }} {{ $cartItem->product->product_nama }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>Rp{{ number_format($order->subtotal, 0, ',', '.') }}</td>
                                        <td class="tw-font-bold">Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                                        <td class="{{ 'status-' . strtolower($order->status) }}">{{ ucfirst($order->status) }}</td>
                                        <td>
                                            <form action="{{ route('orders.changeStatus', $order->order_id) }}" method="POST" id="statusForm{{ $order->order_id }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" id="statusInput{{ $order->order_id }}" />
                                            </form>

                                            <div class="dropdown">
                                                <button class="btn tw-inline-flex tw-items-center tw-justify-between tw-bg-primary tw-text-white hover:tw-bg-primary hover:tw-text-white hover:tw-shadow-md focus:tw-border-none focus:tw-bg-primary focus:tw-text-white" type="button" id="dropdownMenuButton{{ $order->order_id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ ucfirst($order->status) }}
                                                    <i data-feather="chevron-down" class="tw-text-sm tw-text-white"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $order->order_id }}">
                                                    <li><a class="dropdown-item" href="#" onclick="changeStatus('{{ $order->order_id }}', 'unpaid')">Unpaid</a></li>
                                                    <li><a class="dropdown-item" href="#" onclick="changeStatus('{{ $order->order_id }}', 'paid')">Paid</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex tw-gap-4">
                                                <form action="{{ route('orders.destroy', $order->order_id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
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

@section('scripts')
<script>
    setTimeout(function() {
        $('.alert').alert('close');
    }, 2000); // 2 seconds
</script>
<script>
    // Function to format the date as "23 August 2023"
    function formatDate(date) {
        const options = { day: 'numeric', month: 'long', year: 'numeric' };
        return date.toLocaleDateString('en-GB', options);
    }

    // Get today's date and format it
    const today = new Date();
    const formattedDate = formatDate(today);

    // Set the value of the input field to the formatted date
    document.getElementById('currentDate').value = formattedDate;

    feather.replace(); // Initialize feather icons
</script>

@section("scripts")
    <script>
        function changeStatus(orderId, status) {
            document.getElementById('statusInput' + orderId).value = status;
            document.getElementById('statusForm' + orderId).submit();
        }
    </script>
@endsection
@endsection
