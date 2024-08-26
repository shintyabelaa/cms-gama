<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'customers';

    protected $primaryKey = 'customer_id';

    public $timestamps = true;
    protected $fillable = [
        'customer_id',
        'customer_nama',
        'no_telepon',
        'created_at',
        'updated_at',
    ];

    protected $dates = ['created_at', 'updated_at'];

    public static $rules = [
        'customer_nama' => 'required|string|max:32',
        'no_telepon' => 'required|string|max:15',
    ];
}
