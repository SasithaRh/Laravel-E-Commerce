<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodct_Image extends Model
{
    use HasFactory;

    protected $fillable = ['prodcut_id', 'image_name','image_extension','order_by']; // Add other fields if needed
}
