<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Aerni\Spotify\Facades\SpotifyFacade as Spotify;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReleaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('banned');
    }
    /**
     *
     *
     * @return Inertia\Inertia;
     */
    public function index($releaseId)
    {
        $release    =   Spotify::album($releaseId)->get();

        $artist     =   Spotify::artist($release['artists'][0]['id'])->get();

        $user            =      Auth::user();
        $userRating      =      (!Auth::guest())  ?  $user->getReleaseRating( $releaseId ) :  null;
        $rating_data     =      [
                                    'average'   =>      Rating::getRatingAverage($releaseId),
                                    'count'     =>      Rating::getRatingCount($releaseId),
                                    'reviews'   =>      Rating::getReviews($releaseId)->get(),
                                ];

        return Inertia::render('Release/Release',[
            'release'                       =>  fn()    =>      $release,
            'primary_artist'                =>  fn()    =>      $artist,
            'user_rating_data'              =>  fn()    =>      [
                                                                    'rating'    =>    ( $userRating != null )       ?   $userRating->rating : 0,
                                                                    'review'    =>    ( $userRating != null )       ?   $userRating->review : null,
                                                                    'id'        =>    ( $userRating != null)        ?   $userRating->id     : null,
                                                                ],
            'rating_data'                   =>  fn()    =>      $rating_data,
        ]);
    }
    /**
     * Show chart page
     *
     * @return Inertia/Inertia
     */
    public function show_chart(Request $request)
    {
        $perPage    =   (($request->perPage) != null && $request->perPage <= 20 && $request->perPage >= 5) ? (int)$request->perPage : 15;
        $releases   =   $this->appendAPIData($perPage);

        return Inertia::render('Release/Chart',[
            'releases'      =>      $releases,
            'request_items' =>      fn()    =>  [   'perPage'  =>  $perPage,    ],
        ]);
    }
    /**
     * Append API data to the rating information from the database
     *
     * @return array
     */
    private function appendAPIData($perPage) {
        $releases    =   Rating::getBestRatedReleaseIds()->paginate($perPage);

        foreach ($releases as $release) {
            $release['release']  =   Spotify::album($release['release_id'])->get();
        }

        return $releases;
    }
}



