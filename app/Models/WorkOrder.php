<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;
    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->order_no = $model->id;
            $model->save();
        });
    }
}
