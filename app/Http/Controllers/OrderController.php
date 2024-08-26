<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->input('filter', 'all'); // Default to 'all' if no filter is selected
        $ordersQuery = Order::with(['customer', 'cartItems.product']); // Eager load relationships

        switch ($filter) {
            case 'today':
                $ordersQuery->whereDate('created_at', Carbon::today());
                break;

            case 'this_week':
                $ordersQuery->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;

            case 'this_month':
                $ordersQuery->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
                break;

            default:
                // Do nothing, show all orders
                break;
        }

        $orders = $ordersQuery->get(); // Execute the query and get the results

        return view("admin.order.index", compact('orders'));
    }


    public function changeStatus(Request $request, $order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retrieve necessary data for the order creation (e.g., list of products, customers)
        $products = Product::orderBy('product_kategori', 'asc')->get();
        $customers = Customer::all();

        return view('admin.order.create', compact('products', 'customers'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_nama' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:15',
            'products' => 'required|array',
            'status' => 'required|string',
        ]);

        $customer = Customer::create([
            'customer_nama' => $request->customer_nama,
            'no_telepon' => $request->customer_phone,
            // Add other customer fields as needed
        ]);

        DB::transaction(function () use ($request, $customer) {
            // Generate a unique order ID
            $order_id = $this->generateOrderId();

            // Create the order and associate it with the new customer
            $order = Order::create([
                'order_id' => $order_id,
                'customer_id' => $customer->customer_id,
                'status' => $request->status,
                'subtotal' => 0, // We'll calculate this below
                'tax' => 5000, // Example tax
                'total' => 0, // We'll calculate this below
            ]);

            $subtotal = 0;
            
            // Iterate over selected products to add them to the order
            foreach ($request->products as $product_id) {
                $product = Product::findOrFail($product_id); // Ensure the product exists
                $order->cartItems()->create([
                    'product_id' => $product->product_id,
                    'quantity' => 1, // Adjust quantity as needed
                    'price' => $product->product_harga,
                ]);
                $subtotal += $product->product_harga;
            }
    
            // Update the order with the calculated subtotal and total
            $order->update([
                'subtotal' => $subtotal,
                'total' => $subtotal + $order->tax,
            ]);
        });
    
        // Redirect back to the orders list with a success message
        return redirect()->route('orders.index')->with('success', 'Order created successfully!');
    }

    private function generateOrderId()
    {
        
        $uniqueId = '8SU' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

        // Ensure the generated ID is unique within the session (or use DB if needed)
        while (Order::where('order_id', $uniqueId)->exists()) {
            $uniqueId = '8SU' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        }

        return $uniqueId;
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
        $order = Order::findOrFail($id);

        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Catalogue deleted successfully.');
    }
}
