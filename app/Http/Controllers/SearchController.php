<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aerni\Spotify\Facades\SpotifyFacade as Spotify;
use Inertia\Inertia;

class SearchController extends Controller
{
  /**
   * Search the specified album/release on the Spotify API.
   *
   * @return Inertia\Inertia;
   */
    public function index(Request $request)
    {
        $term       =   ($request->term) != null ? $request->term : ' ';
        $offset     =   ($request->offset) != null && $request->offset > 0 ? (int)$request->offset : 0;
        $perPage    =   ($request->perPage) != null ? (int)$request->perPage : 15;

        return Inertia::render('Search',[
            'albums'        =>      Spotify::searchAlbums($term)->offset($offset)
                                                                ->limit($perPage)
                                                                ->get()['albums'],
            'request_items' =>  ['term'     =>  $term,
                                 'offset'   =>  $offset,
                                 'perPage'  =>  $perPage,
                                ],
        ]);
    }

}
