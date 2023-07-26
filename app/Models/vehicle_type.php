<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehicle_type extends Model
{

    use HasFactory;
    public function getBrands()
    {
        return $this->hasMany(Brand::class, 'vt_id')->where('status', 1);
    }
}
