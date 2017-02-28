<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

use App\Http\Requests;
use App\Model\User;
use App\Model\Internship;
use App\Model\Applicant;
use App\Model\Newsfeed;
use Auth;
use Image;
use Session;
use Validator;

use Carbon\Carbon;

class InternshipController extends Controller
{
    /* -- -- -- -- -- --For Viewer -- -- -- -- -- -- -- */
	public function internship(Request $request)		//Dashboard
	{
	    $user = Auth::user();
		$internships = Internship::where('status', '=', 1)
							->orderBy('id', 'desc')
							->paginate(10);

		foreach($internships as $internship){
			$internship->duration = Carbon::parse($internship->scholar_start_date)->diffInWeeks(Carbon::parse($internship->scholar_end_date));

			$internship->daysleft = Carbon::now()->diffInDays(Carbon::parse($internship->last_date), false);
		}
	    return view('internship.index',compact('user','internships','request'));
    }

    public function internshipDetail(Request $request)		//Internship Detail
	{
	    $user 	= Auth::user();
	    $id 	= $request->id;
		$internship	= Internship::where('id', '=', $id)
							->first();
		$internship->duration = Carbon::parse($internship->scholar_start_date)->diffInWeeks(Carbon::parse($internship->scholar_end_date));

		$internship->daysleft = Carbon::now()->diffInDays(Carbon::parse($internship->last_date), false);

	    return view('internship.index',compact('user','internship','request'));
    }


    /* -- -- -- -- -- --For Poster -- -- -- -- -- -- -- */
    public function myInternship(Request $request)		//Dashboard
	{
	    $user = Auth::user();
		$generalInternships = Internship::whereNull('link')
							->orWhere('link', '=', "")
							->orderBy('id', 'desc')
							->paginate(10);

		$linkedInternships = Internship::whereNotNull('link')
							->orderBy('id', 'desc')
							->paginate(10);

		foreach($generalInternships as $generalInternship){
			$generalInternship->duration = Carbon::parse($generalInternship->scholar_start_date)->diffInWeeks(Carbon::parse($generalInternship->scholar_end_date));

			$generalInternship->daysleft = Carbon::now()->diffInDays(Carbon::parse($generalInternship->last_date), false);
		}

		foreach($linkedInternships as $linkedInternship){
			$linkedInternship->duration = Carbon::parse($linkedInternship->scholar_start_date)->diffInWeeks(Carbon::parse($linkedInternship->scholar_end_date));

			$linkedInternship->daysleft = Carbon::now()->diffInDays(Carbon::parse($linkedInternship->last_date), false);
		}
	    return view('internship.myinternships',compact('user','generalInternships','linkedInternships','request'));
    }

    public function addInternship(Request $request)		//Add Internship
	{
	    $user = Auth::user();

		$type = $request->type;
	    return view('internship.addinternship',compact('user','type','request'));
    }

    public function addInternshipSubmit(Request $request)		//Add Internship
	{
		$user = Auth::user();
		$internship = new Internship;
		$internship->title 					= $request->title;
		$internship->slug 					= seoUrl(trim($request->title));
		$internship->link 					= $request->link;
		$internship->location 				= $request->location;
		$internship->state 					= $request->state;
		$internship->last_date 				= $request->last_date;
		$internship->intern_start_date 		= $request->coursestartdate;
		$internship->intern_end_date 		= $request->courseenddate;
		$internship->stipend_amount 		= $request->amount;
		$internship->openings_count 		= $request->openings_count;
		$internship->brief_summary 			= $request->description;
		$internship->qualifications 		= $request->qualifications;
		$internship->prerequisits 			= $request->prerequisits;
		$internship->details 				= $request->details;
		$internship->about_company 			= $request->about_corp;
		$internship->deliverables 			= $request->deliverables;
		$internship->others 				= $request->other;
		$internship->name 					= $request->contact_name;
		$internship->email 					= $request->contact_email;
		$internship->phone 					= $request->contact_phone;
		$internship->posted_by 				= $user->id;
		$internship->status 				= (int)$request->post_status;
		$internship->save();

		$newinternship	= Internship::where('posted_by', '=', $user->id)
							->orderBy('id', 'desc')
							->first();


		if($newinternship->status == 1) {
		//Add To Newsfeeds
		$newsfeeds = new Newsfeed;
		$newsfeeds->userid 			= $user->id;;
		$newsfeeds->type 			= "internship_added";
		$newsfeeds->typeid 			= $newinternship->id;
		$newsfeeds->save();
		}

    	return redirect()->route('internship');
    }


    public function editInternship(Request $request)		//Edit Internship
	{
	    $user 			= Auth::user();
		$id 			= $request->id;
		$internship		= Internship::where('id', '=', $id)
							->first();

	    return view('internship.editinternship',compact('user','internship','request'));
    }

    public function editInternshipSubmit(Request $request)		//Add Internship
	{
	    $user = Auth::user();
		Internship::where('posted_by', $user->id)
					->where('id', $request->post_id)
            		->update(['title' => $request->title,'slug' => seoUrl(trim($request->title)), 'link' => $request->link, 'location' => $request->location, 'state' => $request->state, 'last_date' => $request->last_date, 'intern_start_date' => $request->coursestartdate, 'intern_end_date' => $request->courseenddate, 'stipend_amount' => $request->amount, 'openings_count' => $request->openings_count, 'brief_summary' => $request->description, 'requirements' => $request->requirements, 'prerequisits' => $request->prerequisits, 'details' => $request->details, 'about_company' => $request->about_corp, 'deliverables' => $request->deliverables, 'others' => $request->other, 'name' => $request->contact_name, 'email' => $request->contact_email, 'phone' => $request->contact_phone, 'status' => (int)$request->post_status]);

        if((int)$request->post_status == 1) {
		//Add To Newsfeeds
		$newsfeeds = new Newsfeed;
		$newsfeeds->userid 			= $user->id;;
		$newsfeeds->type 			= "internship_added";
		$newsfeeds->typeid 			= $request->post_id;
		$newsfeeds->save();
		}

    	return redirect()->route('myInternship');
    }

    public function updateInternshipStatus(Request $request)		//Dashboard
	{
		$user = Auth::user();
		$id 	= $request->id;
		$type 	= $request->type;

		if($type == 'delete') {
			Internship::where('posted_by', $user->id)
					->where('id', $id)
            		->delete();

            return "Sucessfully Deleted";
		}
		elseif($type == 'publish' OR $type == 'unpublish') {
			$status = ($type == 'publish' ? 1 : 0);
			Internship::where('posted_by', $user->id)
					->where('id', $id)
            		->update(['status' => $status]);

            if($status == 1) {
			//Add To Newsfeeds
			$newsfeeds = new Newsfeed;
			$newsfeeds->userid 			= $user->id;;
			$newsfeeds->type 			= "internship_added";
			$newsfeeds->typeid 			= $id;
			$newsfeeds->save();
			}

            return "Status Sucessfully Updated";
		}
		return "Error Occured";

	}
}
