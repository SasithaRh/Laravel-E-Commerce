<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',

        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'created_by',
        'is_delete'
    ];
    static public function getbrands() {
        return self::select('brands.*', 'users.name as created_by')
        ->join('users', 'users.id', '=', 'brands.created_by')
        ->where('brands.is_delete', '=', 0)
        ->where('brands.status', '=', 1)
        ->orderBy('brands.id', 'desc')
        ->get();
    }
}
