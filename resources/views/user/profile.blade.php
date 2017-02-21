@extends('partials.sidebar')

@section('basecontent')

<!--Personal Logo and buttons-->
<div class="col-md-5 cent-mob">
	<img src="{{asset('img/profile')}}/{{ $getUser->profile_pic ? $getUser->profile_pic : "blank.png" }}" style="height: 160px;width: 160px;border: 1px solid #e3e3e3;border-radius: 4px; object-fit: contain;">

	@if($user->id == $getUser->id)
	
	<div class="ProfileChangeImage" data-toggle="modal" data-target="#changeModal">
		<span>Update Profile Image</span>
	</div>
	<a href="{{ route('personalInformation') }}" class="btn btn-sm btn-default ProfileChangeImage" type="button" style="border-radius: 3px;font-size: 13px;margin-top:6px;font-family: tahoma;">Edit Personal Information</a>
	@else
		 @if($isfollow == 0)

		 <button id="btnadd" class="btn btn-sm btn-success ProfileChangeImage" onclick="" type="button" style="border-radius: 3px;font-size: 13px;margin-top:6px;font-family: tahoma;"><i class="glyphicon glyphicon-plus"></i> Follow</button>

	     @else

		 <button id="btnremove" class="btn btn-sm btn-default ProfileChangeImage ProfileChangeImageActive" onclick="" type="button" style="border-radius: 3px;font-family: tahoma;font-size: 13px;margin-top:6px;"><i class="glyphicon glyphicon-check"></i> Unfollow</button>

	     @endif	
	@endif
</div>
<!--Personal Logo and buttons-->

<div class="col-md-7">
{{--
@if($profile[0]->account_type == 1)
@include('frontend.socialnetwork.profile_type1')
@elseif($profile[0]->account_type == 2)
@include('frontend.socialnetwork.profile_type2')
@elseif($profile[0]->account_type == 3)
@include('frontend.socialnetwork.profile_type3')
@elseif($profile[0]->account_type == 4)
@include('frontend.socialnetwork.profile_type4')
@endif
--}}
</div>


<!--Personal Logo and buttons-->

<!-- Info Tab-->

<div class="clear clearfix"></div>
<div  class="profile-content sortable" style="margin-top:25px;min-height:500px;">
	<h4 class="opensans profileBlockHr"><span style="border-bottom: 1px solid #1d0001;font-size: 22px;font-weight: bold;" class="opensans">Experience</span></h4>
        <div id="mysections"></div>
</div>

<!-- Change Profile Image -->
<div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	{!! Form::open(['route' => 'updateProfilePic', 'id' => 'frmchange', 'files'=> true, 'form-horizontal', 'class' => '']) !!}
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Update Profile Picture</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Select image from your PC:</label>
					<input name="image1" type="file">
					<input name="id" type="hidden" value="{{$getUser->id}}">
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

@push('bottomscripts')
<script type="text/javascript">
function get_section(id)
{
	var newDiv;
	var formData;
	var addNewLink = "";
	var OtherLinks = "";
	var ItemDiv;
	var tokens = "ABCD";
	@if($user->id == $getUser->id)
		addNewLink = '<a onclick="addNewPost('+id+')" style="float: right;margin-right: 9px;margin-top: -44px;cursor: pointer;"><img src="{{asset('img/icons/btn-add.png')}}" border="0"></a>';
	@endif
	var url = "{{ url('/profile/sections/') }}/{{ $getUser->id }}/"+id;
	var urlform = "{{ url('/profile/sectionsforms/') }}/{{ $getUser->user_roles()->id }}/"+id+"/"+tokens;
	$.get( url, function( data ) {

	val = JSON.parse(data);
	if(id == 24)
	{
	  x = -1;
	}
	else
	{
	  x = id;
	}
//console.log(val.recs.length);
newDiv = '<div style="background-color: #f0f2f0;margin-bottom: -19px;margin-left: -15px;margin-right: -15px;padding: 8px 12px 12px;" class="scoreindex" data-index="'+x+'" id="section_'+val.id+'">' +
      '<h4 class="opensans profileBlockHr" style="background-color: #ffffff;  padding: 5px;"><img src="{{asset('img/icons/')}}/icon'+id+'.png"> <span class="opensans" style="font-size: 17px;font-weight: normal;">'+val.title+'</span></h4> '+addNewLink+
      ' <div id="sectioncontent_'+val.id+'" style="margin-top: -9px;">  </div> ';

if(val.recs.length >= 1){
	newDiv += '<div class="addbtndiv" onclick="addNewPost('+id+')"> <button class="btn btn-success">Add More</button></div>';  
}        
  
newDiv += '<div id="sectioncontentform_'+val.id+'" style="margin-top:-10px;">  </div> <br /></div>';

$("#mysections").append(newDiv);

@if($user->id == $getUser->id)
$.get( urlform, function( dataform ) {
  $("#sectioncontentform_"+id).html(dataform);
});
@endif

jQuery.each(val.recs, function(i, profile) {
	
	@if($user->id == $getUser->id)
	    OtherLinks = '<div class="pull-right"><a onclick="editType'+id+'('+profile.recid+','+id+')" style="cursor: pointer;float: left;margin-right: 7px;margin-top: 6px;"><img src="{{asset('img/icons/btn-edit.png')}}" border="0"></a> '+
	      '<a onclick="removeItemtype('+profile.recid+','+id+')" class="" style="cursor: pointer;float: right;margin-right: 2px;margin-top: 5px;"> <img src="{{asset('img/icons/btn-remove.png')}}" border="0"></a></div>';
	@endif

	if(id == 0)
	{
	  	ItemDiv = '<div id="profileitem_'+profile.recid+'" class="profile-content" style="border-bottom: 1px solid #d0d7e6;background-color: white;padding: 8px;">' +
	          ' '+OtherLinks+' <h5 class="opensans"><span id="f1_profileitem_'+profile.recid+'">'+profile.list.f1+'</span></h5> </div>';

	}

	if(id == 1)
	{
	  	ItemDiv = '<div id="profileitem_'+profile.recid+'" class="profile-content" style="border-bottom: 1px solid #d0d7e6;background-color: white;padding: 8px;"> '+OtherLinks+
	          '<h4 class="opensans"><span id="f1_profileitem_'+profile.recid+'">'+profile.list.f1+'</span></h4> '+
	          '<h5 class="opensans"><span id="f2_profileitem_'+profile.recid+'">'+profile.list.f2+'</span></h5></div>';
	}

	if(id == 2)
	{
	  ItemDiv = '<div id="profileitem_'+profile.recid+'" class="profile-content" style="border-bottom: 1px solid #d0d7e6;background-color: white;padding: 8px;"> '+OtherLinks+
	          '<h4 class="opensans"><span id="f1_profileitem_'+profile.recid+'">'+profile.list.f1+'</span></h4>  '+
	          '<h5 class="opensans"><span id="f3_profileitem_'+profile.recid+'">'+profile.list.f3+'</span> - Year: <span id="f2_profileitem_'+profile.recid+'">'+profile.list.f2+'</span></h5>'+
	          '<h5 class="opensans">Degree:<span id="f4_profileitem_'+profile.recid+'">'+profile.list.f4+'</span>%</h5></div>';
	}

	if(id == 3)
	{
	  ItemDiv = '<div id="profileitem_'+profile.recid+'" class="profile-content" style="border-bottom: 1px solid #d0d7e6;background-color: white;padding: 8px;"> '+OtherLinks+
	          '<h4 class="opensans"><span id="f1_profileitem_'+profile.recid+'">'+profile.list.f1+'</span></h4>'+
	          '<h5 class="opensans"><span id="f3_profileitem_'+profile.recid+'">'+profile.list.f3+'</span> - Year: <span id="f2_profileitem_'+profile.recid+'">'+profile.list.f2+'</span></h5>'+
	          '<h5 class="opensans">Degree:<span id="f4_profileitem_'+profile.recid+'">'+profile.list.f4+'</span>%</h5></div>';
	}

	if(id == 4)
	{
	  ItemDiv = '<div id="profileitem_'+profile.recid+'" class="profile-content" style="border-bottom: 1px solid #d0d7e6;background-color: white;padding: 8px;"> '+OtherLinks+
	          '<h4 class="opensans"><span id="f1_profileitem_'+profile.recid+'">'+profile.list.f1+'</span></h4>  '+
	          '<h5 class="opensans"><span id="f2_profileitem_'+profile.recid+'">'+profile.list.f2+'</span> - From: <span id="f3_profileitem_'+profile.recid+'">'+profile.list.f3+'</span> To: <span id="f4_profileitem_'+profile.recid+'">'+profile.list.f4+'</span></h5>'+
	          '<h5 class="opensans"><span id="f5_profileitem_'+profile.recid+'">'+profile.list.f5+'</span></h5> <h5 class="opensans"><span id="f6_profileitem_'+profile.recid+'">'+profile.list.f6+'</span></h5> </div>';

	}

	if(id == 5)
	{
	  ItemDiv = '<div id="profileitem_'+profile.recid+'" class="profile-content" style="border-bottom: 1px solid #d0d7e6;background-color: white;padding: 8px;"> '+OtherLinks+
	          '<h4 class="opensans"><span id="f1_profileitem_'+profile.recid+'">'+profile.list.f1+'</span></h4> '+
	          '<h5 class="opensans"><span id="f2_profileitem_'+profile.recid+'">'+profile.list.f2+'</span></h5></div>';
	}

	if(id == 6)
	{
	  ItemDiv = '<div id="profileitem_'+profile.recid+'" class="profile-content" style="border-bottom: 1px solid #d0d7e6;background-color: white;padding: 8px;"> '+OtherLinks+' <h5 class="opensans"><span id="f1_profileitem_'+profile.recid+'">'+profile.list.f1+'</span></h5> </div>';
	}

	if(id == 7)
	{
	  ItemDiv = '<div id="profileitem_'+profile.recid+'" class="profile-content" style="border-bottom: 1px solid #d0d7e6;background-color: white;padding: 8px;"> '+OtherLinks+' <h5 class="opensans"><span id="f1_profileitem_'+profile.recid+'">'+profile.list.f1+'</span></h5>  </div>';
	}

	if(id == 8)
	{

	  ItemDiv = '<div id="profileitem_'+profile.recid+'" class="profile-content" style="border-bottom: 1px solid #d0d7e6;background-color: white;padding: 8px;"> '+OtherLinks+
	          '<h4 class="opensans"><span id="f1_profileitem_'+profile.recid+'">'+profile.list.f1+'</span></h4> '+
	          '<h5 class="opensans"><span id="f2_profileitem_'+profile.recid+'">'+profile.list.f2+'</span></h5> '+
	          '<h5 class="opensans"><span id="f3_profileitem_'+profile.recid+'">'+profile.list.f3+'</span></h5></div>';
	}

	if(id == 9)
	{
	  ItemDiv = '<div id="profileitem_'+profile.recid+'" class="profile-content" style="border-bottom: 1px solid #d0d7e6;background-color: white;padding: 8px;"> '+OtherLinks+
	          '<h4 class="opensans"><span id="f1_profileitem_'+profile.recid+'">'+profile.list.f1+'</span></h4>'+
	          '<h5 class="opensans"><span id="f2_profileitem_'+profile.recid+'">'+profile.list.f2+'</span></h5> '+
	          '<h5 class="opensans"><span id="f3_profileitem_'+profile.recid+'">'+profile.list.f3+'</span></h5></div>';
	}



	if(id == 10)
	{
	  ItemDiv = '<div id="profileitem_'+profile.recid+'" class="profile-content" style="border-bottom: 1px solid #d0d7e6;background-color: white;padding: 8px;"> '+OtherLinks+
	          '<h4 class="opensans"><span id="f1_profileitem_'+profile.recid+'">'+profile.list.f1+'</span></h4> '+
	          '<h5 class="opensans"><span id="f2_profileitem_'+profile.recid+'">'+profile.list.f2+'</span></h5></div>';
	}



	if(id == 11)
	{
	  ItemDiv = '<div id="profileitem_'+profile.recid+'" class="profile-content" style="border-bottom: 1px solid #d0d7e6;background-color: white;padding: 8px;"> '+OtherLinks+
	          '<h4 class="opensans"><span id="f1_profileitem_'+profile.recid+'">'+profile.list.f1+'</span></h4> '+
	          '<h5 class="opensans"><span id="f2_profileitem_'+profile.recid+'">'+profile.list.f2+'</span></h5> '+
	          '<h5 class="opensans"><span id="f3_profileitem_'+profile.recid+'">'+profile.list.f3+'</span></h5></div>';
	}



	if(id == 12)
	{
	  ItemDiv = '<div id="profileitem_'+profile.recid+'" class="profile-content" style="border-bottom: 1px solid #d0d7e6;background-color: white;padding: 8px;">'+
	          '<h4 class="opensans"><span id="f1_profileitem_'+profile.recid+'">'+profile.list.f1+'</span></h4> '+OtherLinks+
	          '<h5 class="opensans"><span id="f3_profileitem_'+profile.recid+'">'+profile.list.f3+'</span> - Year: <span id="f2_profileitem_'+profile.recid+'">'+profile.list.f2+'</span></h6>'+
	          '<h5 class="opensans">Address: <span id="f4_profileitem_'+profile.recid+'">'+profile.list.f4+'</span></h5> '+
	          '<h5 class="opensans">Degree: <span id="f5_profileitem_'+profile.recid+'">'+profile.list.f5+'</span></h5></div>';
	}



	if(id == 13)
	{
	  ItemDiv = '<div id="profileitem_'+profile.recid+'" class="profile-content" style="border-bottom: 1px solid #d0d7e6;background-color: white;padding: 8px;"> '+
	          '<h4 class="opensans"><span id="f1_profileitem_'+profile.recid+'">'+profile.list.f1+'</span></h4> '+OtherLinks+
	          '<h5 class="opensans"><span id="f2_profileitem_'+profile.recid+'">'+profile.list.f2+'</span></h5> '+
	          '<h5 class="opensans"><span id="f3_profileitem_'+profile.recid+'">'+profile.list.f3+'</span></h5></div>';
	}

	if(id == 14)
	{
	  ItemDiv = '<div id="profileitem_'+profile.recid+'" class="profile-content" style="border-bottom: 1px solid #d0d7e6;background-color: white;padding: 8px;"> '+OtherLinks+
	          '<h4 class="opensans"><span id="f1_profileitem_'+profile.recid+'">'+profile.list.f1+'</span></h4> '+
	          '<h5 class="opensans"><span id="f2_profileitem_'+profile.recid+'">'+profile.list.f2+'</span></h5> </div>';
	}



	if(id == 15)
	{
	  ItemDiv = '<div id="profileitem_'+profile.recid+'" class="profile-content" style="border-bottom: 1px solid #d0d7e6;background-color: white;padding: 8px;"> '+
	          '<h4 class="opensans"><span id="f1_profileitem_'+profile.recid+'">'+profile.list.f1+'</span></h4> '+OtherLinks+
	          '<h5 class="opensans"><span id="f2_profileitem_'+profile.recid+'">'+profile.list.f2+'</span></h5></div>';
	}

	if(id == 16)
	{
	  ItemDiv = '<div id="profileitem_'+profile.recid+'" class="profile-content" style="border-bottom: 1px solid #d0d7e6;background-color: white;padding: 8px;"> '+OtherLinks+
	          '<h4 class="opensans"><span id="f1_profileitem_'+profile.recid+'">'+profile.list.f1+'</span></h4></div>';
	}

	if(id == 17)
	{
	  ItemDiv = '<div id="profileitem_'+profile.recid+'" class="profile-content" style="border-bottom: 1px solid #d0d7e6;background-color: white;padding: 8px;"> '+OtherLinks+
	          '<h4 class="opensans"><span id="f1_profileitem_'+profile.recid+'">'+profile.list.f1+'</span></h4>  '+
	          '<h5 class="opensans"><span id="f2_profileitem_'+profile.recid+'">'+profile.list.f2+'</span></h5></div>';
	}

	if(id == 18)
	{
	  ItemDiv = '<div id="profileitem_'+profile.recid+'" class="profile-content" style="border-bottom: 1px solid #d0d7e6;background-color: white;padding: 8px;"> '+OtherLinks+
	          '<h4 class="opensans"><span id="f1_profileitem_'+profile.recid+'">'+profile.list.f1+'</span></h4>'+
	          '<h5 class="opensans"><span id="f2_profileitem_'+profile.recid+'">'+profile.list.f2+'</span> </h5><h5 class="opensans"> From: <span id="f3_profileitem_'+profile.recid+'">'+profile.list.f3+'</span> To: <span id="f4_profileitem_'+profile.recid+'">'+profile.list.f4+'</span></h5></div>';
	}



	if(id == 19)
	{
	  ItemDiv = '<div id="profileitem_'+profile.recid+'" class="profile-content" style="border-bottom: 1px solid #d0d7e6;background-color: white;padding: 8px;"> '+OtherLinks+
	          '<h4 class="opensans"><span id="f1_profileitem_'+profile.recid+'">'+profile.list.f1+'</span></h4>'+
	          '<h5 class="opensans"><span id="f2_profileitem_'+profile.recid+'">'+profile.list.f2+'</span></h5></div>';
	}



	if(id == 20)
	{

	  ItemDiv = '<div id="profileitem_'+profile.recid+'" class="profile-content" style="border-bottom: 1px solid #d0d7e6;background-color: white;padding: 8px;"> '+OtherLinks+
	          '<h4 class="opensans"><span id="f1_profileitem_'+profile.recid+'">'+profile.list.f1+'</span></h4> '+
	          '<h5 class="opensans"><span id="f2_profileitem_'+profile.recid+'">'+profile.list.f2+'</span></h5></div>';

	}



	if(id == 21)
	{
	  ItemDiv = '<div id="profileitem_'+id+'" class="profile-content" style="border-bottom: 1px solid #d0d7e6;background-color: white;padding: 8px;"> '+OtherLinks+
	          '<h4 class="opensans"><span id="f1_profileitem_'+profile.recid+'">'+profile.list.f1+'</span></h4>'+
	          '<h5 class="opensans"><span id="f2_profileitem_'+profile.recid+'">'+profile.list.f2+'</span></h5></div>';
	}

	if(id == 22)
	{

	  ItemDiv = '<div id="profileitem_'+profile.recid+'" class="profile-content" style="border-bottom: 1px solid #d0d7e6;background-color: white;padding: 8px;"> '+OtherLinks+'  <h5 class="opensans"><span id="f1_profileitem_'+profile.recid+'">'+profile.list.f1+'</span></h5> </div>';

	}

	if(id == 23)
	{
	  ItemDiv = '<div id="profileitem_'+profile.recid+'" class="profile-content" style="border-bottom: 1px solid #d0d7e6;background-color: white;padding: 8px;"> '+OtherLinks+' <h5 class="opensans"><span id="f1_profileitem_'+profile.recid+'">'+profile.list.f1+'</span></h5>  </div>';
	}

	if(id == 24)
	{
	  ItemDiv = '<div id="profileitem_'+id+'" class="profile-content" style="border-bottom: 1px solid #d0d7e6;background-color: white;padding: 8px;"> '+OtherLinks+
	          '<h4 class="opensans"><span id="f1_profileitem_'+profile.recid+'">'+profile.list.f1+'</span></h4> '+
	          '<h5 class="opensans">Contact Person: <span id="f2_profileitem_'+profile.recid+'">'+profile.list.f2+'</span></h5> '+
	          '<h5 class="opensans">Address: <span id="f3_profileitem_'+profile.recid+'">'+profile.list.f3+'</span> , <span id="f4_profileitem_'+profile.recid+'">'+profile.list.f4+'</span> , <span id="f5_profileitem_'+profile.recid+'">'+profile.list.f5+'</span> <span id="f6_profileitem_'+profile.recid+'">'+profile.list.f6+'</span> </h5> '+
	          '<h5 class="opensans"><span id="f7_profileitem_'+profile.recid+'">'+profile.list.f7+'</span></h5> '+
	          '<h5 class="opensans"><span id="f8_profileitem_'+profile.recid+'">'+profile.list.f8+'</span></h5></div>';
	}

    $("#sectioncontent_"+id).append(ItemDiv);
  });

	$('.sortable').each(function(){
		var $this = $(this);
	  	$this.append($this.find('.scoreindex').get().sort(function(a, b) {
	    return $(a).data('index') - $(b).data('index');
	  }));

	});

});
}

function addNewPost(id)
{
	$("#sectioncontent_"+id).css('display','none');
	$("#frmtype"+id).css('display','block');
	$("#id_type"+id).val("0");
	$("#text_type"+id+"_f1").val("");
	$("#text_type"+id+"_f2").val("");
	$("#text_type"+id+"_f3").val("");
	$("#text_type"+id+"_f4").val("");
	$("#text_type"+id+"_f5").val("");
	$("#text_type"+id+"_f6").val("");
	$("#text_type"+id+"_f7").val("");
	$("#text_type"+id+"_f8").val("");
}

function CloseNewPost(id)
{
	$("#sectioncontent_"+id).css('display','block');
	$("#frmtype"+id).css('display','none');
}



function removeItemtype(id,type)
{
	var r = confirm("Are you sure?");
	if (r == true) {
	$.ajax({     
	type  : 'POST',
	url   : '{{ route('deleteExperience') }}',
	data : {id : id, '_token': $('input[name=_token]').val()},
	beforeSend: function(){
	},
	complete: function(){
	},
	success: function(result){
	//console.log(result);
	}   
	});
	$("#profileitem_"+id).remove();
	}
}

$( document ).ready(function() {	
	<?php $arr = profile_section_array($getUser->user_roles()->id); ?>
	@foreach($arr as $array)
		get_section({{ $array }});
	@endforeach
});
</script>
@endpush
@endsection