<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    use HasFactory;
    protected $table ="discount_code";
    // protected $fillable = [
    //     'name',
    //     'status',
    //     'code',

    //     'created_by',
    //     'is_delete'
    // ];
    static public function getcolors() {
        return self::select('discount_code.*')
        ->where('discount_code.is_delete', '=', 0)
        ->where('discount_code.status', '=', 1)
        ->orderBy('discount_code.id', 'desc')
        ->paginate(10);
    }
}
