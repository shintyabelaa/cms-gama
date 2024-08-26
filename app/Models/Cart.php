<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $primaryKey = 'cart_id';

    public $timestamps = true;
    protected $fillable = [
        'cart_id',
        'customer_id',
        'product_id',
        'quantity',
        'created_at',
        'updated_at',
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
