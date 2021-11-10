<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleDraft extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'draft_id',
        'user_id',
        'product_id',
        'quantity',
        'total',
    ];

}