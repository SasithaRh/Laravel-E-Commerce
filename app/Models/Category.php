<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'created_by',
        'is_delete'
    ];
}
