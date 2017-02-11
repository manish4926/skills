<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\Middleware\ShareErrorsFromSession;

use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Role;
use Auth;
use Session;
use Validator;
use Socialite;
use Carbon\Carbon;
use App\Http\Requests;

class AuthController extends Controller
{
    public function postRegister(Request $request)
	{

		$type 			= $request['type'];
		if($type == 'school' OR $type == 'business'){
			$this->validate($request, [
				'tname' => 'required|alpha',
				'phone' => 'required|digits:10|numeric',
	            'email' => 'required|email|unique:users|max:255',
	            'password' => 'required|min:5|confirmed',
	            'password_confirmation' => 'required'
	        ]);

	        $firstname 		= "";
			$lastname 		= "";
			$tname			= $request['tname'];
			$name 			= $tname;


		} else {
			$this->validate($request, [
				'fname' => 'required|alpha',
				'lname' => 'required|alpha',
				'phone' => 'required|digits:10|numeric',
	            'email' => 'required|email|unique:users|max:255',
	            'password' => 'required|min:5|confirmed',
	            'password_confirmation' => 'required'
	        ]);

	        $firstname 		= $request['fname'];
			$lastname 		= $request['lname'];
			$tname			= "";
			$name 			= $firstname." ".$lastname;
		}

		$email 			= $request['email'];
		$phonenumber 	= $request['phone'];
		$password 		= bcrypt($request['password']);
		
		$user = new User;
		$user->name = $tname;
		$user->firstname = $firstname;
		$user->lastname = $lastname;
		$user->phone = $phonenumber;
		$user->email = $email;
		$user->password = $password;
		$user->save();
		$user->roles()->attach(Role::where('name',$type)->first());
		Auth::login($user, true);
		if($request->ajax()){
			
            return "Success";
        }
		return redirect()->back();
	}
	public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'pass' => 'required'
        ]);
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['pass']],true)) {
        		$user = Auth::user();
        		Cart::where('userid', $request->cookie('cartid'))
            			->update(['userid' => $user->email]);
	        	if($request->ajax()){
	                return "Success";
	            }
                if($user->hasRole('Admin') == true){
                    return redirect()->route('adminactiveorders');
                }
	            return redirect()->route('home');	//In this true will remember your password
	        }
	    if($request->ajax()){
            return "Failed";
        }
        Session::flash('popupMessage', 'popup-login');
        return redirect()->back()->withInput();
    }
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
    public function facebookLogin()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function facebookCallBackUrl()
    {
        $user = Socialite::driver('facebook')->stateless()->user();
        $firstname  = $user->name;
        $email      = $user->email;
        $sns_id     = $user->id;
        $checkUser  = User::where('email', $email)
                            ->count();
        if($checkUser == 0) {
            $user = new User;
            $user->firstname    = $firstname;
            $user->lastname     = "";
            $user->phone        = "";
            $user->email        = $email;
            $user->password     = "";
            $user->account_type = "Facebook";
            $user->sns_acc_id   = $sns_id;
            $user->save();
            $user->roles()->attach(Role::where('name','User')->first());
        } else {
            User::where('email', $email)
                ->update(['account_type' => "Facebook", 'sns_acc_id' => $sns_id]);
        }
        $userLogin = User::whereEmail($email)->first();
        Auth::login($userLogin, true);
        return redirect()->route('home');
    }
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }
    public function googleCallBackUrl()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $firstname  = $user->getName();
        $email      = $user->getEmail();
        $sns_id     = $user->getId();
        $checkUser  = User::where('email', $email)
                            ->count();
        if($checkUser == 0) {
            $user = new User;
            $user->firstname    = $firstname;
            $user->lastname     = "";
            $user->phone        = "";
            $user->email        = $email;
            $user->password     = "";
            $user->account_type = "Google";
            $user->sns_acc_id   = $sns_id;
            $user->save();
            $user->roles()->attach(Role::where('name','User')->first());
        } else {
            User::where('email', $email)
                ->update(['account_type' => "Google", 'sns_acc_id' => $sns_id]);
        }
        $userLogin = User::whereEmail($email)->first();
        Auth::login($userLogin, true);
        return redirect()->route('home');
    }

}
