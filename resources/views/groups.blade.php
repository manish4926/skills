@extends('partials.sidebar')

@section('basecontent')
<style>
a:hover, a:focus {
    color: white;
    text-decoration: none;
}

a:focus {
    outline: none;
    outline-offset: -2px;
}







</style>
<div class="pull-right" style="margin-top:25px;"><a class="btn btn-sm btn-default" data-toggle="modal" data-target="#CreateGroupModal">Create Group</a></div>

<div  class="profile-content sortable" style="margin-top:25px;min-height:500px;">

<h4 class="opensans profileBlockHr"><span style="border-bottom: 1px solid #1d0001;font-size: 15px;font-weight: bold;" class="opensans">{{$user->name}} Groups</span></h4>

<br />
@if($groupsCount == 0)
<span class="opensans">You Don't have any groups yet, Start to create or join the others gorups to make your own group list.</span>

<div align="center"><br /><a class="btn btn-sm btn-default" data-toggle="modal" data-target="#CreateGroupModal">Create Group</a></div>

<span class="opensans">{{ $user->name }}'s doesn't have any groups yet!</span>

@else

<div class="span12">

  <div id="tab" class="btn-group" data-toggle="buttons-radio" style="border-bottom: 5px solid #2bbba1;margin-left: -15px;margin-right: -15px;padding-left: 14px;width: 573px;">

    <a href="#clientes"  onclick="changeTag(1)" id="tab1" class="tabtech opensans" style="width:200px;" data-toggle="tab">Created Groups</a>

    <a href="#servicios"  onclick="changeTag(2)" id="tab2" class="tabtechactive opensans" style="width:200px;margin-left:5px;" data-toggle="tab">Joined Groups</a>

  </div>

<script>


</script>

<div class="tab-content">
    <div class="tab-pane active" id="clientes">
        <div class="row">
          @foreach($createdgroups as $cgroups)
          <div class="col-md-12">
            <div  class="col-md-2 col-xs-4">
              <a href="#" class="thumbnail img-responsive"><img src="{{ asset('img/groups/'.$cgroups->group_image) }}"/></a>
            </div>

              <div  class="col-md-7 col-xs-8">
                <h5 class="opensans" style="margin: 0;"><a href="{{ route('groupdetail', ['id' => $cgroups->group_id ]) }}" title="">{{ $cgroups->group_name }}</a></h5>
                <p class="opensans" style="font-size:13px;">{{ substr($cgroups->description,0,100) }}</p>
              </div>

              <div  class="col-md-3 mob-al-r">
  				      <button class="btn btn-sm btn-success groupbtn" type="button" onclick="$post_follow.call(this)" data-id="{{ $cgroups->group_id }}"><i class="glyphicon glyphicon-plus"></i> Join Group</button>

  				      <button class="btn btn-sm btn-default groupbtn" type="button" onclick="$post_unfollow.call(this)" data-id="{{ $cgroups->group_id }}><i class="glyphicon glyphicon-check"></i> Leave Group</button>
              </div>
          </div>
          @endforeach
          <hr>
        </div>
    </div>



    <div class="tab-pane" id="servicios">
        <br>
        <div class="row">
        @foreach($joinedgroups as $jgroups)
        <div class="col-md-12">
          <div  class="col-md-2 col-xs-4">
          <a href="#" title="Group Name" class="thumbnail img-responsive"><img src="{{ asset('img/groups/'.$jgroups->group_image) }}"  alt="" /></a>
          </div>
          <div  class="col-md-7 col-xs-8">
            <h5 class="opensans" style="margin: 0;"><a href="{{ route('groupdetail', ['id' => $jgroups->group_id ]) }}" title="">{{ $jgroups->group_name }}</a></h5>
            <p class="opensans" style="font-size:13px;">{{ substr($jgroups->description,0,100) }}</p>
          </div>

          <div  class="col-md-3 mob-al-r">
            <button class="btn btn-sm btn-success groupbtn" onclick="" type="button" data-id="{{ $jgroups->group_id }}><i class="glyphicon glyphicon-plus"></i> Join Group</button>
  				  <button class="btn btn-sm btn-default groupbtn" onclick="" type="button" data-id="{{ $jgroups->group_id }}><i class="glyphicon glyphicon-check"></i> Leave Group</button>
          </div>
      </div>
      @endforeach
      <hr>
    </div>
  </div>
</div>
@endif
@endsection