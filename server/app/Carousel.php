<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carousel extends Model
{
    use SoftDeletes;
    protected $table = "carousels";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'title',
        'caption',
        'image_path'
    ];
    protected $hidden = [

    ];
}
