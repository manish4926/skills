@extends('partials.sidebar')

@section('basecontent')
@push('topscripts')
<style>
  .navlink{
    clear: both;
    color: white;
    display: block;
    font-weight: bold;
    line-height: 1.42857;
    padding: 1px 8px;
    white-space: nowrap;
  }
  .dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus {
    background-color: #c60000;
    color: #ffffff;
    text-decoration: none;
  }
  .nav > li > a {
    color: black;
    display: block;
    font-weight: normal;
    margin-left: 10px;
    padding: 0 14px;
    position: relative;
    font-size: 16px;
  }
  .nav-menu li{
    margin-left: 0px;
  }
  .dropdown-menu > li > a {
    width: 240px;
    padding: 0 15px;
    line-height: 24px;
    font-size: 14px;
  }
  .sidebar-nav {
    padding: 9px 0;
  }
  .dropdown-menu .sub-menu {
    left: 100%;
    position: absolute;
    top: 0;
    visibility: hidden;
    margin-top: -1px;
  }
  .dropdown-menu li:hover .sub-menu {
    visibility: visible;
  }
  @media (min-width: 768px) {
    .dropdown:hover .dropdown-menu {
      display: block;
    }
  }
  .nav-tabs .dropdown-menu,
  .nav-pills .dropdown-menu,
  .navbar .dropdown-menu {
    margin-top: 0;
  }
  .dropdown-menu {
    background-color: #white;
    border:none;
    box-shadow:none;
  }
    .arrow_box {
    border: 2px solid #29af97;
  }
  .arrow_box:after, .arrow_box:before {
    bottom: 100%;
    left: 50%;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
  }
  .arrow_box:after {
    border-color: rgba(0, 0, 0, 0);
    border-bottom-color: #;
    border-width: 7px;
    margin-left: -7px;
  }
  .arrow_box:before {
    border-color: rgba(41, 175, 151, 0);
    border-bottom-color: #29af97;
    border-width: 13px;
    margin-left: -13px;
  }
    .redsmall{
    color:red;
    padding-left: 15px;
    font-size: 11px;
  }
  
  
a.btn_login{background:#c60000; color:#fff; border:none; border-radius:3px; padding:6px 16px;}
a.btn_login:hover{background:#005baa; color:#fff;}
a.btn_login:focus{background:#c60000; color:#fff;}

a.btn_sign_up{background:#005baa; color:#fff; border:none; border-radius:3px; padding:6px 16px;}
a.btn_sign_up:hover{background:#c60000; color:#fff;}
.nav-pills > li + li{margin-top:-3px;}

.internal-page .navbar-default{background:#fff; border-bottom:1px solid #005baa;}



.discussion {

  list-style: none;

  margin: 0;

  padding: 0 0 50px 0;

}

.discussion li {

  padding: 0.5rem;

  overflow: hidden;

  display: flex;

}

.discussion .avatar {

  width: 40px;

  position: relative;

}

.discussion .avatar img {

  display: block;

  width: 100%;

}



.other .avatar:after {

  content: "";

  position: absolute;

  top: 0;

  right: 0;

  width: 0;

  height: 0;

  border: 5px solid white;

  border-left-color: transparent;

  border-bottom-color: transparent;

}



.self {

  justify-content: flex-end;

  align-items: flex-end;

}

.self .messages {

  order: 1;

  border-bottom-right-radius: 0;

}

.self .avatar {

  order: 2;

}

.self .avatar:after {

  content: "";

  position: absolute;

  bottom: 0;

  left: 0;

  width: 0;

  height: 0;

  border: 5px solid white;

  border-right-color: transparent;

  border-top-color: transparent;

  box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);

}



.messages {

  background: white;

  width: 363px;

  padding: 10px;

  border-radius: 2px;

  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);

}

.messages p {

  font-size: 14px;

  margin: 0 0 0.2rem 0;

}

.messages time {

  font-size: 11px;

  color: #ccc;

}



@keyframes  pulse {

  from {

    opacity: 0;

  }

  to {

    opacity: 0.5;

  }

}







    .conversation-wrap

    {

        box-shadow: -2px 0 3px #ddd;

        padding:0;

        max-height: 400px;

        overflow: auto;

    }

    .conversation

    {

        padding:5px;

        border-bottom:1px solid #ddd;

        margin:0;



    }



    .message-wrap

    {



        padding:0;



    }

    .msg

    {

        padding:5px;

        /*border-bottom:1px solid #ddd;*/

        margin:0;

    }

    .msg-wrap

    {

        padding:10px;

       // max-height: 400px;

        overflow: auto;



    }



    .time

    {

        color:#bfbfbf;

    }



    .send-wrap

    {

        border-top: 1px solid #eee;

        border-bottom: 1px solid #eee;

        padding:10px;

        /*background: #f8f8f8;*/

    }



    .send-message

    {

        resize: none;

    }



    .highlight

    {

        background-color: #f7f7f9;

        border: 1px solid #e1e1e8;

    }



    .send-message-btn

    {

        border-top-left-radius: 0;

        border-top-right-radius: 0;

        border-bottom-left-radius: 0;



        border-bottom-right-radius: 0;

    }

    .btn-panel

    {

        background: #f7f7f9;

    }



    .btn-panel .btn

    {

        color:#b8b8b8;



        transition: 0.2s all ease-in-out;

    }



    .btn-panel .btn:hover

    {

        color:#666;

        background: #f8f8f8;

    }

    .btn-panel .btn:active

    {

        background: #f8f8f8;

        box-shadow: 0 0 1px #ddd;

    }



    .btn-panel-conversation .btn,.btn-panel-msg .btn

    {



        background: #f8f8f8;

    }

    .btn-panel-conversation .btn:first-child

    {

        border-right: 1px solid #ddd;

    }



    .msg-wrap .media-heading

    {

        color:#003bb3;

        font-weight: 700;

    }





    .msg-date

    {

        background: none;

        text-align: center;

        color:#aaa;

        border:none;

        box-shadow: none;

        border-bottom: 1px solid #ddd;

    }





    body::-webkit-scrollbar {

        width: 12px;

    }





    /* Let's get this party started */

    ::-webkit-scrollbar {

        width: 6px;

    }



    /* Track */

    ::-webkit-scrollbar-track {

        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);

/*        -webkit-border-radius: 10px;

        border-radius: 10px;*/

    }



    /* Handle */

    ::-webkit-scrollbar-thumb {

/*        -webkit-border-radius: 10px;

        border-radius: 10px;*/

        background:#ddd;

        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);

    }

    ::-webkit-scrollbar-thumb:window-inactive {

        background: #ddd;

    }



.sectionhead {

  border-bottom: 2px dotted #cfcfcf;

  border-top: 2px dotted #cfcfcf;

  font-family: "PT Sans";

  font-size: 15px;

  padding-bottom: 10px;

  padding-top: 10px;

  text-transform: capitalize;

}

</style>

@endpush
<div class="col-md-12">
<br>
<h4 class="opensans" style="border-bottom: 1px dashed #e7e7e7;color: #000000;font-family: 'PT Sans';line-height: 36px;margin-left: 15px;margin-top: 4px;">{{ $messages[0]->title }}</h4>
<hr>
<div class="message-wrap col-md-12" style="background-color:#f8f8f8;">
	<div class="msg-wrap" style="min-height:200px;">
		<ol class="discussion">
			@foreach($messages as $message)
			<li class="{{ $message->target_id == $user->id ? "self" : "other"}}">
				<div class="avatar"> 
					@if($message->target_id != $user->id)
						<img src="{{ asset('img/profile/'.$user->profile_pic) }}">
					@else
					 	<img src="{{ asset('img/profile/'.$message->getUser()->profile_pic) }}">
					@endif
					
				</div> 
				<div class="messages"> 
					<p class="opensans">{{ $message->message}} <br>  </p> 
					<time><span class="timeago">{{ $message->timeago }}</span></time>  
				</div> 
			</li>  
			@endforeach
			<div id="newmessages"></div>
		</ol>
	</div>
	<div class="send-wrap ">
		<textarea class="form-control send-message" style="height: 75px;" id="messagetext" onkeydown="if (event.keyCode == 13) { do_reply(); return false; }" placeholder="Write a reply..." rows="5" cols="20" wrap="off"></textarea>
		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
	</div>
	<div class="btn-panel">
		<a onclick="do_reply();" class="col-lg-4 text-right btn send-message-btn pull-right" role="button"><i class="fa fa-plus"></i> Send</a>

	</div>
</div>
</div>
@push('bottomscripts')
<script type="text/javascript">
function do_reply()
{  
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

  	var conv_id 	= '{{ $messages[0]->conv_id }}';
  	var sender_id 	= {{ $messages[0]->sender_id }};
  	var receiver_id = {{ $messages[0]->receiver_id }};
  	var target_id 	= {{ $messages[0]->sender_id != $user->id ? $messages[0]->sender_id : $messages[0]->receiver_id }};
  	var title 		= '{{ $messages[0]->title }}';
  	var message 	= $('#messagetext').text();

  	$.ajax({
    type: "POST",
    url: '{{ route('sendMessage') }}',
    data: { conv_id: conv_id, sender_id: sender_id, receiver_id: receiver_id, target_id: target_id, title:title, message:message, '_token': $('input[name=_token]').val() } ,
    success: function(data)
    {
    	if(data == 'Success')
    	{
    		var text = '<li class="self">			<div class="avatar"> 				<img src="{{ asset('img/profile/'.$user->profile_pic) }}">						</div> 				<div class="messages"> 					<p class="opensans">'+message+' <br>  </p> <time><span class="timeago">now</span></time>  				</div> 			</li> ';
    	}
    	else {
    		toastr["error"]("Message Failed.");
    	}
    }

  	});

}
</script>
@endpush
@endsection