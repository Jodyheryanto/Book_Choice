<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuestBook extends Model
{
    use SoftDeletes;

    protected $table = 'guest_books';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'guest_name', 'guest_message', 'job',
        'company', 'email',
    ];
}
