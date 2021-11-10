<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'name',
        'logo',
        'created_by',
        'updated_by',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id'); 
    }
}
