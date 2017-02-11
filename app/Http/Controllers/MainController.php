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

class MainController extends Controller
{
	public function openMainPage(Request $request)		//Home Page
	{
		if (Auth::check()) {
		    return redirect()->route('dashboard');
		}
    	return view('home',compact('request'));
	}

	public function dashboard(Request $request)		//Dashboard
	{
		$user = Auth::user();

    	return view('dashboard',compact('user','request'));
	}

	
}


