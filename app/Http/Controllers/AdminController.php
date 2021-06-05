<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin','banned']);
    }

    public function index(Request $request)
    {
        $term       =   ($request->term) != null ? $request->term : '';
        $perPage    =   (($request->perPage) != null && $request->perPage <= 20 && $request->perPage >= 5) ? (int)$request->perPage : 15;

        $users =    User::getUsers($term,$perPage);

        return Inertia::render('Admin/AdminHome',[
            'users'         =>      fn()    =>  $users,
            'request_items' =>      fn()    =>  [   'perPage'   =>  $perPage,
                                                    'term'      =>  $term,   ],
        ]);
    }

    public function ban_user(User $user){
        if($user != null){
            $user->updateRole(0);
            return Redirect::route('admin.index')->with(['success' => ['message' => 'User has been banned!']]);
        } else Redirect::route('admin.index')->with(['error' => ['message' => 'Something went wrong please try again']]);
    }

    public function unban_user(User $user){
        if($user != null){
            $user->updateRole(1);
            return Redirect::route('admin.index')->with(['success' => ['message' => 'User has been unbanned!']]);
        } else Redirect::route('admin.index')->with(['error' => ['message' => 'Something went wrong please try again']]);
    }

}
