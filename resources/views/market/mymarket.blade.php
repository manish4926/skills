@extends('partials.sidebar')

@section('basecontent')

<h3 class="sectionhead">Marketplace Dashboard</h3>

@if(count($mymarket) == 0)
<div align="center">
   	<img src="{{asset('img/icons/sad72.png')}}"> <br /><br />
	<span class="opensans">You Don't have any items yet, Start to sell your own items.</span>
	<br />
	<a class="btn btn-sm btn-default ProfileChangeImage" type="button" style="border-radius: 5px;font-family: 'PT Sans';font-size: 16px;height: 40px;margin-top: 6px;text-transform: uppercase;width: 248px;" href="{{url('market/add')}}"><i class="glyphicon glyphicon-plus"></i> Add New Items</a>
</div>
@else

<div style="padding:0px;">

@foreach ($mymarket as $item)
<div class="col-md-12" style="padding-top:5px;padding-bottom:10px;border-bottom:1px solid #e3e3e3">
	<div class="row">
		<div class="col-md-2 col-xs-4">
			<img src="{{ asset('img/books/' . explode(",",$item->images)[0]) }}"  border="0"></div>
		<div class="col-md-9 col-xs-8 opensans">

				{{ $item->post_title }}
				<br /> <br />
				<div class="smaller-mob">
				<a class="btn btn-default" href="{{ route('editMarket', ['id' => $item->id]) }}" role="button">Edit</a>

				<a class="btn btn-danger" onclick="updatemarketstatus.call(this,{{ $item->id }},'delete')" role="button">Delete</a>
				@if($item->status == 0)

				<a class="btn btn-success" onclick="updatemarketstatus.call(this,{{ $item->id }},'publish')" role="button">Publish</a>

				@else

				<a class="btn btn-warning" onclick="updatemarketstatus.call(this,{{ $item->id }},'unpublish')" role="button">Unpublish </a>
				@endif


				@if($item->post_status == 0)

				@if($item->post_status_reason != "")

				<br />Unpublish Reason: {{$item->post_status_reason}}

				@endif

				@endif
			</div>
		</div>
	</div>
</div>
<hr class="hidden-xs">

@endforeach

<div class="clear clearfix"></div>
	<br />
	<div align="center"><a class="btn btn-success" href="{{ url('/market/add') }}" role="button">Add More Items</a></div>
	<br />
</div>

@endif

@endsection