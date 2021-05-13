<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikedRating extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [ 'user_id','rating_id' , 'is_like' ];

    /**
    * Get the user record associated with the like.
    */
    public function user() { return $this->belongsTo('App\Models\User'); }
    /**
    * Get the user record associated with the like.
    */
    public function rating() { return $this->belongsTo('App\Models\Rating'); }
}
