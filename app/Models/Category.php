<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'is_active'
    ];
    // public static function boot()
    // {
    //     parent::boot();
    //     static::creating(function ($model) {
    //         $model->slug=$model->slug ?? \Str::slug($model->name);
    //         // $model->name=\Str::lower($model->name);
    //     });
    // }
}
