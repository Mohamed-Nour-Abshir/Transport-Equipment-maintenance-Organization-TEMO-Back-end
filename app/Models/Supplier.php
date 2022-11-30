<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->supplier_id = "S" . $model->id;
            $model->save();
        });
    }
}
