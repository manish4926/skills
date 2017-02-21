<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

use App\Http\Requests;
use App\Model\User;
use App\Model\Group;
use App\Model\GroupMember;
use App\Model\IndianCities;
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

	public function updateProfilePic(Request $request)		//Update Profile Image
	{
		$user = Auth::user();

		$image     	= $request->file('image1');
		$imagename  = base64_encode($user->email).'.jpg';
        $path       = public_path('img/profile/' .$imagename);
        Image::make($image->getRealPath())->save($path);

        /* Add To Database*/
        User::where('id', $user->id)
            		->update(['profile_pic' => $imagename]);

    	return redirect()->back();
	}

	public function personalInformation(Request $request)		//Edit Personal Information
	{
		$user = Auth::user();
		$states = IndianCities::select('states')->groupBy('states')->get();
						
    	return view('user.personalinformation',compact('user','states'));
	}

	public function updatePassword(Request $request)
	{	//Update Password Information in My Accounts
		$this->validate($request, [
			'old_password' => 'required|min:5|confirmed',
			'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required'
        ]);

		$user = Auth::user();
		$old_password = bcrypt($request['old_password']);
		$checkuser = User::where('email', $user->email)
						->where('password', $old_password)
            			->count();

        if($checkuser == 1) {
        	$password = bcrypt($request['password']);
			User::where('email', $user->email)
	            ->update(['password' => $password]);
	        Session::flash('successMessage', 'Password Updated Successfully');
        }
        else {
        	Session::flash('errorMessage', 'Invalid Password');
        }
        
		
		return redirect()->back();
	}
}