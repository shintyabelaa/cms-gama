<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardOwner()
    {
        $totalCustomers = Customer::count();
        $incomeToday = Order::whereDate('created_at', now()->toDateString())->sum('total');
        $totalAdmin = User::count();

        return view('admin.owner.dashboard', compact('totalCustomers', 'incomeToday', 'totalAdmin'));
    }

    public function cashierDashboard()
    {
        $totalCustomers = Customer::count();
        $totalMenuItems = Product::count();
        $totalOrders = Order::count();

        $ordersInProcess = Order::where('status', 'process')->count();
        $ordersUnpaid = Order::where('status', 'unpaid')->count();
        $ordersPaid = Order::where('status', 'paid')->count();
        $incomeToday = Order::whereDate('created_at', now()->toDateString())->sum('total');

        return view('admin.kasir.dashboard', compact('totalCustomers', 'totalMenuItems', 'totalOrders', 'ordersInProcess', 'ordersUnpaid', 'ordersPaid', 'incomeToday'));
    }

    public function kitchenDashboard()
    {
        $totalCustomers = Customer::count();
        $totalMenuItems = Product::count();
        $totalOrders = Order::count();

        $ordersInProcess = Order::where('status', 'process')->count();
        $orders = Order::where('status', 'process')->get();

        return view('admin.dashboard', compact('totalCustomers', 'totalMenuItems', 'totalOrders', 'ordersInProcess', 'orders'));
    }

}
