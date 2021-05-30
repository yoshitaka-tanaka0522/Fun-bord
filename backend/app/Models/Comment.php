<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function bulletin_boards() 
    {
        return $this->belongsTo('App\Models\BulletinBoard');
    }

    public function user() 
    {
        return $this->belongsTo('App\Models\User');
    }    
}
