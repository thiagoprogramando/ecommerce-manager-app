<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model {

    use HasFactory;

    protected $table = 'image_product';

    protected $fillable = [
        'product_id',
        'file'
    ];

}
