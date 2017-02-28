<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

use App\Http\Requests;
use App\Model\User;
use App\Model\Group;
use App\Model\GroupMember;
use App\Model\Message;
use App\Model\Market;
use App\Model\Scholarship;
use App\Model\Internship;
use App\Model\Follower;
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

	public function search(Request $request)		//Dashboard
	{
		$user = Auth::user();
		$query = $_GET['query'];
		$search_type = $_GET['search_type'];

		$market= Market::where('status', '=', 1)
					->where('title', 'like', '%' .$query. '%')
					->orderBy('priority', 'asc')
					->orderBy('id', 'desc')
					->paginate(10);

		$marketCount = Market::where('status', '=', 1)
						->where('title', 'like', '%' .$query. '%')
						->orderBy('priority', 'asc')
						->orderBy('id', 'desc')
						->count();

		$students 	= User::where('user_role.role_id','=','2')
						->where('firstname', 'like', '%' .$query. '%')
						->join('user_role', 'users.id', '=', 'user_role.user_id')
						->orderBy('users.id', 'desc')
						->paginate(10);

		$studentsCount 	= User::where('user_role.role_id','=','2')
						->where('firstname', 'like', '%' .$query. '%')
						->join('user_role', 'users.id', '=', 'user_role.user_id')
						->orderBy('users.id', 'desc')
						->count();

		$teachers 	= User::where('user_role.role_id','=','3')
						->where('firstname', 'like', '%' .$query. '%')
						->join('user_role', 'users.id', '=', 'user_role.user_id')
						->orderBy('users.id', 'desc')
						->paginate(10);

		$teachersCount 	= User::where('user_role.role_id','=','3')
						->where('firstname', 'like', '%' .$query. '%')
						->join('user_role', 'users.id', '=', 'user_role.user_id')
						->orderBy('users.id', 'desc')
						->count();

		$schools 	= User::where('user_role.role_id','=','4')
						->where('name', 'like', '%' .$query. '%')
						->join('user_role', 'users.id', '=', 'user_role.user_id')
						->orderBy('users.id', 'desc')
						->paginate(10);

		$schoolsCount 	= User::where('user_role.role_id','=','4')
						->where('name', 'like', '%' .$query. '%')
						->join('user_role', 'users.id', '=', 'user_role.user_id')
						->orderBy('users.id', 'desc')
						->count();

		$groups 		= Group::orderBy('group_id', 'desc')
						->where('group_name', 'like', '%' .$query. '%')
						->paginate(10);

		$groupsCount 	= Group::orderBy('group_id', 'desc')
						->where('group_name', 'like', '%' .$query. '%')
						->count();

		$scholarships 	= Scholarship::where('status', '=', 1)
						->where('title', 'like', '%' .$query. '%')
						->orderBy('id', 'desc')
						->paginate(10);

		$scholarshipsCount = Scholarship::where('status', '=', 1)
							->where('title', 'like', '%' .$query. '%')
							->orderBy('id', 'desc')
							->count();

		$internships 	= Internship::where('status', '=', 1)
						->where('title', 'like', '%' .$query. '%')
						->orderBy('id', 'desc')
						->paginate(10);

		$internshipsCount = Internship::where('status', '=', 1)
							->where('title', 'like', '%' .$query. '%')
							->orderBy('id', 'desc')
							->count();

    	return view('search',compact('user','query','search_type','market','marketCount','students','studentsCount','teachers','teachersCount','schools','schoolsCount','groups','groupsCount','scholarships','scholarshipsCount','internships','internshipsCount','request'));
	}

	public function followers(Request $request)		//Followers
	{
		$user = Auth::user();
		$followings 	= Follower::where('follower_id', '=', $user->id)
						->orderBy('followers.id', 'desc')
						->get();
		$followers = Follower::where('followers.user_id', '=', $user->id)
						->orderBy('followers.id', 'desc')
						->get();

    	return view('followers',compact('user','followers','followings','request'));
	}

	public function getMessages(Request $request)		//Dashboard
	{
		$user = Auth::user();
		$messages = Message::where('sender_id', '=', $user->id)
								->orWhere('receiver_id', '=', $user->id)
								->groupBy('conv_id')
								->orderBy('id', 'desc')
								->get();

		foreach($messages as $message){
			$message->timeago = $message->updated_at->diffForHumans();
		}
    	return view('messages',compact('user','messages','request'));
	}

	public function getMessagesConversation(Request $request)		//Dashboard
	{
		$user = Auth::user();
		$messages = Message::where('conv_id', '=', $request->id)
								->orderBy('id', 'desc')
								->get();
		foreach($messages as $message){
			$message->timeago = $message->updated_at->diffForHumans();
		}
		if($user->id == $messages[0]->target_id AND $messages[0]->message_status == 0)
		{
			Message::where('conv_id', $request->id)
            		->update(['message_status' => 1]);
		}
    	return view('messageconversation',compact('user','messages','request'));
	}


	public function sendMessage(Request $request) // Send Message
	{
		$user = Auth::user();
		$sendMessage = new Message;
		$sendMessage->conv_id 			= $request->conv_id ? $request->conv_id : substr(hash('sha256', mt_rand() . microtime()), 0, 20);
		$sendMessage->sender_id 		= $request->sender_id ? $request->sender_id : $user->id;
		$sendMessage->receiver_id 		= $request->receiver_id ? $request->receiver_id :$request->to_id;
		$sendMessage->target_id 		= $request->to_id;
		$sendMessage->title 			= $request->title;
		$sendMessage->message 			= $request->message;
		$sendMessage->message_status 	= 0;
		$sendMessage->save();
		Session::flash('successMessage', 'Message Send Successfully');
		return redirect()->back();
	}

	public static function uploadFiles(Request $request){
		$path = base_path() . '/public/img/files/';
		$file = $request->file('file');

		$file1 = array();
		$file1['extension'] = $file->getClientOriginalExtension();
		$file1['name'] 		= $file->getClientOriginalName();
		$file1['mime'] 		= $file->getClientMimeType();
		$file1['path'] 		= dechex((int)(microtime(true)*10000)).md5($file->getClientOriginalName().$file->getSize()).dechex(rand());

		$filename = $file1['path'];

		$file1 = json_encode($file1);

	    $request->file('file')->move($path, $filename); //Upload File

		return $file1;
	}

	public function downloadFile($file) {

		$file = urldecode(base64_decode($file));
		$file = json_decode(json_decode($file,true),true)['files'][0];

	    $filename = $file['name'];
	    $fileext = $file['extension'];
	    $filemime = $file['mime'];
    	

    	$filepath = public_path('img/files/' . $file['path']);

    	return response()->download($filepath);
	}
	
}


