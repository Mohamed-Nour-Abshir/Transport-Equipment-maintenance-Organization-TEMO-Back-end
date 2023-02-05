<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_date',
        'to_date',
        'supplier_id',
        'supplier_name',
        'vehicle_code',
        'vehicle_name',
        'parts_code',
        'parts_name',
        'company'
    ];
    public function parts()
    {
        return $this->belongsTo(PartsInfo::class, 'parts_id');
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }
}
