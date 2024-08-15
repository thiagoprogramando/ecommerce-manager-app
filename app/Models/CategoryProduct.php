<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model {

    use HasFactory;

    protected $table = 'category_product';

    protected $fillable = [
        'product_id',
        'category_id'
    ];

    public function productLabel() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function categoryLabel() {
        return $this->belongsTo(Category::class, 'category_id');
    }
}