<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table   = 'user_ratings';
    //
    protected $fillable = [ 'rating','release_id', 'user_id', 'review', 'artist_id' ];
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
     *
     */
    public static function getArtistsReleaseRatings($artistId){  return Rating::where( 'artist_id' , '=' ,$artistId );  }
    /**
    * Get count of ratings on a release
    */
    public static function getRatingCount($releaseId){ return Rating::getReleaseRatings($releaseId)->count();   }
    /**
    * Compute and return rating average
    */
    public static function ratingAverage($releaseId) {
        $average = Rating::getReleaseRatings($releaseId)->avg('rating');
        return  ($average == null) ?    0   :   $average;
    }
    /**
     * Compute the like and dislike count and determine if logged in user has liked or disliked the review
     */
    public function scopecomputeRatingInfo($query){
        return $query->withCount([ 'likes as liked' => function ($q) {
            $q->where('user_id',auth()->id())->
                where('is_like',true);
        }])->withCount([ 'likes as disliked' => function ($q) {
            $q->where('user_id',auth()->id())->
                where('is_like',false);
        }])->withCasts(['liked' => 'boolean'])->
        withCasts(['disliked' => 'boolean'])->
        withCount([ 'likes as like_count' => function ($q) {
            $q->where('is_like',true);
        }])->
        withCount([ 'likes as dislike_count' => function ($q) {
            $q->where('is_like',false);
        }]);
    }
    /**
    * Retrieve reviews of release with like counts and bool value if the user liked / disliked review
    */
    public static function getReviews($releaseId)   {
        return Rating::getReleaseRatings($releaseId)->computeRatingInfo()->
                        with(['user' => function ($q) {
                                            $q->select('id','name');
                                        }])->where( 'review' , '!=' ,null )
                                           ->orderBy('created_at','desc');
    }

    /**
    * Retrieve reviews which user has liked/disliked with like counts and bool value if the user liked / disliked review
    */
    public static function getReviewsUserLiked(){
        return Rating::computeRatingInfo()->whereHas('likes',function($q){
            $q->where('user_id','=',auth()->id());
        })->with('user')->orderBy('created_at','desc');
    }
    /**
    * Retrieve ratings which user has written with like counts and bool value if the user liked / disliked review
    */
    public static function getUserRatings(){
        return Rating::computeRatingInfo()->where('user_id',auth()->id())
                                          ->with('user')
                                          ->orderBy('created_at','desc');
    }
}
