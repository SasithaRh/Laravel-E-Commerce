<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Color;
class Prodct_Color extends Model
{
    use HasFactory;

    public function getColor()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }


}
