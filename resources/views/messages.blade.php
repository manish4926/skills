@extends('partials.sidebar')

@section('basecontent')
<div class="col-md-12">
<br>
<h4 class="opensans" style="border-bottom: 1px dashed #e7e7e7;color: #000000;font-family: 'PT Sans';line-height: 36px;margin-left: 15px;margin-top: 4px;">INBOX</h4>
<hr>
	<div class="list-group">
		@foreach($messages as $message)
		<a href="{{ route('getMessagesConversation', ['id' => $message->conv_id]) }}" class="list-group-item alist message {{ ($message->target_id==$user->id AND $message->message_status ==0) ? "active" : "" }}">
			<img src="{{ asset('img/profile/blank.png') }}" class="img-circle" width="48" height="48" alt="" border="0">
			<div style="margin-left:57px;">
			<h5 class="list-group-item-heading opensans">{{ $message->title }}</h5>
			<p class="list-group-item-text opensans" >{{ $message->message }}</p>
			</div>
			<i class="glyphicon glyphicon-envelope"></i>
			<span class="timeago" style="" title="2016-08-02T11:13:15+00:00">{{ $message->timeago }}</span>
		</a>
		@endforeach
		
	</div>
</div>
@endsection