<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Rating;
use Aerni\Spotify\Facades\SpotifyFacade as Spotify;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $releases    =   $this->getBestRatedReleases();
        return Inertia::render('Home',[
            'releases'   =>  fn()    => $releases,
        ]);
    }

    private function getBestRatedReleases() {
        $releases    =   Rating::getBestRatedReleaseIds()->limit(15)->get();
        foreach ($releases as $release) {
            $release['release']  =   Spotify::album($release['release_id'])->get();
        }
        return $releases;
    }


}
