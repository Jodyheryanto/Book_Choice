<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;
    protected $table = "reviews";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'user_id',
        'book_id',
        'post',
        'is_positive',
        'rating'
    ];
    protected $hidden = [

    ];
    public function book(){
        return $this->belongsTo('App\Book');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
