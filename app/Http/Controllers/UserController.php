<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use App\Models\Rating;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show_reactions(){

        $user_reactions =   Rating::getReviewsUserLiked()->get();

        return Inertia::render('Profile/Reactions',[
            'reactions' =>  fn() => $user_reactions,
        ]);
    }

    public function show_ratings(){

        $user_ratings   =   Rating::getUserRatings()->get();

        return Inertia::render('Profile/Ratings',[
            'ratings'   =>  fn()    => $user_ratings,
        ]);
    }
}
