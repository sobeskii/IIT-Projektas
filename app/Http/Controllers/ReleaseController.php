<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Aerni\Spotify\Facades\SpotifyFacade as Spotify;
use Illuminate\Support\Facades\Auth;

class ReleaseController extends Controller
{
    /**
     *
     *
     * @return Inertia\Inertia;
     */
    public function index($releaseId)
    {

        $release = Spotify::album($releaseId)->get();

        $artist = Spotify::artist($release['artists'][0]['id'])->get();

        $user            =   Auth::user();
        $userRating      =   (!Auth::guest())  ?  $user->getReleaseRating( $releaseId ) :  null;


        return Inertia::render('Release',[
            'release'                       =>      $release,
            'primary_artist'                =>      $artist,
            'user_rating_data'              =>      [   'rating'    =>    ( $userRating != null )   ?   $userRating->rating : 0,
                                                        'review'    =>    ( $userRating != null )   ?   $userRating->review : null,
                                                        'id'        =>    ( $userRating != null)    ?   $userRating->id     : null,
                                                    ],
        ]);
    }

    public function show_chart(){

    }
}



