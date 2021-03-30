<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    protected $table = "books";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'title',
        'cover',
        'category',
        'author',
        'publish_date',
        'description',
    ];
    protected $hidden = [
        
    ];

    public function reviews()
    {
        return $this->hasMany('App\Review');
        // return $this->hasMany(Review::class);
    }
}
