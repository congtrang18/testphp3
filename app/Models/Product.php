<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
    ];
    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
    public function Galleries()
    {
        return $this->hasMany(Gallery::class);
    }
    public function Tag(){
        return $this->belongsToMany(Tag::class,'product_tag');
    }
}
