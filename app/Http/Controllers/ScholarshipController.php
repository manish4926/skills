<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

use App\Http\Requests;
use App\Model\User;
use App\Model\Scholarship;
use Auth;
use Image;
use Session;
use Validator;

use Carbon\Carbon;

class ScholarshipController extends Controller
{
	/* -- -- -- -- -- --For Viewer -- -- -- -- -- -- -- */
	public function scholarship(Request $request)		//Dashboard
	{
	    $user = Auth::user();
		$scholarship = Scholarship::where('status', '=', 1)
							->orderBy('id', 'desc')
							->paginate(10);

	    return view('scholarship.index',compact('user','scholarship','request'));
    }

    /* -- -- -- -- -- --For Poster -- -- -- -- -- -- -- */
    public function addScholarship(Request $request)		//Add Scholarship
	{
	    $user = Auth::user();
		$scholarship = Scholarship::where('status', '=', 1)
							->orderBy('id', 'desc')
							->paginate(10);

	    return view('scholarship.addscholarship',compact('user','scholarship','request'));
    }


    public function addLinkedScholarship(Request $request)		//Add Linked Scholarship
	{
	    $user = Auth::user();
		$scholarship = Scholarship::where('status', '=', 1)
							->orderBy('id', 'desc')
							->paginate(10);

	    return view('scholarship.index',compact('user','scholarship','request'));
    }
}
