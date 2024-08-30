<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model {

    use HasFactory;

    protected $table = 'links';

    protected $fillable = [
        'url_whatsapp',
        'url_instagram',
        'url_facebook',
        'url_linkedin',
        'url_github',
        'url_maps',
        'license'
    ];
}
