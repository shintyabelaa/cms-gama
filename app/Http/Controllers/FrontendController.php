<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function welcome($table_no)
    {
        return view('frontend.welcome', ['table_no' => $table_no]);
    }

    public function homepage($table_no)
    {
        $customer_id = session('customer_id');
        // $cartItems = session('cart_items', collect([]));
        $cartItems = Cart::where('customer_id', $customer_id)->with('product')->get();
        // dd($cartItems);
        $search = request()->query('search');
        $query = Product::where('status_publish', 'Y');

        if ($search) {
            $query->where('product_nama', 'like', '%' . $search . '%');
        }

        $products = $query->get()->groupBy('product_kategori');

        return view('frontend.homepage.index', [
            'products' => $products,
            'search' => $search,
            'table_no' => $table_no,
            'customer_id' => $customer_id,
            'cartItems' => $cartItems
        ]);
    }

    public function review($table_no)
    {
        // Fetch all reviews from the database
        $reviews = Review::with('customer')->get();

        // Pass the reviews to the view
        return view('frontend.review', ['table_no' => $table_no], compact('reviews'));
    }

    public function addToCart(Request $request)
    {
        $customer_id = session('customer_id'); // Assuming you store customer ID in session

        $cart = Cart::updateOrCreate(
            ['customer_id' => $customer_id, 'product_id' => $request->product_id],
            ['quantity' => DB::raw("quantity + {$request->quantity}")]
        );

        $cartItems = Cart::where('customer_id', $customer_id)->with('product')->get();
        session(['cartItems' => $cartItems]);

        return response()->json(['success' => 'Product added to cart!', 'cart' => $cart]);
    }

    public function removeFromCart(Request $request)
    {
        $customer_id = session('customer_id'); // Assuming you store customer ID in session

        $cart = Cart::updateOrCreate(
            ['customer_id' => $customer_id, 'product_id' => $request->product_id],
            ['quantity' => DB::raw('quantity - 1')]
        );

        $cartItems = Cart::where('customer_id', $customer_id)->with('product')->get();
        session(['cartItems' => $cartItems]);

        return response()->json(['success' => 'Product added to cart!', 'cart' => $cart]);
    }


    public function cart($table_no)
    {
        $customer_id = session('customer_id');
        $order_type = session('order_type', 'Dine In');

        $cartItems = Cart::where('customer_id', $customer_id)->with('product')->get();

        // Generate a unique identifier and store it in the session if not already present
        if (!session()->has('temporary_order_id')) {
            $temporaryOrderId = $this->generateTemporaryOrderId();
            session(['temporary_order_id' => $temporaryOrderId]);
        } else {
            $temporaryOrderId = session('temporary_order_id');
        }

        return view('frontend.cart', [
            'cartItems' => $cartItems,
            'table_no' => $table_no,
            'customer_id' => $customer_id,
            'order_type' => $order_type,
            'temporary_order_id' => $temporaryOrderId,
        ]);
    }

    private function generateTemporaryOrderId()
    {
        
        $uniqueId = '8SU' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

        // Ensure the generated ID is unique within the session (or use DB if needed)
        while (Order::where('order_id', $uniqueId)->exists()) {
            $uniqueId = '8SU' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        }

        return $uniqueId;
    }

    public function personalInfo($table_no)
    {
        $customer_id = session('customer_id');

        if (!$customer_id) {
            return redirect()->route('frontend.welcome', ['table_no' => $table_no])
                ->withErrors(['error' => 'Customer not found.']);
        }

        $customer = Customer::find($customer_id);

        if (!$customer) {
            return redirect()->route('frontend.welcome', ['table_no' => $table_no])
                ->withErrors(['error' => 'Customer not found in the database.']);
        }

        return view('frontend.personal_information', [
            'table_no' => $table_no,
            'customer' => $customer
        ]);
    }

    public function order($table_no)
    {
        $customer_id = session('customer_id');

        if (!$customer_id) {
            return redirect()->route('frontend.welcome', ['table_no' => $table_no])
                ->withErrors(['error' => 'Customer not found.']);
        }

        $customer = Customer::find($customer_id);
        $order = Order::where('customer_id', $customer_id)->latest()->first();
        $cartItems = Cart::where('customer_id', $customer_id)->with('product')->get();

        if (!$customer) {
            return redirect()->route('frontend.welcome', ['table_no' => $table_no])
                ->withErrors(['error' => 'Customer not found.']);
        }

        if (!$order) {
            return redirect()->route('frontend.welcome', ['table_no' => $table_no])
                ->withErrors(['error' => 'No recent orders found.']);
        }

        return view('frontend.transaction', [
            'table_no' => $table_no,
            'customer' => $customer,
            'order' => $order,
            'cartItems' => $cartItems,
        ]);
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
