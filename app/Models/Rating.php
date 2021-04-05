<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table   = 'user_ratings';
    //
    protected $fillable = [ 'rating','release_id', 'user_id', 'review' ];

    /**
    * Get the user record associated with the rating.
    */
    public function user() { return $this->belongsTo('App\Models\User'); }
    /**
    * Get all of the reviews likes.
    */
    public function likes() { return $this->morphMany('App\Models\Like', 'likeable');  }
    /**
    * Get post like count
    */
    public function likeCount(){ return $this->likes()->count(); }
}
