<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Refil extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable =[
        'product_id',
        'created_by',
        'old_stock',
        'quantity',
        'total_stock',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id'); 
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id'); 
    }
}
