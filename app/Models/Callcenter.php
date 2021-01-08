<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Callcenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'client',
        'total_orders',
        'comment',
        'data',
        'start_date',
        'end_date'
    ];

    public function setDataAttribute($value)
    {
        $this->attributes['data'] = serialize($value);
    }

    public function getDataAttribute($data)
    {
        return unserialize($data);
    }

    // public function setStartDateAttribute($value)
    // {
    //     $this->attributes['start_date'] = Carbon::parse($value)->format('y-m-d') ;
    // }

    // public function setEndDateAttribute($value)
    // {
    //     $this->attributes['end_date'] = Carbon::parse($value)->format('y-m-d') ;
    // }
}
