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
use App\Model\ProfileText;
use App\Model\UserProfile;
use App\Model\Follower;
use App\Model\Newsfeed;
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
		$getUser = User::where('id','=',$userid)
						->first();

    	return view('user.profile',compact('user','getUser'));
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

	public function personalInformationSubmit(Request $request)		//Edit Personal Information
	{
		$user = Auth::user();

		$countUserProfile = UserProfile::where('user_id','=',$user->id)
								->count();

		if($countUserProfile == 0) {

		$userprofile = new UserProfile;
		$userprofile->user_id 				= $user->id;
		$userprofile->gender 				= (int)$request->gender;
		$userprofile->dob 					= $request->dob;
		$userprofile->basic_education 		= $request->basic_education;
		$userprofile->p_address 			= $request->p_address;
		$userprofile->p_state 				= $request->p_state;
		$userprofile->p_city 				= $request->p_city;
		$userprofile->p_country 			= $request->p_country;
		$userprofile->p_pincode 			= $request->p_pincode;
		$userprofile->c_address 			= $request->c_address;
		$userprofile->c_state 				= $request->c_state;
		$userprofile->c_city 				= $request->c_city;
		$userprofile->c_country 			= $request->c_country;
		$userprofile->c_pincode 			= $request->c_pincode;
		$userprofile->website 				= $request->website;
		$userprofile->youtube 				= $request->youtube;
		$userprofile->exp_level 			= $request->exp_level;
		$userprofile->contact_visibility 	= (int)$request->allow_contact;

		$userprofile->telephone 			= $request->p_mobile;
		$userprofile->office_email 			= $request->p_email;
		$userprofile->school_category 		= $request->category_school;
		$userprofile->permanent_person 		= $request->p_person;
		$userprofile->save();

		$name = !empty($request->first_name) ? $request->first_name." ".$request->last_name : $request->name;
		User::where('id', $user->id)
            		->update(['firstname' => $request->first_name, 'lastname' => $request->last_name, 'name' => $name, 'phone' => $request->p_mobile]);

		}
		else
		{
			$name = !empty($request->first_name) ? $request->first_name." ".$request->last_name : $request->name;
			//update
			UserProfile::where('user_id', $user->id)
            				->update(['gender' => (int)$request->gender, 'dob' => $request->dob, 'basic_education' => $request->basic_education, 'p_address' => $request->p_address, 'p_state' => $request->p_state, 'p_city' => $request->p_city, 'p_country' => $request->p_country, 'p_pincode' => $request->p_pincode, 'c_address' => $request->c_address, 'c_state' => $request->c_state, 'c_city' => $request->c_city, 'c_country' => $request->c_country, 'c_pincode' => $request->c_pincode, 'website' => $request->website, 'youtube' => $request->youtube, 'exp_level' => $request->exp_level, 'contact_visibility' => (int)$request->allow_contact, 'telephone' => $request->p_mobile, 'office_email' => $request->p_email, 'school_category' => $request->category_school, 'permanent_person' => $request->p_person]);

			User::where('id', $user->id)
            		->update(['firstname' => $request->first_name, 'lastname' => $request->last_name, 'name' => $name, 'phone' => $request->p_mobile]);
		}				

		Session::flash('successMessage', 'Profile Successfully Updated');
    	return redirect()->route('personalInformation');
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

	public function followUser(Request $request)
	{
		$user = Auth::user();
		$id 	= $request->id;
		$type 	= $request->type;

		if(empty($id) OR empty($type))
		{
			return "Error Occured";	
		}
		
		$status = ($type == 'publish' ? 1 : 0);
		if($type == 'follow')
		{
			$followuser = new Follower;
			$followuser->follower_id 	= $id;
			$followuser->user_id 		= $user->id;
			$followuser->save();

			//Add To Newsfeeds
			$newsfeeds = new Newsfeed;
			$newsfeeds->userid 			= $user->id;;
			$newsfeeds->type 			= "user_follow";
			$newsfeeds->typeid 			= $id;
			$newsfeeds->save();
			
		} else
		{
			Follower::where('user_id', $user->id)
						->where('follower_id', $id)
            			->delete();
		}
        return "Status Sucessfully Updated";
		
		
	}

	public function newsfeeds(Request $request)
	{
		$user = Auth::user();
		$newsfeeds = Newsfeed::get();
		foreach($newsfeeds as $newsfeed){
			$newsfeed->timeago = $newsfeed->updated_at->diffForHumans();
		}

		return view('newsfeeds',compact('user','newsfeeds'));
	}

	public function myActivity(Request $request)
	{
		$user = Auth::user();
		$newsfeeds = Newsfeed::get();
		foreach($newsfeeds as $newsfeed){
			$newsfeed->timeago = $newsfeed->updated_at->diffForHumans();
		}

		return view('myactivity',compact('user','newsfeeds'));
	}

	public function profileSection($id,$section_id)
	{

	$section_title = "";
	if($section_id == 24) { $section_title = "Branchs / Franchise Addresses"; }
	if($section_id == 0) { $section_title = "Summary"; }
	if($section_id == 1) { $section_title = "Interested to Teach"; }
	if($section_id == 2) { $section_title = "Academic Qulaifications"; }
	if($section_id == 3) { $section_title = "Professional Qulaifications"; }
	if($section_id == 4) { $section_title = "Work Experience"; }
	if($section_id == 5) { $section_title = "Specialisation / Certification"; }
	if($section_id == 6) { $section_title = "Assignments / Responsibilities"; }
	if($section_id == 7) { $section_title = "Research Done"; }
	if($section_id == 8) { $section_title = "Seminars / Workshops Attended"; }
	if($section_id == 9) { $section_title = "Awards / Accolades"; }
	if($section_id == 10) { $section_title = "Computer Knowledge"; }

	//students

	if($section_id == 11) { $section_title = "Present Qualifications"; }
	if($section_id == 12) { $section_title = "Past Qualifications"; }
	if($section_id == 13) { $section_title = "Awards / Accolades"; }
	if($section_id == 14) { $section_title = "Course / Coaching Interested In"; }
	if($section_id == 15) { $section_title = "Specilaisation / Certification"; }
	if($section_id == 16) { $section_title = "Sports / Hobbies/ Cultural Activity"; }
	if($section_id == 17) { $section_title = "Computer Knowledge"; }
	if($section_id == 18) { $section_title = "Work Experience"; }


	// scholl

	if($section_id == 19) { $section_title = "Classes / Courses Offred"; }
	if($section_id == 20) { $section_title = "Reasearch Offered"; }
	if($section_id == 21) { $section_title = "Specilaisation / Certifications Offered"; }
	if($section_id == 22) { $section_title = "Awards"; }
	if($section_id == 23) { $section_title = "Affiliations"; }



	$boost_array = array();
	
	$getRecodes = ProfileText::where('section_id','=',$section_id)
					->where('user_id','=',$id)
					->get();
	foreach($getRecodes as $key => $profile)
	{
	$helos = json_decode($profile->text);       
	$boost_array[] = array("recid" => "".$profile->id."","list" => $helos);
	}
	$array = array("id"=> "".$section_id."","title" => "".$section_title."", "recs" => $boost_array);

	//array_multisort($array);
	return json_encode($array);
	}

	public function profileSectionForm($id,$section_id,$tok)
	{
	if (Auth::guest()) return '';


	if($section_id == 0) {  return view('profile_forms.type0')->withType(0)->withTokens($tok); }
	if($section_id == 1) {  return view('profile_forms.type1')->withType(1)->withTokens($tok); }
	if($section_id == 2) {  return view('profile_forms.type2')->withType(2)->withTokens($tok); }
	if($section_id == 3) {  return view('profile_forms.type2')->withType(3)->withTokens($tok); }
	if($section_id == 4) {  return view('profile_forms.type4')->withType(4)->withTokens($tok); }
	if($section_id == 5) {  return view('profile_forms.type5')->withType(5)->withTokens($tok); }
	if($section_id == 6) {  return view('profile_forms.type6')->withType(6)->withTokens($tok); }
	if($section_id == 7) {  return view('profile_forms.type6')->withType(7)->withTokens($tok); }
	if($section_id == 8) {  return view('profile_forms.type8')->withType(8)->withTokens($tok); }
	if($section_id == 9) {  return view('profile_forms.type8')->withType(9)->withTokens($tok); }
	if($section_id == 10) {  return view('profile_forms.type10')->withType(10)->withTokens($tok); }
	if($section_id == 11) {  return view('profile_forms.type11')->withType(11)->withTokens($tok); }
	if($section_id == 12) {  return view('profile_forms.type12')->withType(12)->withTokens($tok); }
	if($section_id == 13) {  return view('profile_forms.type13')->withType(13)->withTokens($tok); }
	if($section_id == 14) {  return view('profile_forms.type14')->withType(14)->withTokens($tok); }
	if($section_id == 15) {  return view('profile_forms.type15')->withType(15)->withTokens($tok); }
	if($section_id == 16) {  return view('profile_forms.type16')->withType(16)->withTokens($tok); }
	if($section_id == 17) {  return view('profile_forms.type17')->withType(17)->withTokens($tok); }
	if($section_id == 18) {  return view('profile_forms.type18')->withType(18)->withTokens($tok); }
	if($section_id == 19) {  return view('profile_forms.type19')->withType(19)->withTokens($tok); }
	if($section_id == 20) {  return view('profile_forms.type20')->withType(20)->withTokens($tok); }
	if($section_id == 21) {  return view('profile_forms.type21')->withType(21)->withTokens($tok); }
	if($section_id == 22) {  return view('profile_forms.type22')->withType(22)->withTokens($tok); }
	if($section_id == 23) {  return view('profile_forms.type23')->withType(23)->withTokens($tok); }
	if($section_id == 24) {  return view('profile_forms.type24')->withType(24)->withTokens($tok); }

	}

	public function deleteExperience(Req1 $request)
    {
        $profile_item_id  = $request->id;
        $deleteExperience = ProfileText::where('id', '=', $profile_item_id)
                                ->delete();
        return "Success";
    }

    public function saveTypeItem(Request $request)	//Save Experience Forms
	{
		$user = Auth::user();
		if (Auth::guest()) return '';
		$type = $request->type;
		$this_id = $_GET['id_type'.$type];
		
		$text = array(
		"f1" => $request->f1,
		"f2" => $request->f2,
		"f3" => $request->f3,
		"f4" => $request->f4,
		"f5" => $request->f5,
		"f6" => $request->f6,
		"f7" => $request->f7,
		"f8" => $request->f8,
		"f9" => $request->f9,
		);
		if($this_id == 0)
		{
			$profiletext = new ProfileText;
			$profiletext->user_id 			= $user->id;
			$profiletext->section_id 		= $type;
			$profiletext->text 				= json_encode($text);
			$profiletext->save();
		}
		else
		{
			ProfileText::where('user_id', $user->id)
						->where('section_id', $type)
						->update(['text' => json_encode($text)]);
		}
		return 1;	
	}

}