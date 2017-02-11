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

class GroupController extends Controller
{
    public function groups(Request $request)		//Dashboard
	{
		$user = Auth::user();

		$groupsCount 	= GroupMember::where('user_id', $user->id)
							->count();

		$createdgroups 		= Group::where('group_admin_id', $user->id)
								->paginate(12);

		$joinedgroups		= GroupMember::where('user_id', $user->id)
								->Where('group_admin_id', '!=', $user->id )
								->join('groups', 'group_members.group_id', '=', 'groups.group_id')
								->paginate(12);
    	return view('groups',compact('user','groupsCount','createdgroups','joinedgroups','request'));
	}

	public function createGroup(Request $request)		//Dashboard
	{
		$user = Auth::user();
		$group = new Group;
		$group->group_name 			= $request->group_name;
		$group->group_admin_id 		= $user->id;
		$group->allow_join 			= (int)$request->allow_join;
		$group->description 		= $request->description;
		$group->allow_post_public 	= (int)$request->allow_post_public;
		$group->save();

		$getLastGroup = Group::orderBy('group_id','desc')->first();	//Get Inserted Id

		$addtogroup	= new GroupMember;
		$addtogroup->group_id 		= $getLastGroup->group_id;
		$addtogroup->user_id 		= $request->group_admin_id;
		$addtogroup->save();


		//Message to Newsfeed Waiting
		
		$image         			= $request->file('image1');
		// Add Group Profile
		if($request->hasFile('image1')) {
	        $imagename  = 'group'.$getLastGroup->group_id.'.jpg';
	        $path       = public_path('img/groups/' .$imagename);
	        Image::make($image->getRealPath())->save($path);

	        Group::where('group_id', $getLastGroup->id)
	            ->update(['group_image' => $imagename]);
        }
		return redirect()->back();
	}


	public function groupFollow(Request $request)		//Add Followers to Group (Ajax)
	{
		$user = Auth::user();
		$followuser	= new GroupMember;
		$hasMember 	= GroupMember::where('user_id', $user->id)
							->where('group_id', '=', $request->group_id)
							->count();

		if($hasMember == 0) {
			$followuser->group_id 		= $request->group_id;
			$followuser->user_id 		= $user->id;
			$followuser->save();
		}
		return "Success";
	}

	public function groupunFollow(Request $request)		//Remove Followers from Group (Ajax)
	{
		$user = Auth::user();
		$unfollowuser = GroupMember::where('group_id', '=', $request->group_id)
						->Where('user_id', '=', $user->id)
						->delete();

		return "Success";
	}

	public function groupDetail(Request $request)		//Details of Group
	{
		$user 		= Auth::user();
		$group_id 	= $request->id;
		
		$group 		= Group::where('group_id', $group_id)
							->first();

		$countMember 	= GroupMember::where('group_id', '=', $group_id)
							->count();

		//dd($group->groupmembers());

		return view('groupdetail',compact('user','group','countMember','request'));
	}
}
