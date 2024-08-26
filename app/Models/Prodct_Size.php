<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodct_Size extends Model
{
    use HasFactory;

    static public function getSingle($slug) {
        return self::where('id', '=', $slug)->first();
    }

}
