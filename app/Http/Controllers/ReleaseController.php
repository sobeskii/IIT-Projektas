<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Aerni\Spotify\Facades\SpotifyFacade as Spotify;

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

        return Inertia::render('Release',[
            'release'           =>      $release,
            'primary_artist'    =>      $artist,
        ]);
    }
}



