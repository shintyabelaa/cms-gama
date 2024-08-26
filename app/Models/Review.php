<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'reviews';

    protected $primaryKey = 'ulasan_id';

    public $timestamps = true;
    protected $fillable = [
        'customer_id',
        'ulasan_id',
        'ulasan_rating',
        'ulasan_deskripsi',
        'created_at',
        'updated_at',
    ];

    protected $dates = ['created_at', 'updated_at'];

    public static $rules = [
        'ulasan_rating' => 'required|integer|min:1|max:5',
        'ulasan_deskripsi' => 'required|string',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }
}
