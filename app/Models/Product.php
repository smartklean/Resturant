<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable =[
        'name',
        'logo',
        'created_by',
        'updated_by',
        'supplier_id',
        'category_id',
        'quantity',
        'cost_price',
        'selling_price',
        'low_stock',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id'); 
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id'); 
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id'); 
    }

}
