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
    public function marketplace(Request $request)		//Dashboard
	{
		$user = Auth::user();
		$market= Market::where('status', '=', 1)
							->orderBy('priority', 'asc')
							->orderBy('id', 'desc')
							->paginate(10);


		$latest 	= Market::where('status', '=', 1)
							->orderBy('id', 'desc')
							->paginate(8);

		$featured	= Market::where('status', '=', 1)
							->inRandomOrder()
							->paginate(8);					
    	return view('market.index',compact('user','market','latest','featured','request'));
	}

	public function productDetail(Request $request)		//Dashboard
	{
		$user = Auth::user();
		$id 	= $request->id;
		$item	= Market::where('id', '=', $id)
							->first();


						
    	return view('market.detail',compact('user','item','request'));
	}

    public function add(Request $request)		//Dashboard
	{
		$user = Auth::user();
    	return view('market.addmarket',compact('user','request'));
	}

	public function addSubmit(Request $request)		//Dashboard
	{
		
		$user = Auth::user();
		$market = new Market;
		$market->title 				= $request->title;
		$market->slug 				= seoUrl(trim($request->title));
		$market->category 			= $request->category;
		$market->description 		= $request->body;
		$market->author_name 		= $request->author;
		$market->price 				= $request->price;
		$market->discount 			= $request->discount;
		$market->priority 			= $request->priority;
		$market->images 			= $request->images_uploaded;
		$market->location 			= $request->location;
		$market->posted_by 			= $user->id;
		$market->email 				= $request->email;
		$market->phone 				= $request->phone;
		$market->address 			= $request->address;
		$market->contact_visibility = (int)$request->show;
		$market->status 			= (int)$request->post_status;
		$market->save();

    	return redirect()->route('myMarket');
	}

	public function addImageSubmit(Request $request)		//Dashboard
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
		          	<div class="textHover" align="center"><img src="<?php echo asset('img/icons/trash.png'); ?>" border="0"></div>
		          	<input name="images_ids[]" type="hidden" value="<?php echo $id; ?>">
		          	</div>
				<?php 
				}
			}
		}
	}

	public function myMarket(Request $request)		//Dashboard
	{
		$user = Auth::user();
		$mymarket 	= Market::where('posted_by', $user->id)
								->get();
    	return view('market.mymarket',compact('user','mymarket','request'));
	}

	public function edit(Request $request)		//Dashboard
	{
		
		$user = Auth::user();
		$mymarket 	= Market::where('posted_by', $user->id)
								->where('id', $request->id)
								->first();

		if(count($mymarket) == 0)
		{
			return response("Insufficient Permissions",404);
		}
    	return view('market.editmarket',compact('user','mymarket','request'));
	}

	public function editSubmit(Request $request)		//Dashboard
	{
		$user = Auth::user();
		Market::where('email', $user->email)
					->where('id', $request->post_id)
            		->update(['title' => $request->title, 'category' => $request->category, 'description' => $request->body, 'author_name' => $request->author, 'price' => $request->price, 'discount' => $request->discount, 'priority' => $request->priority, 'images' => $request->images_uploaded, 'location' => $request->location, 'phone' => $request->phone, 'address' => $request->address, 'contact_visibility' => (int)$request->show, 'status' => (int)$request->post_statuse]);

    	return redirect()->route('myMarket');
	}

	public function updateMarketStatus(Request $request)		//Dashboard
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
			Market::where('posted_by', $user->id)
					->where('id', $id)
            		->update(['status' => $status]);

            return "Status Sucessfully Updated";
		}
		return "Error Occured";

	}

		
}
