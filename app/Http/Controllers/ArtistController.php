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

        // Get initial data of releases (total)
        $releases = Spotify::artistAlbums($artistId)->includeGroups('album,single')
                                                    ->limit(50)
                                                    ->get();

        $all_api_data = [$releases];

        // Get the rest of release data
        for ($i=50; $i < $releases['total']; $i+=50)
            $all_api_data[] = Spotify::artistAlbums($artistId)->includeGroups('album,single')->limit(50)->offset($i)->get();

        // Put all album data to one array
        foreach ($all_api_data as $value)
            $all_releases[] = $value['items'];


        // Add rating information values to each release
        // Locale setting seems to be broken in the API itself.
        // Get unique releases to avoid clutter.
        $all_releases = collect($all_releases[0])->map(function ($value){
            $value['rating_average']    =   Rating::ratingAverage($value['id']);
            $value['rating_count']      =   Rating::getRatingCount($value['id']);
            return $value;
        })->unique('name')->values();

        return $all_releases;
    }

}
