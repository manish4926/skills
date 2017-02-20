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
		$scholarships = Scholarship::where('status', '=', 1)
							->orderBy('id', 'desc')
							->paginate(10);

	    return view('scholarship.index',compact('user','scholarships','request'));
    }

    public function scholarshipDetail(Request $request)		//Scholarship Detail
	{
	    $user 	= Auth::user();
	    $id 	= $request->id;
		$scholarship	= Scholarship::where('id', '=', $id)
							->first();

	    return view('scholarship.index',compact('user','scholarship','request'));
    }


    /* -- -- -- -- -- --For Poster -- -- -- -- -- -- -- */
    public function myScholarship(Request $request)		//Dashboard
	{
	    $user = Auth::user();
		$generalScholarships = Scholarship::where('linked', '=', "")
							->orderBy('id', 'desc')
							->paginate(10);

		$linkedScholarships = Scholarship::where('linked', '!=', "")
							->orderBy('id', 'desc')
							->paginate(10);

	    return view('scholarship.index',compact('user','generalScholarships','linkedScholarships','request'));
    }

    public function addScholarship(Request $request)		//Add Scholarship
	{
	    $user = Auth::user();

		$type = $request->type;
	    return view('scholarship.addscholarship',compact('user','type','request'));
    }

    public function addScholarshipSubmit(Request $request)		//Add Scholarship
	{
	    $user = Auth::user();
		$scholarship = new Scholarship;
		$scholarship->title 				= $request->title;
		$scholarship->slug 					= seoUrl(trim($request->title));
		$scholarship->link 					= $request->link;
		$scholarship->location 				= $request->location;
		$scholarship->state 				= $request->state;
		$scholarship->last_date 			= $request->last_date;
		$scholarship->scholar_start_date 	= $request->coursestartdate;
		$scholarship->scholar_end_date 		= $request->courseenddate;
		$scholarship->scholarship_amount 	= $request->amount;
		$scholarship->openings_count 		= $request->openings_count;
		$scholarship->brief_summary 		= $request->description;
		$scholarship->requirements 			= $request->requirements;
		$scholarship->prerequisits 			= $request->prerequisits;
		$scholarship->details 				= $request->details;
		$scholarship->about_company 		= $request->about_corp;
		$scholarship->application_info 		= $request->application_info;
		$scholarship->selection_criteria 	= $request->criteria;
		$scholarship->others 				= $request->other;
		$scholarship->name 					= $request->contact_name;
		$scholarship->email 				= $request->contact_email;
		$scholarship->phone 				= $request->contact_phone;
		$scholarship->posted_by 			= $user->id;
		$scholarship->status 				= (int)$request->post_status;
		$scholarship->save();

    	return redirect()->route('scholarship');
    }


    public function editScholarshipSubmit(Request $request)		//Edit Scholarship
	{
	    $user = Auth::user();
		$scholarship = Scholarship::where('status', '=', 1)
							->orderBy('id', 'desc')
							->paginate(10);

	    return view('scholarship.index',compact('user','scholarship','request'));
    }
}
