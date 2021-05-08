<?php

namespace App\Http\Controllers;

use Aerni\Spotify\Facades\SpotifyFacade as Spotify;
use App\Models\Rating;
use Inertia\Inertia;

class ArtistController extends Controller
{
    public function index($artistId){

        $artist = Spotify::artist($artistId)->get();

        $artistAlbums = $this->getArtistReleases($artistId);

        return Inertia::render('Artist',[
            'artist'            =>      fn () => $artist,
            'artist_releases'   =>      fn () => $artistAlbums,
        ]);
    }

    private function getArtistReleases($artistId){

        $releases = Spotify::artistAlbums($artistId)->limit(50)->get();

        $all_api_data = [$releases];
        for ($i=50; $i < $releases['total']; $i+=50)
            $all_api_data[] = Spotify::artistAlbums($artistId)->limit(50)->offset($i)->get();

        foreach ($all_api_data as $value)
            $all_releases[] = $value['items'];

        $all_releases = collect($all_releases)->flatten(1)->filter(function($value){
            return (    $value['album_group'] != 'appears_on') &&
                        count($value['available_markets']) > 173     ?   true    :   false;
        })->values()->map(function ($value){
            $value['rating_average']    =   Rating::ratingAverage($value['id']);
            $value['rating_count']      =   Rating::getRatingCount($value['id']);
            return $value;

        });

        return $all_releases->toArray();
    }

}
