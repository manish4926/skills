@extends('master')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-3">
			<div class="leftnav">
				<div class="profile">
					<a href="#">
						<img src="{{asset('img/profile')}}/{{ $user->account_image ? $user->account_image : "blank.png" }}">
					</a>
				</div>
		        <div class="opensans">
		        {{ $user->name }}<br>
		        <a href="#">Edit Profile</a>
		        </div>
			</div>
			<div class="sidenav">
				<nav class="navbar navbar-default">
				    <!-- Brand and toggle get grouped for better mobile display -->
				    <div class="navbar-header">
				      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
				    </div>

				    <!-- Collect the nav links, forms, and other content for toggling -->
				    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				      <ul class="nav navbar-nav">
				        <li><a href="{{ route('dashboard') }}"><i class="glyphicon glyphicon-record"></i> Home</a></li>
				        <li><a href="#"><i class="glyphicon glyphicon-star-empty"></i> Social Activity</a></li>
				        <li><a href="#"><i class="glyphicon glyphicon-star-empty"></i> My Activity</a></li>
				        <li><a href="#"><i class="glyphicon glyphicon-envelope"></i> Message</a></li>
				        <li><a href="#"><i class="glyphicon glyphicon-user"></i> Followers</a></li>
				        <li><a href="#"><i class="glyphicon glyphicon-record"></i> Groups</a></li>
				        <li><a href="#"><i class="glyphicon glyphicon-ok"></i> Buy Educatonal Items</a></li>
				        <li><a href="#"><i class="glyphicon glyphicon-usd"></i> Sell Educatonal Items</a></li>
				        <li><a href="#"><i class="glyphicon glyphicon-folder-open"></i> My Educatonal Items</a></li>
				        <li><a href="#"><i class="glyphicon glyphicon-record"></i> Manage My Scholarships</a></li>
				        <li><a href="#"><i class="glyphicon glyphicon-record"></i> Manage My Interships</a></li>
				        <li><a href="#"><i class="glyphicon glyphicon-blackboard"></i> Practice Tests</a></li>
				      </ul>
				      
				    </div><!-- /.navbar-collapse -->
				</nav>
			</div>
		</div>
		<div class="col-md-9" style="border: solid 1px #ccc;">
		@yield('basecontent')
		</div>
	</div>
</div>
@endsection