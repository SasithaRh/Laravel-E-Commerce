<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'is_admin',
        'status',
        'is_delete',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   static public function getTotalCustomers() {
    $details = User::select('users.*')->where('is_admin','=',0)->where('is_delete','=',0)->count();
    return $details;
    }
    static public function getTotalCustomersMonth($startDate,$endDate) {
        $details = User::select('users.*')->where('is_admin','=',0)
        ->where('is_delete','=',0)
        ->whereDate('created_at','>=',$startDate)
        ->whereDate('created_at','<=',$endDate)
        ->count();
        return $details;
        }
}
