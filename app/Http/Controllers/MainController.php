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

	public function sendMessage(Request $request) // Send Message
	{
		$user = Auth::user();
		$sendMessage = new Message;
		$sendMessage->conv_id 			= substr(hash('sha256', mt_rand() . microtime()), 0, 20);
		$sendMessage->sender_id 		= $user->id;
		$sendMessage->receiver_id 		= $request->to_id;
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


