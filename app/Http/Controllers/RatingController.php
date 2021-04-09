<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Rules\ReleaseExists;
use Illuminate\Support\Facades\Redirect;

class RatingController extends Controller
{

    public function put(Request $request){

        $request->validate( [   'review'        =>  'nullable|string|max:10000',
                                'release_id'    =>  ['required','string',new ReleaseExists],
                                'user_id'       =>  'required|integer|exists:users,id',
                                'rating'        =>  'required|numeric|between:0.5,5'
        ]);
        $data = $request->all();
        $data['review'] = ($data['review'] != null) ? htmlentities($data['review'],ENT_QUOTES) : null;

        Rating::updateOrCreate(     [   'release_id'    =>      $data['release_id'],
                                        'user_id'       =>      $data['user_id']
                                    ],
                                    [   'review'        =>      $data['review'],
                                        'rating'        =>      $data['rating']
                                    ]);

        return Redirect::route('release.index',$request->release_id)->with(['success' => ['message' => "Rating added"]]);
    }

    public function delete(Request $request){

        $request->validate( [   'rating_id'     =>  'required|integer|exists:rating,id',
                                'release_id'    =>  ['required','string',new ReleaseExists],
        ]);

        Rating::deleteRatingById($request->input('rating_id'));

        return Redirect::route('release.index',$request->release_id)->with(['success' => ['message' => "Rating removed"]]);
    }
}
