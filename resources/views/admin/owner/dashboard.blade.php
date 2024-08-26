@extends('admin.template')
@section('content')
    <div class="page-content">

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex " role="alert">
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
                    <div class="card-body d-flex align-items-center justify-content-between font-card" style="background-color: #FD7E14; border-radius: 14px">
                        <div class="d-flex row align-items-baseline">
                            <h6 class="card-title mb-0 ">Total Admin</h6> 
                            <p class="text-light">Total number of admin users.</p>
                            <h1 style="font-size: 2.5rem; font-weight: 500">{{ number_format($totalAdmin) }}</h1>
                        </div>
                        <i class="icon-xxl " data-feather="users"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between font-card" style="background-color: #007BFF; border-radius: 14px">
                        <div class="d-flex row align-items-baseline">
                            <h6 class="card-title mb-0 ">Total Customers</h6> 
                            <h1 style="font-size: 2.5rem; font-weight: 500;">{{ number_format($totalCustomers) }}</h1>
                        </div>
                        <i class="icon-xxl " data-feather="users"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between font-card" style="background-color: #28A745; border-radius: 14px">
                        <div class="d-flex row align-items-baseline">
                            <h6 class="card-title mb-0 ">Income Today</h6> 
                            <p class="text-light">Total income for today.</p>
                            <h1 style="font-size: 1.5rem; font-weight: 500">Rp{{ number_format($incomeToday, 0, ',', '.') }}</h1>
                        </div>
                        <i class="icon-xxl " data-feather="dollar-sign"></i>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- End of Row for the cards -->

        <!-- Additional rows/content can go here -->

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
</script>

@endsection
