@extends("admin.template")
@section("content")
    <div class="page-content">
        <div
            class="d-flex justify-content-between align-items-center grid-margin flex-wrap"
        >
            <div>
                <h4 class="mb-md-0 mb-3">Welcome to Dashboard</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-xl-12 grid-margin stretch-card">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                            <h6 class="card-title mb-0">PENDAPATAN</h6>
                        </div>
                        <div class="row align-items-start">
                    
                            {{-- <div class="col-md-5 d-flex justify-content-md-end">
                                <div class="btn-group mb-3 mb-md-0" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-primary">Today</button>
                                    <button type="button" class="btn btn-outline-primary d-none d-md-block">Week</button>
                                    <button type="button" class="btn btn-primary">Month</button>
                                    <button type="button" class="btn btn-outline-primary">Year</button>
                                </div>
                            </div> --}}
                        </div>
                        <div id="incomeChart"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6 col-xl-6 grid-margin stretch-card">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="tw-flex tw-justify-between">
                            <h6 class="card-title mb-4">Sales by Category</h6>
                            <div class="dropdown mb-3">
                                <button
                                    class="btn tw-inline-flex tw-items-center tw-justify-between tw-bg-primary tw-text-white hover:tw-bg-primary hover:tw-text-white hover:tw-shadow-md focus:tw-border-none focus:tw-bg-primary focus:tw-text-white"
                                    type="button"
                                    id="filterDropdown"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    Filter Sales
                                    <i
                                        data-feather="chevron-down"
                                        class="tw-text-sm tw-text-white"
                                    ></i>
                                </button>

                                <ul
                                    class="dropdown-menu"
                                    aria-labelledby="filterDropdown"
                                >
                                    <li>
                                        <a
                                            class="dropdown-item"
                                            onclick="filterSales('today')"
                                            href="#today"
                                        >
                                            Today
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            class="dropdown-item"
                                            onclick="filterSales('week')"
                                            href="#week"
                                        >
                                            This Week
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            class="dropdown-item"
                                            onclick="filterSales('month')"
                                            href="#month"
                                        >
                                            This Month
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div
                            id="salesCategoryChartToday"
                            class="chart-div"
                        ></div>
                        <div
                            id="salesCategoryChartWeek"
                            class="chart-div"
                            style="display: none"
                        ></div>
                        <div
                            id="salesCategoryChartMonth"
                            class="chart-div"
                            style="display: none"
                        ></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Convert the daily revenue data to a format that can be used by ApexCharts
        const dailyRevenue = @json($dailyRevenue);
        const labels = dailyRevenue.map(item => item.date);
        const data = dailyRevenue.map(item => parseFloat(item.total)); // Ensure totals are parsed as floats

        var options = {
            series: [{
                name: 'Daily Income',
                data: data
            }],
            chart: {
                type: 'line',
                height: 200
            },
            xaxis: {
                categories: labels
            },
            yaxis: {
                title: {
                    text: 'Income (Rp)'
                }
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy'
                },
            }
        };

        var chart = new ApexCharts(document.querySelector("#incomeChart"), options);
        chart.render();
    </script>
    
    <script>
        function filterSales(timeframe) {
            // Hide all chart divs
            document.querySelectorAll('.chart-div').forEach(div => div.style.display = 'none');

            // Show the specific chart div for the selected timeframe
            const chartDivId = `#salesCategoryChart${timeframe.charAt(0).toUpperCase() + timeframe.slice(1)}`;
            document.querySelector(chartDivId).style.display = 'block';
            console.log(chartDivId)

            // Fetch data for the specific timeframe
            fetch(`/admin/report/filter-sales?timeframe=${timeframe}`)
                .then(response => response.json())
                .then(data => {
                    // console.log("DATA : ", data)
                    const chartOptions = {
                        series: data.series,
                        chart: {
                            type: 'pie',
                            height: 350
                        },
                        legend: {
                            position: 'bottom'
                        },
                        labels: data.labels
                    };

                    const chartDiv = document.querySelector(chartDivId);
                    // Destroy any existing chart in this div to avoid conflicts
                    if (chartDiv.chart) {
                        chartDiv.chart.destroy();
                    }

                    // Create a new chart for the selected timeframe
                    const salesCategoryChart = new ApexCharts(chartDiv, chartOptions);
                    salesCategoryChart.render();
                    chartDiv.chart = salesCategoryChart;
                })
                .catch(error => console.error('Error fetching sales data:', error));
        }

        // Initialize the default chart (e.g., Today)
        filterSales('today');
    </script>
@endsection
