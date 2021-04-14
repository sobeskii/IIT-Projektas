<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Aerni\Spotify\Facades\SpotifyFacade as Spotify;
use App\Models\Rating;
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

        $user            =      Auth::user();
        $userRating      =      (!Auth::guest())  ?  $user->getReleaseRating( $releaseId ) :  null;
        $rating_data     =      [
                                    'average'   =>      Rating::ratingAverage($releaseId),
                                    'count'     =>      Rating::getRatingCount($releaseId),
                                    'reviews'   =>      (Rating::getReviews($releaseId)->get()) ? Rating::getReviews($releaseId)->get() : null,
                                ];

        return Inertia::render('Release',[
            'release'                       =>      $release,
            'primary_artist'                =>      $artist,
            'user_rating_data'              =>      [
                                                        'rating'    =>    ( $userRating != null )       ?   $userRating->rating : 0,
                                                        'review'    =>    ( $userRating != null )       ?   $userRating->review : null,
                                                        'id'        =>    ( $userRating != null)        ?   $userRating->id     : null,
                                                    ],
            'rating_data'                   =>      $rating_data,
        ]);
    }

    public function show_chart(){

    }
}



