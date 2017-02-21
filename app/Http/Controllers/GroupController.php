<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

use App\Http\Requests;
use App\Model\User;
use App\Model\Group;
use App\Model\GroupMember;
use App\Model\GroupPost;
use App\Model\Newsfeed;
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
    	return view('group.index',compact('user','groupsCount','createdgroups','joinedgroups','request'));
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
		$addtogroup->user_id 		= $user->id;
		$addtogroup->save();


		//Add To Newsfeeds
		$newsfeeds = new Newsfeed;
		$newsfeeds->userid 			= $user->id;;
		$newsfeeds->type 			= "group_created";
		$newsfeeds->typeid 			= $getLastGroup->group_id;
		$newsfeeds->save();

		//Add Image to Group
		$image         			= $request->file('image1');
		if($request->hasFile('image1')) {
	        $imagename  = 'group'.$getLastGroup->group_id.'.jpg';
	        $path       = public_path('img/groups/' .$imagename);
	        Image::make($image->getRealPath())->save($path);

	        Group::where('group_id', $getLastGroup->group_id)
	            ->update(['group_image' => $imagename]);
        }
		return redirect()->back();
	}

	public function changeGroupImage(Request $request)	// Update Group Image 
	{
		$image         			= $request->file('image1');
		if($request->hasFile('image1')) {
	        $imagename  = 'group'.$request->group_id.'.jpg';
	        $path       = public_path('img/groups/' .$imagename);
	        Image::make($image->getRealPath())->save($path);

	        Group::where('group_id', $request->group_id)
	            ->update(['group_image' => $imagename]);
        }
		return redirect()->back();
	}

	public function updateGroupInfo(Request $request)	// Update Group Info
	{
		Group::where('group_id', $request->group_id)
            		->update(['group_name' => $request->group_name, 
            					'description' => $request->description,
            					'allow_join' => (int)$request->allow_join,
            					'allow_post_public' => (int)$request->allow_post_public
            					]);
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

		$groupposts 	= GroupPost::where('group_id', $request->id)
							->orderBy('id', 'desc')
							->get();

		$countMember 	= GroupMember::where('group_id', '=', $group_id)
							->count();

		foreach($groupposts as $grouppost){
			$grouppost->timeago = Carbon::now()->diffForHumans($grouppost->updated_at);
		}

		

		return view('group.groupdetail',compact('user','group','groupposts','countMember','request'));
	}

	public function addGroupPostImageSubmit(Request $request)		//Image Upload
	{
		//Upload Image
		$images_arr = array();
		foreach($_FILES['images']['name'] as $key=>$val){
			$image_name = $_FILES['images']['name'][$key];
			$tmp_name 	= $_FILES['images']['tmp_name'][$key];
			$size 		= $_FILES['images']['size'][$key];
			$type 		= $_FILES['images']['type'][$key];
			$error 		= $_FILES['images']['error'][$key];
	        $userfile_extn = explode(".", strtolower($image_name));
	        $rand = rand(500,1000000000);
	        $time = time();
	        $newFilename = $time."-".$rand.".".end($userfile_extn);
	        
			
	    	$target_file =  public_path('img/grouppost/' . $newFilename);
			if(move_uploaded_file($_FILES['images']['tmp_name'][$key],$target_file)){
				$images_arr[] = $target_file;
			}

		}

		//Generate images view
		if(!empty($images_arr))
		{
			$count=0;
			foreach($images_arr as $k=>$image_src){
			$count++;
			$id = str_replace("/","",substr($image_src, strrpos($image_src, '/')));
			?>

	          	<div class="imgContain" id="ssl<?php echo md5($id); ?>" onclick="$('#ssl<?php echo md5($id); ?>').remove()">
	     		<img class="grayscale" style="float: left;height: 70px;margin: 3px;width: 70px;border: 2px solid #ffffff;border-radius: 5px;" src="<?php echo asset('img/grouppost/' . $id) ; ?>" alt="">
	          	<div class="textHover" align="center"><img src="<?php echo asset('img/icons/trash.png'); ?>" border="0"></div>
	          	<input name="images_ids[]" type="hidden" value="<?php echo $id; ?>">
	          	</div>
			<?php 
			}
		}
	}

	public function groupPostSubmit(Request $request)		//Group Post Submit
	{
		$user 		= Auth::user();
		$user_id 			= $request->user_id;
        $group_id 			= $request->group_id;
        $post_get_images 	= $request->images_uploaded;
        $post_get_files 	= $request->files_uploaded;
        $post_text 			= $request->post_text;

        if ($post_text == "" && $post_get_images == "" && $post_get_files == "") {
            return 0;
            exit();
        }

        $groupposts = new GroupPost;
		$groupposts->group_id 			= $group_id;
		$groupposts->posted_by 			= $user->id;
		$groupposts->message 			= $post_text;
		$groupposts->images 			= $post_get_images;
		$groupposts->files 				= $post_get_files;
		$groupposts->type 				= 1;
		$groupposts->save();

		$getpost = GroupPost::where('posted_by', $user->id)
								->orderBy('id', 'desc')
								->first();



		$array = array(
            "post_id" 		=> $getpost->id,
            "user_id" 		=> $getpost->posted_by,
            "post_text" 	=> $getpost->message,
            "user_name" 	=> $user->name,
            "post_date" 	=> Carbon::now()->diffForHumans($getpost->updated_at),
            "user_image" 	=> $user->profile_pic,
            "post_images" 	=> $getpost->images,
            "post_files" 	=> $getpost->files,
            "group_id" 		=> $getpost->group_id,
            );

            return json_encode($array);
	}

	public function viewGroupMembers(Request $request)
	{
		$user 		= Auth::user();
		$members 	= GroupMember::where('group_id', $request->id)
							->orderBy('id', 'desc')
							->get();

		$group 		= Group::where('group_id', $request->id)
							->first();

		return view('group.groupmembers',compact('user','group','members','request'));					
	}
}
