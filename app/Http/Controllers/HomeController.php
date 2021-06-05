<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use App\Models\Rating;
use Aerni\Spotify\Facades\SpotifyFacade as Spotify;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('banned');
    }
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
