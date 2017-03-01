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
	<h5 class="opensans profileGray"><a href="{{ route('viewGroupMembers', ['id' => $group->group_id ]) }}" title="click here to see the members of this group.">&nbsp;{{$countMember}} members in this group.</a></h5>
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
 {!! Form::open(['route' => 'changeGroupImage', 'id' => 'frmchange', 'files'=> true, 'form-horizontal', 'class' => '']) !!}
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

<!-- End Modal -->


{!! Form::open(['id' => 'frmpost', 'files'=> true, 'form-horizontal', 'class' => '']) !!}
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
			<a id="mypostbutton" onclick="do_it()" class="btn btn-success" style="background-color: #29af97;"><i class="glyphicon glyphicon-share-alt"></i> &nbsp; Post &nbsp;</a>
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
    <div id="groupposts">
        @foreach($groupposts as $grouppost)
        <div class="panel-default panel-google-plus" style="box-shadow:0; margin-top: 10px;">                 
            <div class="dropdown" style="float: right;">                   
                <span class="dropdown-toggle btn" type="button" id="dropdownMenu2540" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">                 
                    <span class="glyphicon glyphicon-chevron-down"></span>              
                </span>                  
                <ul class="dropdown-menu" style="margin-top: -7px;" aria-labelledby="dropdownMenu2540">
                    @if($user->id == $group->group_admin_id OR $user->id == $grouppost->posted_by)
                    <li><a onclick="_deletePost({{ $grouppost->id }})">Delete</a></li>
                    @endif
                </ul>             
            </div>                
            <div class="panel-heading" id="sharea_{{ $grouppost->id }}">                   
                <img class="pull-left" style="width:48px;height:48px;" src="{{ asset('img/profile/'.$grouppost->getUser()->profile_pic) }}">                     
                <h5><a href="#">{{ $grouppost->getUser()->name}}</a>  
                <span>Added 2 new photos.</span></h5>                        
                <h5><span class="timeago">{{ $grouppost->timeago }}</span></h5>           
            </div>                  
            <div class="panel-body" id="shareb_2540">                    
                <p id="emo2540">{{ $grouppost->message }}</p> 
                @if(!empty($grouppost->images))
                @foreach($images = explode(",", $grouppost->images) as $image)
                <span>
                    <img class="img-thumbnail img-responsive" style="height:250px;width:250px;float:left;margin-left:5px;" src="{{ asset('img/grouppost/'.$image) }}" border="0">
                </span>
                @endforeach
                @endif
                @if(!empty($grouppost->files))
                <?php $file = json_decode($grouppost->files,true); 
                if(isset($file['files']))
                {
                    $filename = $file['files'][0]['name'];
                }
                else {
                    $filename = "Download";
                }
                ?>
                <div class="col-md-12">
                <div id="files2540" style="float: left; margin-top: 15px; display:inline-block;"><a  href="{{ route('downloadFile', ['file' => urlencode(base64_encode($grouppost->files))]) }}">{{$filename}}</a></div>      
                </div>
                @endif
            </div>                 
            <div class="panel-footer">                    
                <a style=" border-bottom: 1px solid #29af97;cursor: pointer;font-family: tahoma;font-size: 12px;" type="button" data-toggle="modal" data-target="#myModal" onclick="sharethis({{ $grouppost->id }})" class=""> Forward</a> - 
                <a style=" border-bottom: 1px solid #29af97;cursor: pointer;font-family: tahoma;font-size: 12px;" type="button" onclick="show_comment_box({{ $grouppost->id }})" class=""> Comment </a>                  
            </div>                
            <div align="left"><span style="color:#29af97;" class="pull-left commentleft"><img src="http://educonnectin.com/layout/images/comment.jpg" border="0">&nbsp;<span id="likes" style="font-size: 12px; text-transform: none;"></span></span><span style="color:#29af97;" onclick="show_comment_box({{ $grouppost->id }})" class="pull-right commentright">View All Comments</span></div>       
            <div class="clear clearfix"></div>
            <div id="comments_" style="">
                <div id="formcomment_" style="padding:10px;">
                <input id="commentform_" onkeydown="if (event.keyCode == 13) { do_comment({{ $grouppost->id }}); return false; }" class="form-control" style="border-radius: 0;font-size: 12px;width: 100%;" placeholder="Write your comment." type="text" value=""> 
                </div>
            </div>           
        </div>
        @endforeach
    </div>


<!--IMAGE UPLOAD-->
<div class="upload_div">
{!! Form::open(['route' => 'addGroupPostImageSubmit', 'id' => 'multiple_upload_form' , 'name' => 'multiple_upload_form', 'files'=> true, 'form-horizontal', 'class' => 'facebook-share-box']) !!}
	<input type="hidden" name="group_id" value="{{ $group->group_id }}"/>
    <input type="file" name="images[]" accept=".jpg, .jpeg, .png"  id="images" style="visibility: hidden; width: 1px; height: 1px"  multiple >
	<div class="uploading none" style="display:none;">
	    <img src="{{asset('img/ajax-loader.gif')}}"/>
	</div>
{!! Form::close() !!}
</div>

<!--IMAGE UPLOAD-->




<!-- Update Group -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
{!! Form::open(['route' => 'updateGroupInfo', 'id' => 'frmchange', 'files'=> true, 'form-horizontal', 'class' => '']) !!}
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
		        <input type="hidden" name="group_id" value="{{ $group->group_id }}"/>
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

<!-- Modal -->

<div class="modal fade" id="forwardpost" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    {!! Form::open(['route' => 'forwardPost', 'id' => 'frmpost', 'method'=>'post', 'class' => 'facebook-share-box']) !!}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Forward This Post</h4>
      </div>
      <div class="modal-body">
      
      
      <input name="share_id" id="share_id" type="hidden" value="0">
      <textarea name="subtext" id="subtext" class="form-control input-sm" style="height: 64px;margin-bottom: 10px;" placeholder="Post Announcements to Followers" rows=5 cols=20></textarea>
      <div class='panel panel-default panel-google-plus'>
      <div id="share_cont_a" class='panel-heading'></div>
      <div id="share_cont_b" class='panel-body'></div>
      </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close" >Close</button>
        <input type="submit" class="btn btn-primary" id="sharebtn" value="Forward now">
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>


@push('bottomscripts')
<script language="javaScript" type="text/javascript">

function do_it()
{
    var url = "{{ route('groupPostSubmit') }}";
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
            
            var newpost = "";
            newpost = 0;
            if(obj != 0) {
                //console.log(obj);
                /*built_post(obj.post_id,
                obj.user_name,
                obj.user_image,
                obj.user_id,
                obj.post_text,
                obj.post_date,
                obj.post_type,
                obj.post_images,
                obj.group_id,
                obj.post_files);*/
                location.reload();
            }
        }
    });
    
}


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

 function sharethis(id)
{
     $('#share_id').val(id);
var a = $('#sharea_'+id).html();
var b = $('#shareb_'+id).html();
$('#share_cont_a').html(a);
$('#share_cont_b').html(b);
$('#forwardpost').modal('show');
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
            $('#formcomment_'+id).before('<div id="commentelemnt_'+comments.this_id+'" style="border-bottom: 1px solid #efeeee;margin: 5px 0 0 9px;padding-bottom: 2px;"> <img style="border: 1px solid #e7e7e7;float: left;height: 40px;margin-right: 10px;margin-top: -1px;width: 40px;;" src="{{asset('img/profile')}}/{{$user->profile_pic}}"> <p><b class="list-group-item-heading">{{$user->first_name}} {{$user->last_name}}</b> <span style="font-size: 12px;" class="list-group-item-text">'+textcomment+'</span></p><p style="margin-top: -12px;"><span class="commenttime">Just Now</span></p></div>');
        }

    });
}

$(document).ready(function(){
    $('#images').on('change',function(){
        $('#multiple_upload_form').ajaxForm({
            target:'#images_preview',
            beforeSubmit:function(e){
                $('.uploading').show();
                //$("#mypostbutton").prop('disabled', true);
            },
            success:function(e){
                $('.uploading').hide();
                //$("#mypostbutton").prop('disabled', false);
            },
            error:function(e){
            }
        }).submit();
    });
});
</script>
@endpush
@endsection