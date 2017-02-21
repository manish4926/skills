@extends('partials.sidebar')

@section('basecontent')

<a href="{{ route('marketplace') }}"> MarketPlace </a> &raquo; <a href="#">{{ $item->category }}</a>.
<br /><br />

<div class="row">
  	<div class="col-md-5 mob-center">
  		@foreach(explode(',', $item->images) as $images)
        <a data-toggle="lightbox" data-gallery="multiimages" href="{{ asset('img/books/'.$images) }}" class="coverimg">
        	<img id="main_image" src="{{ asset('img/books/'.$images) }}"  style="margin-bottom: 10px; width: 100%;" border="0">
        </a>
        <br/>
        @endforeach
		<span style="height:40px;color: #ffffff;font-weight: bold;font-size: 21px;width: 200px;margin-top:5px;background-color:black;" class="opensans btn">
        		<i class="fa fa-inr"></i><?php if(isset($item->discount)) { echo ($item->discount); } else { echo $item->price; } ?><span style="text-decoration:line-through; margin:0 0 0 15px; color:yellow;" >
			<i class="fa fa-inr" style=""></i>&nbsp;{{$item->price}}
        </span>
  	</div>
  	<div class="col-md-7">
    	<h5 class="opensans" style="color: #000000;font-weight: bold;"> {{ $item->title }}</h5>
    	<span style="font-weight: bold;font-size: 11px;color: #C0C0C0;" class="opensans">{{ timestampToDate($item->created_at,0) }}</span><br />
    	<?php echo nl2br($item->description); ?>
  	</div>
</div>


<hr>
<div class="col-md-12" style="margin-bottom: 20px;">
<div class="col-md-2">
<img src="{{asset('img/profile/blank.png')}}" width="100" height="100" alt="" border="0">
</div>
<div class="col-md-10">
	<p class="opensans edu-green" style="font-size:16px;"><i class="glyphicon glyphicon-th"></i> Seller Info</p>
	<p class="opensans" style="font-size:16px;"><a style="color:black;" href="#"><i class="glyphicon glyphicon-user"></i> {{$item->post_admin()->name}}</a></p>
	<p class="opensans" style="font-size:16px;"><i class="glyphicon glyphicon-map-marker"></i> {{$item->address}}.</p>
</div>
<div class="col-md-12">
@if ($item->post_user_id != Auth::user()->id)

<h5 class="opensans" style="color:#FF0000;">Contact the Seller</h5>

    {!! Form::open(['route' => 'sendMessage', 'id' => 'frmpost', 'form-horizontal', 'class' => '']) !!}
        <input name="title" type="hidden" value="Book Inquiry - {{ $item->title }}">
	    <input name="to_id" type="hidden" value="{{ $item->posted_by }}">
			<div class="form-group">
  			<textarea id="msgbodytxt" name="message" class="form-control input-sm" style="height:75px;" placeholder="Share Your Mobile and Email id For Seller to Contact You"></textarea>
  			<span id="msgerr" style="font-weight: bold;font-size: 14px;color: #FF0000;" class="opensans"></span>
     	</div>
        <button type="submit" class="btn btn-secondary btn-sm" style="width:140px;float:right;"s >Send</button>
    {!! Form::close() !!}
@endif
</div>
</div>
@endsection