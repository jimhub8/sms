<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'delivered',
        'returned',
        'total_orders',
        'comment',
        'rider'
    ];


    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::parse($value)->format('y-m-d');
    }
}
