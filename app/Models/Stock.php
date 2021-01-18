<?php

namespace App\Models;

use App\Agent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['agent_id', 'opening_stock','closing_stock','received','delivered','returned','stock_date'];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('D M d Y');
    }

    public function setStockDateAttribute($value)
    {
        $this->attributes['stock_date'] = Carbon::parse($value)->format('yy-m-d');
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

}
