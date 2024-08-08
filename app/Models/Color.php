<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'code',

        'created_by',
        'is_delete'
    ];
    static public function getcolors() {
        return self::select('colors.*', 'users.name as created_by')
        ->join('users', 'users.id', '=', 'colors.created_by')
        ->where('colors.is_delete', '=', 0)
        ->where('colors.status', '=', 1)
        ->orderBy('colors.id', 'desc')
        ->get();
    }
}
