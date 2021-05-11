<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class LikedRatingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function toggle(Rating $rating,Request $request){

        if ($rating->likes()->where('user_id',auth()->id())->
                              where('is_like',$request->is_like)->exists())
            $rating->likes()->detach(auth()->id());
        else
            $rating->likes()->attach(auth()->id()   ,  [ 'is_like'  =>  $request->is_like ]) ;

        return redirect()->back();
    }
}
