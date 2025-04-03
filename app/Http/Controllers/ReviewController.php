<?php

namespace App\Http\Controllers;


use App\Models\Customer;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function review()
    {
        $reviews = Review::with('customer')->get();
        return view('admin.review', compact('reviews'));
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
    public function store($table_no, Request $request)
    {
        // Validate the request data
        $request->validate(Review::$rules);

        // Debug: check if customer_id is present
        $customer_id = $request->input('customer_id');
        if (!$customer_id) {
            return redirect()->back()->withErrors(['customer_id' => 'Customer ID is missing']);
        }

        Review::create([
            'customer_id' => $customer_id,
            'ulasan_rating' => $request->ulasan_rating,
            'ulasan_deskripsi' => $request->ulasan_deskripsi,
        ]);

        $customer = Customer::find($customer_id);

        // Redirect back with a success message
        if ($customer) {
            return redirect()->back()->with('success', "Thank you for your feedback, {$customer->customer_nama}!");
        } else {
            return redirect()->back()->with('success', 'Thank you for your feedback!');
        }
    }
}
