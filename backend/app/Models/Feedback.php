<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'customer_name',
        'message',
        'rating'
    ];
    
    protected $casts = [
        'rating' => 'integer'
    ];
}
