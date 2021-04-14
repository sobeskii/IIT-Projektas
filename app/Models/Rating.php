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

    public static function boot() {
        parent::boot();

        static::deleting(function($rating) { // before delete() method call this
            $rating->likes()->delete();
        });
    }

    /**
    * Get the user record associated with the rating.
    */
    public function user() { return $this->belongsTo('App\Models\User'); }
    /**
    * Get all of the reviews likes.
    */
    public function likes() { return $this->belongsToMany('App\Models\User', 'liked_ratings');  }
    /**
    * Get post like count
    */
    public function likeCount(){ return $this->likes()->count(); }
    /**
     *
     */
    public static function getReleaseRatings($releaseId){  return Rating::where( 'release_id' , '=' ,$releaseId );  }
    /**
    * Get count of ratings on a release
    */
    public static function getRatingCount($releaseId){ return Rating::getReleaseRatings($releaseId)->count();   }
    /**
    * Compute and return rating average
    */
    public static function ratingAverage($releaseId) {  return  ( Rating::getRatingCount($releaseId) != 0 ) ?
                                                                ( Rating::getReleaseRatings($releaseId)->sum('rating') / Rating::getRatingCount($releaseId) ) : 0;
    }
    /**
    * Retrieve reviews of release
    */
    public static function getReviews($releaseId)   {  return Rating::getReleaseRatings($releaseId)->
        withCount([ 'likes as liked' => function ($q) {
                $q->where('user_id',auth()->id())->
                    where('is_like',true);
            }
        ])->
        withCount([ 'likes as disliked' => function ($q) {
            $q->where('user_id',auth()->id())->
                where('is_like',false);
        }
        ])->
        withCount([ 'likes as like_count' => function ($q) {
            $q->where('is_like',true);
        }])->
        withCount([ 'likes as dislike_count' => function ($q) {
            $q->where('is_like',false);
        }])->
        withCasts(['liked' => 'boolean'])->
        withCasts(['disliked' => 'boolean'])->
        with(['user' => function ($q) {
            $q->select('id','name');
        }])->
        where( 'review' , '!=' ,null );
    }
}
