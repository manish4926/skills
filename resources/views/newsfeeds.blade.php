@extends('partials.sidebar')

@section('basecontent')

<div class="clearfix"></div>

{!! Form::open(['id' => 'frmpost', 'files'=> true, 'form-horizontal', 'class' => 'facebook-share-box']) !!}
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
        @elseif($newsfeed->type == "newsfeed")
          <div class="panel-default panel-google-plus" style="box-shadow:0; margin-top: 10px;">                 
            <div class="dropdown" style="float: right;">                   
                <span class="dropdown-toggle btn" type="button" id="dropdownMenu2540" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">                 
                    <span class="glyphicon glyphicon-chevron-down"></span>              
                </span>                  
                <ul class="dropdown-menu" style="margin-top: -7px;" aria-labelledby="dropdownMenu2540">
                    @if($user->id == $newsfeed->userid)
                    <li><a onclick="_deletePost({{ $newsfeed->id }})">Delete</a></li>
                    @endif
                </ul>             
            </div>                
            <div class="panel-heading" id="sharea_{{ $newsfeed->id }}">                   
                <img class="pull-left" style="width:48px;height:48px;" src="{{ asset('img/profile/'.$newsfeed->post_admin()->profile_pic) }}">                     
                <h5><a href="#">{{ $newsfeed->post_admin()->name}}</a>  
                <span>Added 2 new photos.</span></h5>                        
                <h5><span class="timeago">{{ $newsfeed->timeago }}</span></h5>           
            </div>                  
            <div class="panel-body" id="shareb_2540">                    
                <p id="emo2540">{{ $newsfeed->text }}</p> 
                @if(!empty($newsfeed->images))
                @foreach($images = explode(",", $newsfeed->images) as $image)
                <span>
                    <img class="img-thumbnail img-responsive" style="height:250px;width:250px;float:left;margin-left:5px;" src="{{ asset('img/posts/'.$image) }}" border="0">
                </span>
                @endforeach
                @endif
                @if(!empty($newsfeed->files))
                <?php $file = json_decode($newsfeed->files,true); 
                if(isset($file['files']))
                {
                    $filename = $file['files'][0]['name'];
                }
                else {
                    $filename = "Download";
                }
                ?>
                <div class="col-md-12">
                <div id="files2540" style="float: left; margin-top: 15px; display:inline-block;"><a  href="{{ route('downloadFile', ['file' => urlencode(base64_encode($newsfeed->files))]) }}">{{$filename}}</a></div>      
                </div>
                @endif
            </div>                 
            <div class="panel-footer">                    
                <a style=" border-bottom: 1px solid #29af97;cursor: pointer;font-family: tahoma;font-size: 12px;" type="button" data-toggle="modal" data-target="#myModal" onclick="sharethis({{ $newsfeed->id }})" class=""> Forward</a> - 
                <a style=" border-bottom: 1px solid #29af97;cursor: pointer;font-family: tahoma;font-size: 12px;" type="button" onclick="show_comment_box({{ $newsfeed->id }})" class=""> Comment </a>                  
            </div>                
            <div align="left"><span style="color:#29af97;" class="pull-left commentleft"><img src="http://educonnectin.com/layout/images/comment.jpg" border="0">&nbsp;<span id="likes" style="font-size: 12px; text-transform: none;"></span></span><span style="color:#29af97;" onclick="show_comment_box({{ $newsfeed->id }})" class="pull-right commentright">View All Comments</span></div>       
            <div class="clear clearfix"></div>
            <div id="comments_" style="">
                <div id="formcomment_" style="padding:10px;">
                <input id="commentform_" onkeydown="if (event.keyCode == 13) { do_comment({{ $newsfeed->id }}); return false; }" class="form-control" style="border-radius: 0;font-size: 12px;width: 100%;" placeholder="Write your comment." type="text" value=""> 
                </div>
            </div>           
        
        </div>
        @endif
        @endforeach
    </div>


<!--IMAGE UPLOAD-->
<div class="upload_div">
{!! Form::open(['route' => 'addNewsFeedPostImageSubmit', 'id' => 'multiple_upload_form' , 'name' => 'multiple_upload_form', 'files'=> true, 'form-horizontal', 'class' => 'facebook-share-box']) !!}
  
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
    var url = "{{ route('newsFeedPostSubmit') }}";
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