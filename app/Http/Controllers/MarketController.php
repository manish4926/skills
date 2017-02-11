<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

use App\Http\Requests;
use App\Model\User;
use App\Model\Market;
use Auth;
use Image;
use Session;
use Validator;

use Carbon\Carbon;

class MarketController extends Controller
{
    public function add(Request $request)		//Dashboard
	{
		$user = Auth::user();
    	return view('addmarket',compact('user','request'));
	}

	public function addSubmit(Request $request)		//Dashboard
	{
		$user = Auth::user();
		$group = new Market;
		$group->group_name 			= $request->group_name;
		$group->group_admin_id 		= $user->id;
		$group->allow_join 			= (int)$request->allow_join;
		$group->description 		= $request->description;
		$group->allow_post_public 	= (int)$request->allow_post_public;
		$group->save();
    	return view('addmarket',compact('user','request'));
	}
}
