<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aerni\Spotify\Facades\SpotifyFacade as Spotify;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('banned');
    }
  /**
   * Search the specified album/release on the Spotify API.
   *
   * @return Inertia\Inertia;
   */
    public function index(Request $request)
    {
        $term       =   ($request->term) != null ? $request->term : ' ';
        $offset     =   (($request->offset) != null && $request->offset >= 0 && $request->offset <= 20 && $request->offset >= 5)   ? (int)$request->offset : 0;
        $perPage    =   (($request->perPage) != null && $request->perPage <= 20 && $request->perPage >= 5) ? (int)$request->perPage : 15;

        $releases   =   $this->getReleases($term,$offset,$perPage);

        return Inertia::render('Search',[
            'albums'        =>      fn  ()  =>  $releases,
            'request_items' =>      fn  ()  =>  ['term'     =>  $term,
                                                 'offset'   =>  $offset,
                                                 'perPage'  =>  $perPage,
                                                ],
        ]);
    }
    private function getReleases($term,$offset,$perPage){

        $releases =  Spotify::searchAlbums($term)->offset($offset)
                                                 ->limit($perPage)
                                                 ->get()['albums'];

        // Locale setting seems to be broken in the API itself.
        // Get unique releases to avoid clutter.
        $releases['items']  =   collect($releases['items'])->unique('name')->values();

        return $releases;
    }
}
