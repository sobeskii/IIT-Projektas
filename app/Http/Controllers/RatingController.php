<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Rules\ReleaseExists;
use App\Rules\ArtistExists;
use Illuminate\Support\Facades\Redirect;

class RatingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','banned']);
    }
    public function put(Request $request){

        $request->validate( [   'review'        =>  'nullable|string|max:10000|min:5',
                                'release_id'    =>  ['required','string',new ReleaseExists],
                                'artist_id'     =>  ['required','string',new ArtistExists],
                                'user_id'       =>  'required|integer|exists:users,id',
                                'rating'        =>  'required|numeric|between:0.5,5'
        ]);
        $data = $request->all();

        Rating::updateOrCreate(     [   'release_id'    =>      $data['release_id'],
                                        'user_id'       =>      $data['user_id'],
                                        'artist_id'     =>      $data['artist_id'],
                                    ],
                                    [   'review'        =>      $data['review'],
                                        'rating'        =>      $data['rating']
                                    ]);

        return Redirect::route('release.index',$request->release_id)->with(['success' => ['message' => 'Rating added']]);
    }

    public function delete(Rating $rating,Request $request){

        $request->validate( [   'release_id'    =>  ['required','string',new ReleaseExists],
                                'artist_id'     =>  ['required','string',new ArtistExists],
                            ]);

        $rating->likes()->detach();
        $rating->delete();

        return Redirect::route('release.index',$request->release_id)->with(['success' => ['message' => 'Rating removed']]);
    }
}
