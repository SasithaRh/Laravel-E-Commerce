<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'created_by',
        'is_delete'
    ];
}
