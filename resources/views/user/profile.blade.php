@extends('partials.sidebar')

@section('basecontent')

<!--Personal Logo and buttons-->
<div class="col-md-5 cent-mob">
	<img src="{{asset('img/profile')}}/{{ $user->account_image ? $user->account_image : "blank.png" }}" style="height: 160px;width: 160px;border: 1px solid #e3e3e3;border-radius: 4px;">

	@if($user->id == $userid)
	
	<div class="ProfileChangeImage" data-toggle="modal" data-target="#changeModal">
		<span>Update Profile Image</span>
	</div>
	<a href="{{url('account/setting')}}" class="btn btn-sm btn-default ProfileChangeImage" type="button" style="border-radius: 3px;font-size: 13px;margin-top:6px;font-family: tahoma;">Edit Personal Information</a>
	@else
		 @if($isfollow == 0)

		 <button id="btnadd" class="btn btn-sm btn-success ProfileChangeImage" onclick="" type="button" style="border-radius: 3px;font-size: 13px;margin-top:6px;font-family: tahoma;"><i class="glyphicon glyphicon-plus"></i> Follow</button>

	     @else

		 <button id="btnremove" class="btn btn-sm btn-default ProfileChangeImage ProfileChangeImageActive" onclick="" type="button" style="border-radius: 3px;font-family: tahoma;font-size: 13px;margin-top:6px;"><i class="glyphicon glyphicon-check"></i> Unfollow</button>

	     @endif	
	@endif
</div>
<!--Personal Logo and buttons-->
{{--
<div class="col-md-7">
@if($profile[0]->account_type == 1)
@include('frontend.socialnetwork.profile_type1')
@elseif($profile[0]->account_type == 2)
@include('frontend.socialnetwork.profile_type2')
@elseif($profile[0]->account_type == 3)
@include('frontend.socialnetwork.profile_type3')
@elseif($profile[0]->account_type == 4)
@include('frontend.socialnetwork.profile_type4')
@endif
</div>
--}}

<!--Personal Logo and buttons-->

<!-- Info Tab-->


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
					<input name="id" type="hidden" value="{{$user->id}}">
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

@endsection