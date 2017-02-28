@extends('partials.sidebar')

@section('basecontent')
<!--Personal Logo and buttons-->
<div class="col-md-5 cent-mob">
  <img src="{{asset('img/profile')}}/{{ $user->profile_pic ? $user->profile_pic : "blank.png" }}" style="height: 160px;width: 160px;border: 1px solid #e3e3e3;border-radius: 4px; object-fit: contain;">

  @if($user->id == $user->id)
  
  <div class="ProfileChangeImage" data-toggle="modal" data-target="#changeModal">
    <span>Update Profile Image</span>
  </div>
  <a href="{{ route('personalInformation') }}" class="btn btn-sm btn-default ProfileChangeImage" type="button" style="border-radius: 3px;font-size: 13px;margin-top:6px;font-family: tahoma;">Edit Personal Information</a>
  @else
     @if($user->getfollowers($user->id) == 0)

     <button id="btnadd" class="btn btn-sm btn-success ProfileChangeImage" onclick="followUser.call(this,{{ $user->id }},'follow')" type="button" style="border-radius: 3px;font-size: 13px;margin-top:6px;font-family: tahoma;"><i class="glyphicon glyphicon-plus"></i> Follow</button>

       @else

     <button id="btnremove" class="btn btn-sm btn-default ProfileChangeImage ProfileChangeImageActive" onclick="followUser.call(this,{{ $user->id }},'unfollow')" type="button" style="border-radius: 3px;font-family: tahoma;font-size: 13px;margin-top:6px;"><i class="glyphicon glyphicon-check"></i> Unfollow</button>

       @endif 
  @endif
</div>
<!--Personal Logo and buttons-->

<div class="col-md-7">
<h3 class="opensans"><b>{{$user->name}} </b></h3>
@if(!empty($user->user_profile()) AND !empty($user->user_profile()->c_address))
<p class="opensans"><i class="glyphicon glyphicon-map-marker" style="font-size:14px;"></i> {{ $user->user_profile()->c_address." , ".$user->user_profile()->c_city." , ".$user->user_profile()->c_state." , ".$user->user_profile()->c_country." , ".$user->user_profile()->c_pincode }}</p>
@endif
@if(!empty($user->user_profile()) AND !empty($user->user_profile()->permanent_person))
<p class="opensans"><i class="glyphicon glyphicon-map-marker" style="font-size:14px;"></i>Contact Person: {{$user->user_profile()->permanent_person}}
@endif

@if(!empty($user->user_profile()) AND !empty($user->user_profile()->school_name))
<p class="opensans"><i class="glyphicon glyphicon-map-marker" style="font-size:14px;"></i>Working In Person: {{$user->user_profile()->school_name}}
@endif

@if(!empty($user->user_profile()) AND !empty($user->user_profile()->exp_level))
<p class="opensans"><i class="glyphicon glyphicon-map-marker" style="font-size:14px;"></i>Experience Level: {{$user->user_profile()->exp_level}}
@endif

@if(!empty($user->user_profile()) AND !empty($user->user_profile()->telephone))
<p class="opensans"><i class="glyphicon glyphicon-map-marker" style="font-size:14px;"></i>Contact No.: {{$user->user_profile()->telephone}}
@endif

@if(!empty($user->user_profile()) AND !empty($user->user_profile()->office_email))
<p class="opensans"><i class="glyphicon glyphicon-map-marker" style="font-size:14px;"></i>Email: {{$user->user_profile()->office_email}}
@endif

@if(!empty($user->user_profile()) AND !empty($user->user_profile()->website))
<p class="opensans"><i class="glyphicon glyphicon-map-marker" style="font-size:14px;"></i>Email: {{$user->user_profile()->website}}
@endif

@if(!empty($user->user_profile()) AND !empty($user->user_profile()->contact_visibility))

  @if($user->user_profile()->contact_visibility == 1)
  <p class="opensans"><i class="glyphicon glyphicon-map-marker" style="font-size:14px;"></i>Email: {{$user->email}}
  <p class="opensans"><i class="glyphicon glyphicon-map-marker" style="font-size:14px;"></i>Phone: {{$user->phone}}
  @endif
@endif
</div>


<!--Personal Logo and buttons-->
<div class="clearfix"></div>

{!! Form::open(['url' => '/share', 'id' => 'frmpost', 'files'=> true, 'form-horizontal', 'class' => 'facebook-share-box']) !!}
  <input name="user_id" type="hidden" value="{{$user->id}}">
  <input name="images_uploaded" id="images_uploaded" type="hidden" value="">

  <div class="panel-body">
    <img class="img-circle postprofile" src="{{asset('img/profile')}}/{{ $user->profile_pic ? $user->profile_pic : "blank.png" }}">
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
  <div class="clearfix"></div>
    <div id="posts" >
        @foreach($newsfeeds as $newsfeed)

        @if($newsfeed->type == "group_created")
        <div class=" profile-content" style="margin-top: 20px;">             
          <div class="panel-default panel-google-plus">                 
            <div class="panel-heading">                   
              <img class="pull-left" style="width:48px;height:48px;" src="{{asset('img/profile')}}/{{ $newsfeed->post_admin()->profile_pic ? $newsfeed->post_admin()->profile_pic : "blank.png" }}">                     
              <h5>&nbsp;<a href="{{ route('userProfile', ['id' => $newsfeed->post_admin()->id ]) }}">{{$newsfeed->post_admin()->id == $user->id ? "You" : $newsfeed->post_admin()->name }}</a> 
              Created Group: <a href="#">{{$newsfeed->get_group()->group_name}}</a></h5>                      
              <h5><span class="timeago">{{$newsfeed->timeago}}</span></h5>           
            </div>             
          </div>
        </div>
        @elseif($newsfeed->type == "scholarship_added")
        <div class=" profile-content" style="margin-top: 20px;">             
          <div class="panel-default panel-google-plus">                 
            <div class="panel-heading">                   
              <img class="pull-left" style="width:48px;height:48px;" src="{{asset('img/profile')}}/{{ $newsfeed->post_admin()->profile_pic ? $newsfeed->post_admin()->profile_pic : "blank.png" }}">                   
              <h5>&nbsp;<a href="{{ route('userProfile', ['id' => $newsfeed->post_admin()->id ]) }}">{{$newsfeed->post_admin()->id == $user->id ? "You" : $newsfeed->post_admin()->name }}</a>  
              Created Scholarship: <a href="#">{{$newsfeed->get_scholarship()->title}}</a></h5>                      
              <h5><span class="timeago">{{$newsfeed->timeago}}</span></h5>           
            </div>             
          </div>
        </div>
        @elseif($newsfeed->type == "internship_added")
        <div class=" profile-content" style="margin-top: 20px;">             
          <div class="panel-default panel-google-plus">                 
            <div class="panel-heading">                   
              <img class="pull-left" style="width:48px;height:48px;" src="{{asset('img/profile')}}/{{ $newsfeed->post_admin()->profile_pic ? $newsfeed->post_admin()->profile_pic : "blank.png" }}">                  
              <h5>&nbsp;<a href="{{ route('userProfile', ['id' => $newsfeed->post_admin()->id ]) }}">{{$newsfeed->post_admin()->id == $user->id ? "You" : $newsfeed->post_admin()->name }}</a> 
              Created Internship: <a href="#">{{$newsfeed->get_internship()->title}}</a></h5>                      
              <h5><span class="timeago">{{$newsfeed->timeago}}</span></h5>           
            </div>             
          </div>
        </div>
        @elseif($newsfeed->type == "user_follow")
          @if($newsfeed->userid == $user->id OR $newsfeed->typeid == $user->id)
          <div class=" profile-content" style="margin-top: 20px;">             
            <div class="panel-default panel-google-plus">                 
              <div class="panel-heading">                   
                <img class="pull-left" style="width:48px;height:48px;" src="{{asset('img/profile')}}/{{ $newsfeed->post_admin()->profile_pic ? $newsfeed->post_admin()->profile_pic : "blank.png" }}">                   
                <h5>&nbsp;<a href="{{ route('userProfile', ['id' => $newsfeed->post_admin()->id ]) }}">{{$newsfeed->post_admin()->id == $user->id ? "You" : $newsfeed->post_admin()->name }}</a> 
                Started to Follow: <a href="#">{{$newsfeed->get_follower()->id == $user->id ? "You" : $newsfeed->get_follower()->name }}</a></h5>                      
                <h5><span class="timeago">{{$newsfeed->timeago}}</span></h5>           
              </div>             
            </div>
          </div>
          @endif
        @endif
        @endforeach
    </div>


<!--IMAGE UPLOAD-->
<div class="upload_div">
{!! Form::open(['route' => 'addGroupPostImageSubmit', 'id' => 'multiple_upload_form' , 'name' => 'multiple_upload_form', 'files'=> true, 'form-horizontal', 'class' => 'facebook-share-box']) !!}
  
    <input type="file" name="images[]" accept=".jpg, .jpeg, .png"  id="images" style="visibility: hidden; width: 1px; height: 1px"  multiple >
  <div class="uploading none" style="display:none;">
      <img src="{{asset('img/ajax-loader.gif')}}"/>
  </div>
{!! Form::close() !!}
</div>

<!--IMAGE UPLOAD-->

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
    location.reload();
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