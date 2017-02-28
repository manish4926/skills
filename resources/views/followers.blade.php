@extends('partials.sidebar')

@section('basecontent')
<div class="profile-content sortable" style="margin-top:25px;min-height:500px;">

<h4 class="opensans profileBlockHr"><span style="border-bottom: 1px solid #1d0001;font-size: 15px;font-weight: bold;" class="opensans">Ravi's Connections</span></h4>
<br>
<div class="span12">
  <div id="tab" class="btn-group" data-toggle="buttons-radio" style="border-bottom: 5px solid #2bbba1;margin-left: -15px;margin-right: -15px;padding-left: 14px;width: 573px;">
    <a href="#clientes" onclick="changeTag(1)" id="tab1" class="opensans tabtech" style="width:200px;" data-toggle="tab">Following</a>
    <a href="#servicios" onclick="changeTag(2)" id="tab2" class="opensans tabtechactive" style="width:200px;margin-left:5px;" data-toggle="tab">Followers</a>
</div>

<script>
function changeTag(id)
{ $("#tab1").removeClass('tabtechactive');
  $("#tab2").removeClass('tabtechactive');
  $("#tab1").removeClass('tabtech');
  $("#tab2").removeClass('tabtech');
  if(id == 1)
  {
    $("#tab1").addClass('tabtech');
    $("#tab2").addClass('tabtechactive');
  }
  else
  { 
    $("#tab2").addClass('tabtech');
    $("#tab1").addClass('tabtechactive');
  }
}
</script>

<div class="tab-content">
<div class="tab-pane active" id="clientes">
<br>
  <div class="row">
    @foreach($followings as $following)
    <div class="col-md-12" style="padding-top:5px;padding-bottom:10px;border-bottom:1px solid #e3e3e3">
      <div class="col-md-2">
        <a href="{{ route('userProfile', ['id' => $following->user_id ]) }}">
        <img src="{{asset('img/profile')}}/{{ $following->profile_pic ? $following->profile_pic : "blank.png" }}" style="width:75px;max-height:75px;min-height:75px;height:75px;" border="0"></a></div>
      <div class="col-md-8 col-xs-8">
        <a style="font-family: 'PT Sans';  font-size: 14px;font-weight: bold;color: #29af97;" href="{{ route('userProfile', ['id' => $following->user_id ]) }}">{{ $following->getFollower()->name }}</a>
        @if($following->follower_profile())
        <p class="opensans"><i class="glyphicon glyphicon-map-marker" style="font-size:14px;"></i>{{ $following->follower_profile()->c_state }}</p>
        @endif
        <p class="opensans" style="font-size:13px;">I am a {{getUsertype($following->role_id)}}</p>
      </div>
      <div class="col-md-2">
        @if($user->getfollowers($following->id) == 0)
        <a class="btn btn-success" onclick="followUser.call(this,{{ $following->id }},'follow')" role="button">Follow </a>
        @else
        <a class="btn btn-warning" onclick="followUser.call(this,{{ $following->id }},'unfollow')" role="button">Unfollow </a>
        @endif
      </div>
    </div>
    @endforeach
  </div>
</div>

<div class="tab-pane" id="servicios">
<br>
  <div class="row">
    @foreach($followers as $follower)
    <div class="col-md-12" style="padding-top:5px;padding-bottom:10px;border-bottom:1px solid #e3e3e3">
      <div class="col-md-2">
        <a href="{{ route('userProfile', ['id' => $follower->user_id ]) }}">
        <img src="{{asset('img/profile')}}/{{ $follower->profile_pic ? $follower->profile_pic : "blank.png" }}" style="width:75px;max-height:75px;min-height:75px;height:75px;" border="0"></a></div>
      <div class="col-md-8 col-xs-8">
        <a style="font-family: 'PT Sans';  font-size: 14px;font-weight: bold;color: #29af97;" href="{{ route('userProfile', ['id' => $follower->user_id ]) }}">{{ $follower->getUser()->name }}</a>
        @if($follower->user_profile())
        <p class="opensans"><i class="glyphicon glyphicon-map-marker" style="font-size:14px;"></i>{{ $follower->user_profile()->c_state }}</p>
        @endif
        <p class="opensans" style="font-size:13px;">I am a {{getUsertype($follower->role_id)}}</p>
      </div>
      <div class="col-md-2">
        
        <a class="btn btn-warning" onclick="followUser.call(this,{{ $follower->id }},'unfollow')" role="button">Unfollow </a>
      </div>
    </div>
    @endforeach
  </div>
</div>
</div>
</div>
</div>
@endsection