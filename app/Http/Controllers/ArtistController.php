<?php

namespace App\Http\Controllers;

use Aerni\Spotify\Facades\SpotifyFacade as Spotify;
use App\Models\Rating;
use Inertia\Inertia;

class ArtistController extends Controller
{
    public function __construct()
    {
        $this->middleware('banned');
    }
    public function index($artistId){

        $artist = Spotify::artist($artistId)->get();

        $artistAlbums = $this->getArtistReleases($artistId);

        return Inertia::render('Artist',[
            'artist'            =>      fn () => $artist,
            'artist_releases'   =>      fn () => $artistAlbums,
        ]);
    }

    private function getArtistReleases($artistId){
        // Get initial data of releases (total)
        $releases = Spotify::artistAlbums($artistId)->includeGroups('album,single')
                                                    ->limit(50)
                                                    ->get();

        $all_releases = [];
        $all_releases = array_merge($all_releases,$releases['items']);

        // Get the rest of release data
        //Put all release data into one array

        for ($i=50; $i < $releases['total']; $i+=50){
            $items = Spotify::artistAlbums($artistId)->includeGroups('album,single')->limit(50)->offset($i)->get()['items'];
            $all_releases = array_merge($all_releases,$items);
        }

        // Locale setting seems to be broken in the API itself
        // Get unique releases to avoid clutter
        // Add rating information values to each release
        $all_releases = collect($all_releases)->unique('name')->map(function ($value){
            $value['rating_average']    =   Rating::getRatingAverage($value['id']);
            $value['rating_count']      =   Rating::getRatingCount($value['id']);
            return $value;
        })->values();

        return $all_releases;
    }

}
