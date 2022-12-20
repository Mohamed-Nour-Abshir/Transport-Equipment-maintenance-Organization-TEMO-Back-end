<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;
    public function parts()
    {
        return $this->belongsTo(PartsInfo::class);
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
