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
     * Show the application home page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $releases    =   $this->appendAPIData();
        return Inertia::render('Home/Home',[
            'releases'   =>  fn()    => $releases,
        ]);
    }
    /**
     * Append API data to the rating information from the database
     *
     * @return array
     */
    private function appendAPIData() {
        $releases    =   Rating::getBestRatedReleaseIds()->limit(15)->get();
        foreach ($releases as $release) {
            $release['release']  =   Spotify::album($release['release_id'])->get();
        }
        return $releases;
    }


}
