@extends('partials.sidebar')

@section('basecontent')
<br />
<!--Personal Logo and buttons-->
<div class="col-md-5 cent-mob">
	 <img src="{{asset('img/groups/')}}/{{$group->group_image}}" style="border: 1px solid #e3e3e3;border-radius: 4px;">
	  
	 <div class="ProfileChangeImage" data-toggle="modal" data-target="#changeModal">
	    <img src="{{asset('img/icons/photos13.png')}}">&nbsp;<span class="opensans">Update Image</span>
	 </div>
	 
	 @if (!Auth::guest())
		  @if($myprofile == 0)
			      @if($isfollow == 0)
				 <button id="btnadd" class="btn btn-sm btn-success ProfileChangeImage" onclick="$_postback_follow()" type="button" style="border-radius: 3px;font-size: 13px;margin-top:6px;font-family: tahoma;"><i class="glyphicon glyphicon-plus"></i> Join This Group</button>

			     @else
				 <button id="btnremove" class="btn btn-sm btn-default ProfileChangeImage ProfileChangeImageActive" onclick="$_postback_unfollow()" type="button" style="border-radius: 3px;font-size: 13px;margin-top:6px;font-family: tahoma;"><i class="glyphicon glyphicon-check"></i> Leave This Group</button>
				 @endif
			 @else
		    <button data-toggle="modal" data-target="#updateModal" class="btn btn-sm btn-default ProfileChangeImage" style="border-radius: 3px;font-size: 13px;margin-top:6px;font-family: tahoma;"><i class="glyphicon  glyphicon-edit"></i> Update Group info</button>
		  @endif
		   @else
		   <button class="btn btn-sm btn-default ProfileChangeImage" style="border-radius: 3px;font-size: 13px;margin-top:6px;font-family: tahoma;" onclick="$_startLogin('')">Login to join this group</button>
		@endif
</div>
<!--Personal Logo and buttons-->

<div class="col-md-7">
	<h3 class="opensans"><b>{{$group->group_name}}</b></h3>
	<p>{{$group->description}}</p>
	<h5 class="opensans profileGray"><a href="{{ url('/groups/members/') }}/{{ $group->group_id }}" title="click here to see the members of this group.">&nbsp;{{$groupcount}} members in this group.</a></h5>
		<div align="center">
			<p class="opensans">
				<button class="btn btn-sm btn-default ProfileChangeImage" type="button" style="border-radius: 5px;font-size: 13px;height: 40px;margin-top: 6px;text-transform: uppercase;width: 248px;" data-toggle="modal" data-target="#myModalContact"><i class="glyphicon glyphicon-envelope"></i> SEND Message to group admin</button>
			</p>
    	</div>
</div>