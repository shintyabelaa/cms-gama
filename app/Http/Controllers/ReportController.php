<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function report(Request $request)
    {

         // Define the period (e.g., last 7 days)
    $startDate = now()->subDays(6); // 7 days including today
    $endDate = now();

    // Calculate the total revenue for each day within the period
    $dailyRevenue = Order::selectRaw('DATE(created_at) as date, SUM(total) as total')
        // ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

    // Calculate the total revenue for today
    $totalPendapatan = Order::whereDate('created_at', now()->toDateString())->sum('total');

    // Pass the variables to the view
    return view('admin.report', compact('totalPendapatan', 'dailyRevenue'));
}

    public function filterSales(Request $request)
    {
        $timeframe = $request->query('timeframe', 'today');
        $query = Product::join('carts', 'products.product_id', '=', 'carts.product_id')
            ->join('orders', 'orders.customer_id', '=', 'carts.customer_id');

        // Apply the timeframe filter to the query
        switch ($timeframe) {
            case 'today':
                $query->whereDate('orders.created_at', now()->toDateString());
                break;
            case 'week':
                $query->whereBetween('orders.created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('orders.created_at', now()->month)
                    ->whereYear('orders.created_at', now()->year);
                break;
        }

        // Get sales by category for the selected timeframe
        $salesByCategory = $query->selectRaw('products.product_kategori, SUM(carts.quantity * products.product_harga) as total')
            ->groupBy('products.product_kategori')
            ->get();


        // Prepare data for the chart
        $data = [
            'series' => $salesByCategory->pluck('total')->map(function ($total) {
                return (float) $total; // Cast to float
            })->toArray(),
            'labels' => $salesByCategory->pluck('product_kategori')->toArray(),
        ];

        return response()->json($data);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
