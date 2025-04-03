<?php

namespace App\Http\Controllers;

use App\Notifications\NewOrderNotification;
use App\Models\User;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use DB;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function store($table_no, Request $request)
    {
        // Check if the request comes from the homepage
        if ($request->is("tables/{$table_no}/store-phone")) {
            // Validate only the phone number for the homepage
            $request->validate([
                'no_telepon' => 'required|string|max:50',
                'order_type' => 'required|string',
            ]);

            // Provide a default value for `customer_nama`
            $customerNama = 'Guest'; // or any other default value
        } else {
            // Validate full details for other forms like invoice or reviews
            $request->validate(Customer::$rules);
            $customerNama = $request->input('customer_nama');
        }

        // Save the phone number to the database
        $customer = Customer::firstOrCreate(
            ['no_telepon' => $request->input('no_telepon')],
            ['customer_nama' => $customerNama]
        );

        session(['customer_id' => $customer->customer_id, 'order_type' => $request->input('order_type')]);

        // Redirect to the homepage with a success message
        return redirect()->route('frontend.homepage.index', ['table_no' => $table_no, 'customer_id' => $customer->customer_id])->with('success', 'Phone number saved successfully!');
    }

    public function updateCustomer($table_no, Request $request)
    {
        $customer_id = session('customer_id');
        $customer = Customer::find($customer_id);

        if ($customer) {
            $customer->update([
                'customer_nama' => $request->input('name'),
            ]);

            $cartItems = Cart::where('customer_id', $customer_id)->with('product')->get();

            if ($cartItems->isEmpty()) {
                return back()->withErrors(['error' => 'No items in the cart.']);
            }

            // Calculate subtotal
            $subtotal = $cartItems->sum(fn($item) => $item->product->product_harga * $item->quantity);

            // Define tax (example: Rp5.000)
            $tax = 5000;

            // Calculate total
            $total = $subtotal + $tax;

            // Retrieve the temporary order ID from the session
        $temporaryOrderId = session('temporary_order_id');

            // Create the order
            $order = DB::transaction(function () use ($customer_id, $subtotal, $tax, $total, $table_no, $temporaryOrderId) {
                return Order::create([
                    'order_id' => $temporaryOrderId,
                    'customer_id' => $customer_id,
                    'subtotal' => $subtotal,
                    'tax' => $tax,
                    'total' => $total,
                    'table_no' => $table_no,
                    
                ]);
            });

            session()->forget('temporary_order_id');
            
            $adminUsers = User::whereIn('role', ['dapur', 'kasir'])->get(); // Assuming you have a role column
            foreach ($adminUsers as $admin) {
                $admin->notify(new NewOrderNotification($order));
            }

            // Pass the cart items and order directly to the transaction view
            $transactionData = [
                'table_no' => $table_no,
                'customer' => $customer,
                'order' => $order,
                'cartItems' => $cartItems,
            ];

            // Clear the cart
            // Cart::where('customer_id', $customer_id)->delete();

             session()->forget('order_no');
            // Redirect to the transaction page with the cart items and order data
            return redirect()->route('frontend.transaction', [
                'table_no' => $table_no,
                'customer' => $customer,
                'order' => $order,
                'cartItems' => $cartItems,
            ])->with('success', 'Personal information updated and order placed successfully!');
        }


        return back()->withErrors(['error' => 'Customer not found.']);
    }

}
