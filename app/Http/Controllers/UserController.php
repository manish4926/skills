<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

use App\Http\Requests;
use App\Model\User;
use App\Model\Group;
use App\Model\GroupMember;
use Auth;
use Image;
use Session;
use Validator;

use Carbon\Carbon;

class UserController extends Controller
{
    public function profile(Request $request)		//Profile Page
	{
		$user = Auth::user();
		$userid = $request->id;
    	return view('user.profile',compact('user','userid'));
	}

	public function updateProfilePic(Request $request)		//Profile Page
	{
		$user = Auth::user();

		$imagename  = base64_encode($pcode).'.jpg';
        $path       = public_path('img/profile/' .$imagename);
        Image::make($image->getRealPath())->save($path);

        /* Add To Database*/
    	return view('user.profile',compact('user'));
	}
}