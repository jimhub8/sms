<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'vendor_id'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('D M d Y');
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
}
