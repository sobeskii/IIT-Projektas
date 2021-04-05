<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [ 'likeable_id','likeable_type' , 'isLiked' ];

    /**
    * Get all of the owning likeable models.
    */
    public function likeable()  { return $this->morphTo();  }
    /**
    * Check if like exists.
    */
    public static function likeExists( $user_id, $id, $type )  {  return Like::where( 'user_id', $user_id )->
                                                                          where( 'likeable_id', $id )->
                                                                          where( 'likeable_type', $type )->exists(); }
    /**
    * Check if like exists.
    */
    public static function deleteLike( $user_id, $id, $type )  {  return Like::where( 'user_id', $user_id )->
                                                                          where( 'likeable_id', $id )->
                                                                          where( 'likeable_type', $type )->delete(); }


}
