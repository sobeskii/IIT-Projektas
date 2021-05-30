<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use App\Models\Rating;
use Aerni\Spotify\Facades\SpotifyFacade as Spotify;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show_reactions(){

        $user_reactions =   Rating::getReviewsUserLiked()->get();
        $reactions      =   $this->appendAPIData($user_reactions);

        return Inertia::render('Profile/Reactions',[
            'reactions' =>  fn() => $reactions,
        ]);
    }

    public function show_ratings(){

        $user_ratings   =   Rating::getUserRatings()->get();
        $ratings        =   $this->appendAPIData($user_ratings);

        return Inertia::render('Profile/Ratings',[
            'ratings'   =>  fn()    =>  $ratings,
        ]);
    }

    private function appendAPIData($releases) {

        foreach ($releases as $release) {
            $release['release']  =   Spotify::album($release['release_id'])->get();
        }

        return $releases;
    }
}
