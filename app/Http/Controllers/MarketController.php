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
		dd($request);
		/*$user = Auth::user();
		$market = new Market;
		$market->title 				= $request->title;
		$market->category 			= $request->category;
		$market->description 		= $request->body;
		$market->author_name 		= $request->author;
		$market->price 				= $request->price;
		$market->discount 			= $request->discount;
		$market->priority 			= $request->priority;
		$market->images 			= "";
		$market->location 			= $request->location;
		$market->posted_by 			= $user->id;
		$market->email 				= $request->email;
		$market->phone 				= $request->phone;
		$market->address 			= $request->priority;
		$market->contact_visibility = (int)$request->show;
		$market->status 			= (int)$request->post_status;
		
		$market->save();*/
    	return view('addmarket',compact('user','request'));
	}

	public function addSubmit(Request $request)		//Dashboard
	{
		if($_POST['image_form_submit'] == 1)
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
		        
				
		    	$target_file =  public_path('img/books/' . $newFilename);
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
		     		<img class="grayscale" style="float: left;height: 70px;margin: 3px;width: 70px;border: 2px solid #ffffff;border-radius: 5px;" src="<?php echo asset('img/books/' . $id) ; ?>" alt="">
		          	<div class="textHover" align="center"><img src="<?php echo asset('img/trash.png'); ?>" border="0"></div>
		          	<input name="images_ids[]" type="hidden" value="<?php echo $id; ?>">
		          	</div>
				<?php 
				}
			}
		}
	}
}
