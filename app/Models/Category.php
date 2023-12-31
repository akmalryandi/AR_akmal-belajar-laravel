<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'product_categories';
    protected $fillable = [
        'category_name',
        'created_by',
        'updated_by',
        'is_active',
        ];
    public function products(){
        return $this->hasMany(Product::class);
    }
}
