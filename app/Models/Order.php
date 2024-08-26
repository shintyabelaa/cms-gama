<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $table = 'orders';

    protected $primaryKey = 'order_id';

    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = true;
    protected $fillable = [
        'order_id',
        'customer_id',
        'subtotal',
        'tax',
        'total',
        'table_no',
        'status', 
        'created_at',
        'updated_at',
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function cartItems()
    {
        return $this->hasMany(Cart::class, 'customer_id', 'customer_id');
    }
}
