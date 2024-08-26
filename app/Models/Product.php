<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';

    protected $primaryKey = 'product_id';

    public $timestamps = true;

    protected $fillable = [
        'product_gambar',
        'product_nama',
        'product_kategori',
        'product_harga',
        'product_deskripsi',
        'status_publish',
        'created_at',
        'updated_at',
    ];

    protected $dates = ['created_at', 'updated_at'];

    public static $rules = [
        'product_nama' => 'required|string|max:32',
        'product_deskripsi' => 'required|string',
        'product_harga' => 'required|integer',
        'product_kategori' => 'required|string|max:20',
        'status_publish' => 'required|string|in:Y,N',
        'product_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
    ];
}
