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

		foreach($scholarships as $scholarship){
			$scholarship->duration = Carbon::parse($scholarship->scholar_start_date)->diffInWeeks(Carbon::parse($scholarship->scholar_end_date));

			$scholarship->daysleft = Carbon::now()->diffInDays(Carbon::parse($scholarship->last_date), false);
		}
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
		$generalScholarships = Scholarship::whereNull('link')
							->orWhere('link', '=', "")
							->orderBy('id', 'desc')
							->paginate(10);

		$linkedScholarships = Scholarship::whereNotNull('link')
							->orderBy('id', 'desc')
							->paginate(10);

		foreach($generalScholarships as $generalScholarship){
			$generalScholarship->duration = Carbon::parse($generalScholarship->scholar_start_date)->diffInWeeks(Carbon::parse($generalScholarship->scholar_end_date));

			$generalScholarship->daysleft = Carbon::now()->diffInDays(Carbon::parse($generalScholarship->last_date), false);
		}

		foreach($linkedScholarships as $linkedScholarship){
			$linkedScholarship->duration = Carbon::parse($linkedScholarship->scholar_start_date)->diffInWeeks(Carbon::parse($linkedScholarship->scholar_end_date));

			$linkedScholarship->daysleft = Carbon::now()->diffInDays(Carbon::parse($linkedScholarship->last_date), false);
		}
	    return view('scholarship.myscholarships',compact('user','generalScholarships','linkedScholarships','request'));
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


    public function editScholarship(Request $request)		//Edit Scholarship
	{
	    $user 			= Auth::user();
		$id 			= $request->id;
		$scholarship	= Scholarship::where('id', '=', $id)
							->first();

	    return view('scholarship.editscholarship',compact('user','scholarship','request'));
    }

    public function editScholarshipSubmit(Request $request)		//Add Scholarship
	{
	    $user = Auth::user();
		Scholarship::where('posted_by', $user->id)
					->where('id', $request->post_id)
            		->update(['title' => $request->title,'slug' => seoUrl(trim($request->title)), 'link' => $request->link, 'location' => $request->location, 'state' => $request->state, 'last_date' => $request->last_date, 'scholar_start_date' => $request->coursestartdate, 'scholar_end_date' => $request->courseenddate, 'scholarship_amount' => $request->amount, 'openings_count' => $request->openings_count, 'brief_summary' => $request->description, 'requirements' => $request->requirements, 'prerequisits' => $request->prerequisits, 'details' => $request->details, 'about_company' => $request->about_corp, 'application_info' => $request->application_info, 'selection_criteria' => $request->criteria, 'others' => $request->other, 'name' => $request->contact_name, 'email' => $request->contact_email, 'phone' => $request->contact_phone, 'status' => (int)$request->post_status]);

    	return redirect()->route('myScholarship');
    }

    public function updateScholarshipStatus(Request $request)		//Dashboard
	{
		$user = Auth::user();
		$id 	= $request->id;
		$type 	= $request->type;

		if($type == 'delete') {
			Market::where('posted_by', $user->id)
					->where('id', $id)
            		->delete();

            return "Sucessfully Deleted";
		}
		elseif($type == 'publish' OR $type == 'unpublish') {
			$status = ($type == 'publish' ? 1 : 0);
			Scholarship::where('posted_by', $user->id)
					->where('id', $id)
            		->update(['status' => $status]);

            return "Status Sucessfully Updated";
		}
		return "Error Occured";

	}
}