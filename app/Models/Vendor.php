<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('D M d Y');
    }
}
