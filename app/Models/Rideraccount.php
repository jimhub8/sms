<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rideraccount extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('D, d M Y');
    }
}
