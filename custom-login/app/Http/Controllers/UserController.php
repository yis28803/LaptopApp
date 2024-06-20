<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Laptop;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            $userType = Auth()->user()->user_type;
            $users = User::paginate(10);
            if ($userType == 'admin') {
                return view('admin.users.user', compact('users'));
            } else {
                return redirect()->back();
            }
        }
    }

    public function delete($id)
    {
        if (Auth::id()) {
            $userType = Auth()->user()->user_type;
            if ($userType == 'admin') {
               $exitingUser = User::findOrFail($id);
               $exitingUser->delete();
               return view('admin.users.user',['success','Successfully deleted user with id ='.$id]);
            }
            return redirect()->back();
        }
    }
    public function search(Request $request)
    {
         {
            if (Auth::id()) {
                $userType = Auth()->user()->user_type;
                if ($userType == 'admin') {
                    $keyword = $request->input('keyword');
                    $users = User::where('name', 'like', "%$keyword%")
                        ->orWhere('email', '=', "$keyword")
                        ->paginate(10);
                    return view('admin.users.user', compact('users'));
                }
                return redirect()->back();
            }
        }
    }

    

   

}
