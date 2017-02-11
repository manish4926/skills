@extends('partials.sidebar')

@section('basecontent')

<!--Personal Logo and buttons-->
<div class="col-md-5 ">
	<img src="{{asset('img/groups/')}}/{{$group->group_image}}" style="border: 1px solid #e3e3e3;border-radius: 4px;">
	
	@if($group->group_admin_id == $user->id) 
	<div class="ProfileChangeImage" data-toggle="modal" data-target="#changeModal">
	   <img src="{{asset('img/icons/photos13.png')}}">&nbsp;<span class="opensans">Update Image</span>
	</div>

	<button data-toggle="modal" data-target="#updateModal" class="btn btn-sm btn-default ProfileChangeImage" style="border-radius: 3px;font-size: 13px;margin-top:6px;font-family: tahoma;"><i class="glyphicon  glyphicon-edit"></i> Update Group info</button>
	@else

	<button id="btnadd" class="btn btn-sm btn-success ProfileChangeImage" onclick="$post_follow()" type="button" style="border-radius: 3px;font-size: 13px;margin-top:6px;font-family: tahoma;"><i class="glyphicon glyphicon-plus"></i> Join This Group</button>

	<button id="btnremove" class="btn btn-sm btn-default ProfileChangeImage ProfileChangeImageActive" onclick="$post_unfollow()" type="button" style="border-radius: 3px;font-size: 13px;margin-top:6px;font-family: tahoma;"><i class="glyphicon glyphicon-check"></i> Leave This Group</button>
	@endif
	

	{{--<button class="btn btn-sm btn-default ProfileChangeImage" style="border-radius: 3px;font-size: 13px;margin-top:6px;font-family: tahoma;" onclick="$_startLogin('')">Login to join this group</button>--}}
		
</div>
<!--Personal Logo and buttons-->

<div class="col-md-7">
	<h3 class="opensans"><b>{{$group->group_name}}</b></h3>
	<p>{{$group->description}}</p>
	<h5 class="opensans profileGray"><a href="{{ url('/groups/members/') }}/{{ $group->group_id }}" title="click here to see the members of this group.">&nbsp;{{$countMember}} members in this group.</a></h5>
		<div align="center">
			<p class="opensans">
				@if($group->group_admin_id != $user->id) 
				<button class="btn btn-sm btn-default ProfileChangeImage" type="button" style="border-radius: 5px;font-size: 13px;height: 40px;margin-top: 6px;text-transform: uppercase;width: 248px;" data-toggle="modal" data-target="#myModalContact"><i class="glyphicon glyphicon-envelope"></i> SEND Message to group admin</button>
				@endif
			</p>
    	</div>
</div>

<div class="clearfix"></div>


<!-- Change Profile Image -->

<div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 {!! Form::open(['url' => '/groups/changegroupimage', 'id' => 'frmchange', 'files'=> true, 'form-horizontal', 'class' => '']) !!}
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Group Image</h4>
      </div>
      <div class="modal-body">
      	<div class="form-group">
        	<label>Select image from your PC:</label>
        	<input name="image1" type="file">
        	<input name="id" type="hidden" value="{{$group->group_id}}">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>

  </div>

   {!! Form::close() !!}

</div>

<!-- Modal -->


{!! Form::open(['url' => '/share', 'id' => 'frmpost', 'files'=> true, 'form-horizontal', 'class' => 'facebook-share-box']) !!}
	<input name="user_id" type="hidden" value="{{$user->id}}">
	<input name="newsfeed_id" type="hidden" value="{{$user->id}}">
	<input name="group_id" type="hidden" value="{{$group->group_id}}">
	<input name="images_uploaded" id="images_uploaded" type="hidden" value="">

	<div class="panel-body">
		<img class="img-circle postprofile" src="{{ asset('img/profile/blank.png')}}">
		<textarea name="post_text" cols="40" rows="10" id="status_message" class="form-control posttextarea" placeholder="Post Announcements to Followers"></textarea>
        <span class="notemessage">Note: You will be blocked for posting Lewd and Irrelevant Announcement</span>
    </div>
    <div class="panel-footer panel-footer2">
		<div class="form-group" style="float:right;">
			<button type="button" id="mypostbutton" onclick="do_it()" class="btn btn-success" style="background-color: #29af97;"><i class="glyphicon glyphicon-share-alt"></i> &nbsp; Post &nbsp;</button>
		</div>
		<div class="btn-group" style="float:left;">
			<a href="" class="btn btn-default"  onclick="document.getElementById('images').click(); return false" style="margin-right: 5px;"><i style="font-size: 18px;" class="glyphicon glyphicon-camera"></i></a>

			<input type="hidden" name="files_uploaded" id="__files_uploaded" value="">
			<!-- File Upload -->
			<input type="file" class="upload-file-input" id="__files" onchange="filesChanged()" style="float: left; visibility: hidden; max-width: 0;" multiple>

			<a href="" class="btn btn-default upload-icon-a" onclick="uploadButtonPressed(); return false;"  style="float: left; margin-right: 15px;"><i style="font-size: 18px;" class="glyphicon glyphicon-upload"></i></a>

			<div class="gallery" id="images_preview" style="float: left;margin-left: 100px;margin-top: -46px;width: 373px; position: relative;">
			</div>
			<div id="__filescontent" style="max-width: 700px; float: left;"></div>
			<div class="clear clearfix"></div>
			<!-- End File Upload -->
		</div>
		<div class="gallery postimageuploadicon" id="images_preview"></div>
		<div class="clear clearfix"></div>
		<span class="notemessage">Note: Don't Share any documents leading to Copy Right Issues.</span>



	</div>
{!! Form::close() !!}

<!--IMAGE UPLOAD-->
<div class="upload_div">
{!! Form::open(['url' => '/upimages', 'id' => 'multiple_upload_form' , 'name' => 'multiple_upload_form', 'files'=> true, 'form-horizontal', 'class' => 'facebook-share-box']) !!}
	<input type="hidden" name="image_form_submit" value="1"/>
    <input type="file" name="images[]" accept=".jpg, .jpeg, .png"  id="images" style="visibility: hidden; width: 1px; height: 1px"  multiple >
	<div class="uploading none" style="display:none;">
	    <img src="{{asset('img/ajax-loader.gif')}}"/>
	</div>
{!! Form::close() !!}
</div>

<!--IMAGE UPLOAD-->




<!-- Update Group -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
{!! Form::open(['url' => '/groups/updategroup', 'id' => 'frmchange', 'files'=> true, 'form-horizontal', 'class' => '']) !!}
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="myModalLabel">Update Group Info</h4>
	      	</div>
		    <div class="modal-body">
		        <div class="form-group">
		        	<label>Group Name</label>
		        	<input name="group_name" type="text" value="{{$group->group_name}}" class="form-control">
		      	</div>
		       	<div class="form-group">
		        	<label>Group Description</label>
		        	<textarea name="description" rows=5 cols=20 class="form-control">{{$group->description}}</textarea>
		      	</div>

				<div class="form-group">
		        	<label>Allow users to join the group without confirm?</label>
		        	<input name="allow_join" type="checkbox" value="1" <?php if($group->allow_join == "1") { echo "checked"; } ?> >
		      	</div>

		        <div class="form-group">
			        <label>Allow group users to add posts without review?</label>
			        <input name="allow_post_public" type="checkbox" value="1" <?php if($group->allow_post_public == "1") { echo "checked"; } ?>>
		    	</div>
		        <input name="id" type="hidden" value="{{$group->group_id}}">
		    </div>

		    <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary">Save changes</button>
		    </div>
		</div>
	</div>
{!! Form::close() !!}
</div>

<!-- Modal -->

@push('topscripts')
<script language="javaScript" type="text/javascript">

getnewsfeed();

$('#myModal').on('hidden.bs.modal', function () {
closeshare();
})


function getnewsfeed()
{
	var url = "{{ url('/getgroupnewsfeed') }}/{{$group->group_id}}";
	console.log(url);

	$.get( url, function( data ) {
		var newsfeed = JSON.parse(data);

		if(newsfeed == "")
		{
			$("#newsfeedposts").html('');
		}
		jQuery.each(newsfeed, function(i, val) {

            built_post(val.post_id,val.user_name,val.user_image,val.user_id,val.post_text,val.post_date,val.post_type,val.post_images,val.other_name,val.other_id,val.is_like,'','',val.other_image,val.other_date,val.post_text_new,val.likescount,val.post_files);

              });
});

    setTimeout(getnewsfeed, 4000);
}

getnewsfeed();


function do_it()
{
	var url = "{{ url('/postinggroup') }}";
    var values = $("input[name='images_ids[]']").map(function(){return $(this).val();}).get();
    $("#images_uploaded").val(""+values+"");

    $.ajax({
        type: "POST",
        url: url,
        data: $("#frmpost").serialize(), // serializes the form's elements.
        success: function(data)
        {
	        obj = JSON.parse(data);
            $("#status_message").val('');
            $("#images_uploaded").val('');
            $("#__files_uploaded").val('');
            $("#images_preview").html('');
            $("#__filescontent").html('');
	        try{
                fileUploader.removeAllDownloaded();
            }

            catch(e){
            }

	        if(obj != 0) {
                built_post(obj.post_id,
                obj.user_name,
                obj.user_image,
                obj.user_id,
                obj.post_text,
				obj.post_date,
                obj.post_type,
                obj.post_images,
                '',
                '',
                0,
                obj.group_id,
                '',
                '',
                '',
                '',
                '',
                obj.post_files);
            }
        }
    });
}


function timeConverter(UNIX_timestamp){
	var a = new Date(UNIX_timestamp * 1000);
	var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
	var year = a.getFullYear();
	var month = months[a.getMonth()];
	var date = a.getDate();
	var hour = a.getHours();
	var min = a.getMinutes();
	var sec = a.getSeconds();
	var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
	return time;
}

function _deletePost(post_id)
{
    var url = "{{ url('/deleteposting/') }}/"+post_id;
	$.get( url, function( data ) {
	    if(data == '1')
	    {
	        location.reload();
	    }
	});
}

function _reportPost(post_id)
{
    var url = "{{ url('/reportposting/') }}/"+post_id;
	$.get( url, function( data ) {
        if(data == '1')
        {
            alert("Thank you for your report. We will check this post asap.");
        }
	});
}

function buildAttachements(post_files){
    post_files=post_files['files'];
    var addFilesBody="";
    post_files.forEach(function(entry) {
        addFilesBody+='<div style="float:left; margin-left: 10px;"><a target="_blank" href="/download?file='+entry['path']+'&mime='+entry['mime']+'&name='+entry['name']+'" style="color: #777777; font-size: 13px; font-weight: bold;">' +
            '<img src="/img/icons/blank.jpg" style="width: 18px; height: 18px; margin-right: 5px; margin-top: -5px;"/>'+entry['name']+'</a></div><br/>';

    });
return addFilesBody;
}

function built_post(post_id,user_name,user_image,user_id,post_text,post_date,post_type,post_images,other_name,other_id,is_like,group_id,group_name,other_image,other_date,shared_text,likes_count,post_files){
    var addFilesBody="";
    //console.log(post_files);
    if (post_files!=null){
	    try{
	        post_files=JSON.parse(post_files);
            addFilesBody=buildAttachements(post_files);
        }catch(e){
            //alert(e);
            //console.log(post_files);
            //alert(e);
        }
}

var post_data;
var addphotostext;
var addphotosBody = "";
var like_options;
var like_text;
var option_links;

if(user_id == "{{$user->id}}")
{
	option_links = "<li><a href='#' onclick='_deletePost("+post_id+")'>Delete</a></li>";
}
else
{
	option_links = "<li><a href='#' onclick='_reportPost("+post_id+")'>Report</a></li>";
}



if($("#post" + post_id).length == 0) {
	if(is_like == 1)
	{
		like_options = "onclick='do_unlike("+post_id+")' id='unlike"+post_id+"'";
		like_text = "Irrelevant";
    }
    else
	{
	    like_options = "onclick='do_like("+post_id+")' id='like"+post_id+"'";
        like_text = "Relevant";
    }
	if(post_images.length != 0)
    {        
    	if(post_images.length == 1)
        {
        	addphotostext = "<span>Added a new photo.</span>";
            jQuery.each(post_images, function(i, val) {
            addphotosBody = "<span><img class='img-thumbnail img-responsive' style='' src='{{asset('uploads/posts/large')}}/"+val.image_key+"' border='0'></span>";
            });
        }
        else if(post_images.length == 2)
        {            
        	addphotostext = "<span>Added "+post_images.length+" new photos.</span>";
            jQuery.each(post_images, function(i, val) {
            addphotosBody = addphotosBody + "<span><img class='img-thumbnail img-responsive' style='height:250px;width:250px;float:left;margin-left:5px;' src='{{asset('uploads/posts/large')}}/"+val.image_key+"' border='0'></span>";
			});
        }
        else
        {
	        jQuery.each(post_images, function(i, val) {
			addphotosBody = addphotosBody + "<span><img class='img-thumbnail img-responsive' style='height:130px;width:130px;float:left;margin-left:7px;' src='{{asset('uploads/posts/large')}}/"+val.image_key+"' border='0'></span>";
            });
            addphotostext = "<span>Added "+post_images.length+" new photos.</span>";
        }
    }
    else
    {          
    	addphotostext = "";
        addphotosBody = "";
    }

    if(post_type == 11)
    {
        post_data = "<br /><div class=' profile-content' id='post"+post_id+"'>             <div class='panel-default panel-google-plus' style='box-shadow:0px;'>                 <div class='panel-heading'>                   <img class='pull-left' style='width:48px;height:48px;' src='{{asset('uploads/profile_pics_small')}}/"+user_image+"' />                     <h5><a href='{{url('/profile/u')}}"+user_id+"'>"+user_name+"</a> Started to Follow <a href='{{url('/profile/u')}}"+other_id+"'>"+other_name+"</a></h5>                      <h5><span class='timeago' title='"+post_date+"'>"+post_date+"</span></h5>                 </div>             </div></div>";
    }
    else if(post_type == 22)
    {
        post_data = "<br /><div class=' profile-content' id='post"+post_id+"'>             <div class='panel-default panel-google-plus' style='box-shadow:0px;'>                 <div class='panel-heading'>                   <img lass='pull-left' style='width:48px;height:48px;' src='{{asset('uploads/profile_pics_small')}}/"+user_image+"' />                     <h5><a href='{{url('/profile/u')}}"+user_id+"'>"+user_name+"</a> Joined the group.</h5>                      <h5><span class='timeago' title='"+post_date+"'>"+post_date+"</span></h5>                 </div>             </div></div>";
    }
    else if(post_type == 23)
    {
        post_data = "<br /><div class=' profile-content' id='post"+post_id+"'>             <div class='panel-default panel-google-plus'>                 <div class='panel-heading'>                   <img class='pull-left' style='width:48px;height:48px;' src='{{asset('uploads/profile_pics_small')}}/"+user_image+"' />                     <h5><a href='{{url('/profile/u')}}"+user_id+"'>"+user_name+"</a> Created the group.</h5>                      <h5><span class='timeago' title='"+post_date+"'>"+post_date+"</span></h5>                 </div>             </div></div>";

	}

    else if(post_type == 6)
	{        	
		post_data = "<br /><div class=' profile-content' id='post"+post_id+"'>             <div class='panel-default panel-google-plus' style='box-shadow:0px;'>               <div class='dropdown'>  				 <span class='dropdown-toggle btn' type='button' id='dropdownMenu"+post_id+"' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>				 <span class='glyphicon glyphicon-chevron-down'></span>				 </span>				  <ul class='dropdown-menu' style='margin-top: -7px;' aria-labelledby='dropdownMenu"+post_id+"'>				   "+option_links+" 				  </ul>				</div>                <div class='panel-heading'>                   <img class='pull-left' style='width:48px;height:48px;' src='{{asset('uploads/profile_pics_small')}}/"+user_image+"' />                     <h5><a href='{{url('/profile/u')}}"+user_id+"'>"+user_name+"</a> Relevant <a href='{{url('/profile/u')}}"+other_id+"'>"+other_name+"</a> Post.</h5>                      <h5><span class='timeago' title='"+post_date+"'>"+post_date+"</span></h5>                 </div>                    <div class='panel-body' style='border: 1px solid #d4d4d4;color: #aaaaaa;margin: -4px 15px 9px;padding: 16px;'>                     <div class='panel-default panel-google-plus' style='box-shadow:0px;padding:0px'>                 <div class='panel-heading' style=' margin-left: -14px;margin-top: -14px;'>                   <img class='pull-left' style='width:48px;height:48px;' src='{{asset('uploads/profile_pics_small')}}/"+other_image+"' />                     <h5><a href='{{url('/profile/u')}}"+other_id+"'>"+other_name+"</a></h5>                      <h5><span class='timeago' title='"+post_date+"'>"+other_date+"</span></h5>                 </div>                   </div>                      <p id='emo"+post_id+"'>"+post_text+"</p> "+addphotosBody+"                 </div>            </div></div>";

           //alert(addphotosBody);
    }

	else if(post_type == 21)
    {

    	// console.log(" files  json type is ok");
      	post_data = "<br /><div class=' profile-content' id='post"+post_id+"'>             <div class='panel-default panel-google-plus' style='box-shadow:0px;'>               <div class='dropdown'>  				 <span class='dropdown-toggle btn' type='button' id='dropdownMenu"+post_id+"' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>				 <span class='glyphicon glyphicon-chevron-down'></span>				 </span>				  <ul class='dropdown-menu' style='margin-top: -7px;' aria-labelledby='dropdownMenu"+post_id+"'>				   "+option_links+" 				  </ul>				</div>                <div class='panel-heading' id='sharea_"+post_id+"'>                   <img class='pull-left' style='width:48px;height:48px;' src='{{asset('uploads/profile_pics_small')}}/"+user_image+"' />                     <h5><a href='{{url('/profile/u')}}"+user_id+"'>"+user_name+"</a> Posted in the group.</h5>                      <h5><span class='timeago' title='"+post_date+"'>"+post_date+"</span></h5>                 </div>                    <div class='panel-body' id='shareb_"+post_id+"' style='border: 1px solid #d4d4d4;border-radius: 3px;color: #aaaaaa;margin: 15px;padding: 16px;'>                    <p id='emo"+post_id+"'>"+post_text+"</p> "+addphotosBody+"                 </div>                 <div id='files"+post_id+"' style='float: top; margin-top: 15px; '>"+addFilesBody+"</div><br/><br/>                    <div class='panel-footer' style='float:bottom;'>                    <a style=' border-bottom: 1px solid #29af97;cursor: pointer;font-family: tahoma;font-size: 12px;' type='button' "+like_options+"> "+like_text+" </a>                       - <a style=' border-bottom: 1px solid #29af97;cursor: pointer;font-family: tahoma;font-size: 12px;' type='button' data-toggle='modal' data-target='#myModal' onclick='sharethis("+post_id+")' class=''> Forward</a>                    - <a style=' border-bottom: 1px solid #29af97;cursor: pointer;font-family: tahoma;font-size: 12px;' type='button' onclick='show_comment_box("+post_id+")' class=''> Comment </a>                  </div>                 <div align='left'><span style='color:#29af97;' class='pull-left commentleft'><img src='{{asset('layout/images/comment.jpg')}}' border='0'>&nbsp;<span id='likes"+post_id+"' style='font-size: 12px; text-transform: none;'>"+likes_count+"</span></span><span style='color:#29af97;' onclick='show_comment_box("+post_id+")' class='pull-right commentright'>View All Comments</div>                 <div class='clear clearfix'></div><div id='comments_"+post_id+"'></div>           </div></div>";

    }
    else if(post_type == 7)
    {
	       	post_data = "<br /><div class=' profile-content' id='post"+post_id+"'>             <div class='panel-default panel-google-plus' style='box-shadow:0px;'>               <div class='dropdown'>  				 <span class='dropdown-toggle btn' type='button' id='dropdownMenu"+post_id+"' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>				 <span class='glyphicon glyphicon-chevron-down'></span>				 </span>				  <ul class='dropdown-menu' style='margin-top: -7px;' aria-labelledby='dropdownMenu"+post_id+"'>				   "+option_links+" 				  </ul>				</div>                <div class='panel-heading'>                   <img class='pull-left' style='width:48px;height:48px;' src='{{asset('uploads/profile_pics_small')}}/"+user_image+"' />                     <h5><a href='{{url('/profile/u')}}"+user_id+"'>"+user_name+"</a> Forwarded <a href='{{url('/profile/u')}}"+other_id+"'>"+other_name+"</a> Post.</h5>                      <h5><span class='timeago' title='"+post_date+"'>"+post_date+"</span></h5>                 </div>                           <div class='panel-body' style='border: 1px solid #d4d4d4;color: #aaaaaa;margin: -4px 15px 9px;padding: 16px;'>                     <div class='panel-default panel-google-plus' style='box-shadow:0px;padding:0px'>                 <div class='panel-heading' style=' margin-left: -14px;margin-top: -14px;'>                   <img class='pull-left' style='width:48px;height:48px;' src='{{asset('uploads/profile_pics_small')}}/"+other_image+"' />                     <h5><a href='{{url('/profile/u')}}"+other_id+"'>"+other_name+"</a></h5>                      <h5><span class='timeago' title='"+post_date+"'>"+other_date+"</span></h5>                 </div>                   </div>                   <p id='emo"+post_id+"'>"+post_text+"</p> "+addphotosBody+"                 </div>               <div class='panel-footer'>                    <a style=' border-bottom: 1px solid #29af97;cursor: pointer;font-family: tahoma;font-size: 12px;' type='button' "+like_options+"> "+like_text+" </a>                       - <a style=' border-bottom: 1px solid #29af97;cursor: pointer;font-family: tahoma;font-size: 12px;' type='button' data-toggle='modal' data-target='#myModal' onclick='sharethis("+post_id+")' class=''> Forward</a>                    - <a style=' border-bottom: 1px solid #29af97;cursor: pointer;font-family: tahoma;font-size: 12px;' type='button' onclick='show_comment_box("+post_id+")' class=''> Comment </a>                  </div>                 <div align='left'><span style='color:#29af97;' class='pull-left commentleft'><img src='{{asset('layout/images/comment.jpg')}}' border='0'>&nbsp;<span id='likes"+post_id+"' style='font-size: 12px; text-transform: none;'>"+likes_count+"</span></span><span style='color:#29af97;' onclick='show_comment_box("+post_id+")' class='pull-right commentright'>View All Comments</div>                 <div class='clear clearfix'></div><div id='comments_"+post_id+"'></div>           </div></div>";

    }
    else
    {
		   	post_data = "<br /><div class=' profile-content' id='post"+post_id+"'>             <div class='panel-default panel-google-plus' style='box-shadow:0;'>                  <div class='dropdown'>  				 <span class='dropdown-toggle btn' type='button' id='dropdownMenu"+post_id+"' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>				 <span class='glyphicon glyphicon-chevron-down'></span>				 </span>				  <ul class='dropdown-menu' style='margin-top: -7px;' aria-labelledby='dropdownMenu"+post_id+"'>				   "+option_links+" 				  </ul>				</div>                <div class='panel-heading' id='sharea_"+post_id+"'>                   <img class='pull-left' style='width:48px;height:48px;' src='{{asset('uploads/profile_pics_small')}}/"+user_image+"' />                     <h5><a href='{{url('/profile/u')}}"+user_id+"'>"+user_name+"</a>  "+addphotostext+"</h5>                        <h5><span class='timeago' title='"+post_date+"'>"+post_date+"</span></h5>                 </div>                  <div class='panel-body' id='shareb_"+post_id+"'>                    <p id='emo"+post_id+"'>"+post_text+"</p> "+addphotosBody+"                  <div id='files"+post_id+"' style='float: left; margin-top: 15px; display:inline-block;'>"+addFilesBody+"</div>                </div>                 <div class='panel-footer'>                    <a style=' border-bottom: 1px solid #29af97;cursor: pointer;font-family: tahoma;font-size: 12px;' type='button' "+like_options+"> "+like_text+" </a>                       - <a style=' border-bottom: 1px solid #29af97;cursor: pointer;font-family: tahoma;font-size: 12px;' type='button' data-toggle='modal' data-target='#myModal' onclick='sharethis("+post_id+")' class=''> Forward</a>                    - <a style=' border-bottom: 1px solid #29af97;cursor: pointer;font-family: tahoma;font-size: 12px;' type='button' onclick='show_comment_box("+post_id+")' class=''> Comment </a>                  </div>                <div align='left'><span style='color:#29af97;' class='pull-left commentleft'><img src='{{asset('layout/images/comment.jpg')}}' border='0'>&nbsp;<span id='likes"+post_id+"' style='font-size: 12px; text-transform: none;'>"+likes_count+"</span></span><span style='color:#29af97;' onclick='show_comment_box("+post_id+")' class='pull-right commentright'>View All Comments</div>                   <div class='clear clearfix'></div><div id='comments_"+post_id+"' style=''></div>           </div></div>";

	}

	$("#newsfeedposts").after('<input name="posts_id[]" type="hidden" value="'+post_id+'">'+post_data).hide();
	$("#post" + post_id).fadeIn(2000);

    //jQuery("span.timeago").timeago();

    $('#comments_'+post_id).html('<div id="formcomment_'+post_id+'" style="padding:10px;"><input id="commentform_'+post_id+'" onkeydown="if (event.keyCode == 13) { do_comment('+post_id+'); return false; }" class="form-control" style="border-radius: 0;font-size: 12px;width: 100%;" placeholder="Write your comment." type="text" value=""> </div>');

        //show_comment_box(post_id);

         $('#emo'+ post_id).emoticonize();

    }
}



function do_like(post_id)
{
var url = "{{ url('/likeposting/') }}/"+post_id;

$.get( url, function( data ) {
	if(data != '0')
    {
        $('#like'+post_id).text('');
        $('#likes'+post_id).text(data);
        $('#like'+post_id).append("Irrelevant");
        $('#like'+post_id).prop('onclick',null).off('click');
        $('#like'+post_id).attr('id','unlike'+post_id);
        $('#unlike'+post_id).bind("click", function(){ do_unlike(post_id); });
    }
});
}


function do_unlike(post_id)
{
var url = "{{ url('/unlikeposting/') }}/"+post_id;
$.get( url, function( data ) {
if(data != '0')
{
	$('#unlike'+post_id).text('');
	$('#likes'+post_id).text(data);
	$('#unlike'+post_id).append('Relevant');
	$('#unlike'+post_id).prop('onclick',null).off('click');
	$('#unlike'+post_id).attr('id','like'+post_id);
	$('#like'+post_id).bind("click", function(){ do_like(post_id); });
}
});
}

function sharethis(id)
{     
	$('#share_id').val(id);
	var a = $('#sharea_'+id).html();
	var b = $('#shareb_'+id).html();
	$('#share_cont_a').html(a);
	$('#share_cont_b').html(b);
}

function do_share()
{
	var url = "{{ url('/shareposting/') }}/"+$('#share_id').val()+"/"+escape($('#subtext').val());
	$.get( url, function( data ) {
		if(data == '1')
	    {
			$('#share_cont_a').html('');
			$('#share_cont_b').html('');
			$('#subtext').val('');
			$('#subtext').css('display','none');
			$('#sharebtn').css('display','none');
			$('#share_cont_a').html('<h5>Thank you! the post has been forwarded to your newsfeed.</h5>');
	    }
	});
}



function closeshare()
{
	$('#subtext').val('');
	$('#subtext').css('display','block');
	$('#sharebtn').css('display','inline');
}

function getLastCommentsCompiler()
{
	var values = $("input[name='posts_id[]']").map(function(){return $(this).val();}).get();
	var url = "{{ url('/getcommentscompiler/') }}/0,"+values;
	$.get( url, function( data ) {
		comments = JSON.parse(data);
		jQuery.each(comments, function(i, val) {
		if($("#commentelemnt_" + val.comment_id).length == 0)
		{
			$('#formcomment_'+val.post_id).before('<div id="commentelemnt_'+val.comment_id+'" style="border-bottom: 1px solid #efeeee;margin: 5px 0 0 9px;padding-bottom: 2px;"> <img style="border: 1px solid #e7e7e7;float: left;height: 40px;margin-right: 10px;margin-top: -1px;width: 40px;;" src="{{asset('uploads/profile_pics_small')}}/'+val.comment_user_image+'"> <p><b class="list-group-item-heading">'+val.comment_user_name+'</b> <span style="font-size: 12px;" class="list-group-item-text">'+val.comment_text+'</span></p><p style="margin-top: -12px;"><span class="timeago commenttime" title="'+val.comment_time+'">'+val.comment_time+'</span></p></div>');
	    }
		});
	});

//jQuery("span.timeago").timeago();
setTimeout(getLastCommentsCompiler, 10000);
}

getLastCommentsCompiler();


function getComments(id)
{
	var url = "{{ url('/getcomments/') }}/"+id;
	$.get( url, function( data ) {
	comments = JSON.parse(data);
	jQuery.each(comments, function(i, val) {
	if($("#commentelemnt_" + val.comment_id).length == 0)
    {
	    $('#formcomment_'+id).before('<div id="commentelemnt_'+val.comment_id+'" style="border-bottom: 1px solid #efeeee;margin: 5px 0 0 9px;padding-bottom: 2px;"> <img style="border: 1px solid #e7e7e7;float: left;height: 40px;margin-right: 10px;margin-top: -1px;width: 40px;;" src="{{asset('uploads/profile_pics_small')}}/'+val.comment_user_image+'"> <p><b class="list-group-item-heading">'+val.comment_user_name+'</b> <span style="font-size: 12px;" class="list-group-item-text">'+val.comment_text+'</span></p><p style="margin-top: -12px;"><span class="timeago commenttime" title="'+val.comment_time+'">'+val.comment_time+'</span></p></div>');				 	 
	}
	//jQuery("span.timeago").timeago();
 	});
	});
setTimeout(function() { getComments(id) }, 5000);
}


function do_comment(id)
{
	var textcomment = $('#commentform_'+id).val();
	var url = "{{ url('/commentposting/') }}/"+id+"?commentText="+$('#commentform_'+id).val();
	$.get( url, function( data ) {
		comments = JSON.parse(data);
		if(comments.res == '1')
		{
			$('#commentform_'+id).val("");
			$('#formcomment_'+id).before('<div id="commentelemnt_'+comments.this_id+'" style="border-bottom: 1px solid #efeeee;margin: 5px 0 0 9px;padding-bottom: 2px;"> <img style="border: 1px solid #e7e7e7;float: left;height: 40px;margin-right: 10px;margin-top: -1px;width: 40px;;" src="{{asset('uploads/profile_pics_small')}}/{{$user->account_image}}"> <p><b class="list-group-item-heading">{{$user->first_name}} {{$user->last_name}}</b> <span style="font-size: 12px;" class="list-group-item-text">'+textcomment+'</span></p><p style="margin-top: -12px;"><span class="commenttime">Just Now</span></p></div>');
		}

	});
}


function show_comment_box(id)
{
	getComments(id);
}

var isUploadingImages=false;

function changePostButtonState(){
    var isUploadingFiles=false;
    alert('test');
    try{
        isUploadingFiles=__isUploadingFiles;
    }
    catch(e){
    }

    if (isUploadingImages || isUploadingFiles ){
        $("#mypostbutton").prop('disabled', true);
        $('.uploading').show();
    }

    else{
        $('.uploading').hide();
        $("#mypostbutton").prop('disabled', false);
    }
}

$(document).ready(function(){
	alert('m');
	$('#images').on('change',function(){
		
		$('#multiple_upload_form').ajaxForm({
			target:'#images_preview',
			beforeSubmit:function(e){
                isUploadingImages=true;
                changePostButtonState();
			},
			success:function(e){
                isUploadingImages=false;
                changePostButtonState();
			},
			error:function(e){
			}
		}).submit();

	});

});
</script>
@endpush
@endsection