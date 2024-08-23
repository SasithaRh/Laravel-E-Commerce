<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    use HasFactory;
   // protected $table ="discount_code";
    protected $fillable = [
        'name',
        'type',
        'percent_amount',
        'expire_date',
        'status',
        'is_delete',
        'create_at',


    ];
    static public function getcolors() {
        return self::select('discount_codes.*')
        ->where('discount_codes.is_delete', '=', 0)
        ->where('discount_codes.status', '=', 1)
        ->orderBy('discount_codes.id', 'desc')
        ->paginate(10);
    }
    static public function checkDiscount($code) {
        return self::select('discount_codes.*')
        ->where('discount_codes.is_delete', '=', 0)
        ->where('discount_codes.status', '=', 1)
        ->where('discount_codes.name', '=',$code)
        ->where('discount_codes.expire_date', '>=',date('Y-m-d'))

        ->get();
    }

}
