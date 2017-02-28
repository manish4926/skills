@extends('partials.sidebar')

@section('basecontent')

<hgroup class="opensans">
<h3><a href="{{ route('groupdetail', ['id' => $group->group_id ]) }}" title="click here to go back to group.">Test</a>'s Member List</h3>
</hgroup>

<div class="clear clearfix"></div>
<br><br>

<section>
	@foreach($members as $member)
	<div class="row">
		<div class="col-md-2 col-xs-4">
			<a href="#" title="{{ $member->getUser()->name}}">
			<img src="{{asset('img/profile')}}/{{ $member->getUser()->profile_pic}}" alt=""></a>
		</div>
		<div class="col-md-7 col-xs-8">
			<h5 class="opensans"><a href="#">{{ $member->getUser()->name}}</a></h5>
			@if(!empty($member->getUserProfile()))
			<p class="opensans"><i class="glyphicon glyphicon-map-marker" style="font-size:14px;"></i> {{ $member->getUserProfile()->c_city}}, {{ $member->getUserProfile()->c_state}}</p>
			@endif
		</div>
	</div>
	<hr>
	@endforeach
</section>



@endsection