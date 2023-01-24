<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;


    public function parts()
    {
        return $this->belongsTo(PartsInfo::class, 'parts_id');
    }

}
