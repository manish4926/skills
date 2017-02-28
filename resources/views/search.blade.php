@extends('partials.sidebar')

@section('basecontent')
@push('topscripts')
<style>
.presentation {
	text-align: center;
	background: #2bbba1;
}
</style>
@endpush
<div class="col-md-12">
<br>
<h4 class="opensans" style="border-bottom: 1px dashed #e7e7e7;color: #000000;font-family: 'PT Sans';line-height: 36px;margin-left: 15px;margin-top: 4px;">{{ $query }}</h4>
<hr>
 <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#0" aria-controls="0" role="tab" data-toggle="tab">Marketplace <br>({{ $marketCount }})</a></li>
    <li role="presentation"><a href="#1" aria-controls="1" role="tab" data-toggle="tab">Students <br>({{ $studentsCount }})</a></li>
    <li role="presentation"><a href="#2" aria-controls="2" role="tab" data-toggle="tab">Teachers <br>({{ $teachersCount }})</a></li>
    <li role="presentation"><a href="#3" aria-controls="3" role="tab" data-toggle="tab">Schools <br>({{ $schoolsCount }})</a></li>
    <li role="presentation"><a href="#4" aria-controls="4" role="tab" data-toggle="tab">Groups <br>({{ $groupsCount }})</a></li>
    <li role="presentation"><a href="#5" aria-controls="5" role="tab" data-toggle="tab">Scholarships <br>({{ $scholarshipsCount }})</a></li>
    <li role="presentation"><a href="#6" aria-controls="6" role="tab" data-toggle="tab">Internships <br>({{ $internshipsCount }})</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="0">
    	<h4 class="opensans search_heading" style="float: left;">Search Results</h4>
        <h5 class="opensans search_result_heading" style="float: right;">{{ $marketCount }} Results</h5>
        @foreach ($market as $item)
		<div class="col-md-12" style="margin-bottom: 20px; border-bottom: solid 1px #ccc;">
		    <div class="col-md-2">
		        <a href="{{ route('productDetail', ['id' => $item->id,'slug' => $item->slug]) }}" ><img style="height: 120px; margin-bottom: 10px;" src="{{ asset('img/books/' . explode(',', $item->images)[0]) }}"></a>
		    </div>
		    <div class="col-md-10">
		        <a class="scholar_link" href="{{ route('productDetail', ['id' => $item->id,'slug' => $item->slug]) }}">{{ $item->title }}</a> <br><span>by {{ $item->author_name }}</span><br>
		        <span><i class="fa fa-inr"></i><del>Rs. {{ $item->price }}</del>&nbsp; Rs. {{ $item->discount }}</span>
		        <br>
		        <span>{{ substr($item->description,0,150) }}</span>
		    </div>
		</div>
		@endforeach

		@if($market->total() > 10)
		<ul class="pagination">
		<li class="{{ $market->currentPage() == $market->firstItem() ? "disabled" : "" }}">
		  <a href="{{ route('search', ['page' => $market->currentPage()-1]) }}" aria-label="Previous">
		    <span aria-hidden="true">&laquo;</span>
		  </a>
		</li>
		@for($i = 1; $i <= $market->total(); $i++)
		    <li class="{{ $i == $market->currentPage() ? 'active' : ""}}"><a href="{{ route('search', ['page' => $i])."?query=".$query."&search_type=0" }}">{{ $i }}</a></li>
		@endfor
		<li class="{{ $market->currentPage() == $market->lastPage() ? "disabled" : "" }}">
		  <a href="{{ route('search', ['page' => $market->currentPage()+1])."?query=".$query."&search_type=0" }}" aria-label="Next">
		    <span aria-hidden="true">&raquo;</span>
		  </a>
		</li>
		</ul>
		@endif

    </div>
    <div role="tabpanel" class="tab-pane" id="1">
    	<h4 class="opensans search_heading" style="float: left;">Search Results</h4>
        <h5 class="opensans search_result_heading" style="float: right;">{{ $schoolsCount }} Results</h5>

        <table style="width: 100%; float:none; margin: 0;">
		<tbody>
		@foreach($students as $student)
		<tr style="width: 100%;">
		<td style="width: 120px; max-width: 120px; padding:0 10px 0 0;">
		<div class="col-md-2 col-xs-4" style="padding:0px;">
		<a href="{{ route('userProfile', ['id' => $student->id ]) }}" style="width:100px!important; height:110px!important; margin:0 0 10px 0; border:1px solid #cccccc;"><img src="{{asset('img/profile')}}/{{ $student->profile_pic ? $student->profile_pic : "blank.png" }}"></a></div>
		<!--</td>-->

		<!--<td style="padding:0; width:80%; margin:0px; vertical-align:top;">-->
		<div class="col-md-10 col-xs-8" style="padding:0px 0 0 10px;">
		<a class="scholar_link" style="font-family: 'PT Sans';font-size: 15px; font-weight:400; line-height:1.2em; color: #2bbba1; margin:0 0 15px 0;" href="{{ route('userProfile', ['id' => $student->id ]) }}">{{ $student->name }}</a>
		<div style="float:left; width:100%; font-size: 12px; margin-top:5px;">{{ !empty($student->user_profile()) ? $student->user_profile()->basic_education : "" }}</div>
		 <div style="float:left; width:100%; font-size: 12px; margin-top:5px;"><strong> {{ !empty($student->user_profile()) ? 'Location: <i class="fa fa-map-marker" style="color:#29af97;"></i>&nbsp;'.$student->user_profile()->location : "" }}</strong>&nbsp;&nbsp; {{ !empty($student->user_profile()) ? $student->user_profile()->address : "" }}</div>

		<div style="float:left; width:100%;  margin-top:5px;">
		<span style="float:right; width:auto; margin-top: -30px;">

		@if($user->getfollowers($student->id) == 0)
		<a class="btn btn-success" onclick="followUser.call(this,{{ $student->id }},'follow')" role="button">Follow </a>
		@else
		<a class="btn btn-warning" onclick="followUser.call(this,{{ $student->id }},'unfollow')" role="button">Unfollow </a>
		@endif
		</span>
		              
		</div>
		</div></td>

		</tr>
		@endforeach
		</tbody></table>
    </div>
    <div role="tabpanel" class="tab-pane" id="2">
    	<h4 class="opensans search_heading" style="float: left;">Search Results</h4>
        <h5 class="opensans search_result_heading" style="float: right;">{{ $studentsCount }} Results</h5>

        <table style="width: 100%; float:none; margin: 0;">
		<tbody>
		@foreach($teachers as $teacher)
		<tr style="width: 100%;">
		<td style="width: 120px; max-width: 120px; padding:0 10px 0 0;">
		<div class="col-md-2 col-xs-4" style="padding:0px;">
		<a href="{{ route('userProfile', ['id' => $teacher->id ]) }}" style="width:100px!important; height:110px!important; margin:0 0 10px 0; border:1px solid #cccccc;"><img src="{{asset('img/profile')}}/{{ $teacher->profile_pic ? $teacher->profile_pic : "blank.png" }}"></a></div>
		<!--</td>-->

		<!--<td style="padding:0; width:80%; margin:0px; vertical-align:top;">-->
		<div class="col-md-10 col-xs-8" style="padding:0px 0 0 10px;">
		<a class="scholar_link" style="font-family: 'PT Sans';font-size: 15px; font-weight:400; line-height:1.2em; color: #2bbba1; margin:0 0 15px 0;" href="{{ route('userProfile', ['id' => $teacher->id ]) }}">{{ $teacher->name }}</a>
		<div style="float:left; width:100%; font-size: 12px; margin-top:5px;">{{ !empty($teacher->user_profile()) ? $teacher->user_profile()->basic_education : "" }}</div>
		 <div style="float:left; width:100%; font-size: 12px; margin-top:5px;"><strong>{{ !empty($teacher->user_profile()) ? 'Location: <i class="fa fa-map-marker" style="color:#29af97;"></i>&nbsp;'.$teacher->user_profile()->location : "" }}</strong>&nbsp;&nbsp; {{ !empty($teacher->user_profile()) ? $teacher->user_profile()->address : "" }}</div>

		<div style="float:left; width:100%;  margin-top:5px;">
		<span style="float:right; width:auto; margin-top: -30px;">
		@if($user->getfollowers($teacher->id) == 0)
		<a class="btn btn-success" onclick="followUser.call(this,{{$teacher->id}},'follow')" role="button">Follow </a>
		@else
		<a class="btn btn-warning" onclick="followUser.call(this,{{$teacher->id}},'unfollow')" role="button">Unfollow </a>
		@endif
		</span>
		              
		</div>
		</div></td>

		</tr>
		@endforeach
		</tbody></table>
    </div>
    <div role="tabpanel" class="tab-pane" id="3">
    	<h4 class="opensans search_heading" style="float: left;">Search Results</h4>
        <h5 class="opensans search_result_heading" style="float: right;">{{ $schoolsCount }} Results</h5>

        <table style="width: 100%; float:none; margin: 0;">
		<tbody>
		@foreach($schools as $school)
		<tr style="width: 100%;">
		<td style="width: 120px; max-width: 120px; padding:0 10px 0 0;">
		<div class="col-md-2 col-xs-4" style="padding:0px;">
		<a href="{{ route('userProfile', ['id' => $school->id ]) }}" style="width:100px!important; height:110px!important; margin:0 0 10px 0; border:1px solid #cccccc;"><img src="{{asset('img/profile')}}/{{ $school->profile_pic ? $school->profile_pic : "blank.png" }}"></a></div>
		<!--</td>-->

		<!--<td style="padding:0; width:80%; margin:0px; vertical-align:top;">-->
		<div class="col-md-10 col-xs-8" style="padding:0px 0 0 10px;">
		<a class="scholar_link" style="font-family: 'PT Sans';font-size: 15px; font-weight:400; line-height:1.2em; color: #2bbba1; margin:0 0 15px 0;" href="{{ route('userProfile', ['id' => $school->id ]) }}">{{ $school->name }}</a>
		<div style="float:left; width:100%; font-size: 12px; margin-top:5px;">{{ !empty($school->user_profile()) ? $school->user_profile()->basic_education : "" }}</div>
		 <div style="float:left; width:100%; font-size: 12px; margin-top:5px;">{{ !empty($school->user_profile()) ? '<strong>Location: </strong>&nbsp;&nbsp;<i class="fa fa-map-marker" style="color:#29af97;"></i>&nbsp;'.$school->user_profile()->location : "" }} {{ !empty($school->user_profile()) ? $school->user_profile()->address : "" }}</div>

		<div style="float:left; width:100%;  margin-top:5px;">
		<span style="float:right; width:auto; margin-top: -30px;">
		@if($user->getfollowers($school->id) == 0)
		<a class="btn btn-success" onclick="followUser.call(this,{{$school->id}},'follow')" role="button">Follow </a>
		@else
		<a class="btn btn-warning" onclick="followUser.call(this,{{$school->id}},'unfollow')" role="button">Unfollow </a>
		@endif
		</span>
		              
		</div>
		</div></td>

		</tr>
		@endforeach
		</tbody></table>
    </div>
    
    <div role="tabpanel" class="tab-pane" id="4">
    	<h4 class="opensans search_heading" style="float: left;">Search Results</h4>
        <h5 class="opensans search_result_heading" style="float: right;">{{ $groupsCount }} Results</h5>

        @foreach($groups as $group)
          <div class="col-md-12">
            <div  class="col-md-2 col-xs-4">
              <a href="#" class="thumbnail img-responsive"><img src="{{ asset('img/groups/'.$group->group_image) }}"/></a>
            </div>

              <div  class="col-md-7 col-xs-8">
                <h5 class="opensans" style="margin: 0;"><a href="{{ route('groupdetail', ['id' => $group->group_id ]) }}" title="">{{ $group->group_name }}</a></h5>
                <p class="opensans" style="font-size:13px;">{{ substr($group->description,0,100) }}</p>
              </div>
          </div>
          @endforeach

    </div>
    <div role="tabpanel" class="tab-pane" id="5">
    	<h4 class="opensans search_heading" style="float: left;">Search Results</h4>
        <h5 class="opensans search_result_heading" style="float: right;">{{ $scholarshipsCount }} Results</h5>

        @foreach($scholarships as $scholarship )
		<div class="col-md-12 cards">
		<div class="col-md-2">
			<img src="{{asset('img/profile')}}/{{ $scholarship->account_image ? $user->account_image : "blank.png" }}">
		</div>
		<div class="col-md-10">
		<a style="font-family: 'PT Sans';font-size: 15px; font-weight:400; line-height:1.2em; color: #2bbba1; margin:0 0 15px 0;" href="{{ route('scholarshipDetail', ['id' => $scholarship->id,'slug' => $scholarship->slug]) }}">{{ $scholarship->title }}</a> 
			@if($scholarship->daysleft < 0)
			<span class="label label-success" style="background-color: #999999; color: #ffffff; float:right;">Closed</span>
			@else
			<span class="label label-success" style="background-color: #29af97; color: #ffffff; float:right;">Active</span>
			@endif
			
			<div>{{ $scholarship->updated_at->diffForHumans() }}</div>
				<div><span style="width:90px; display: inline-block;"><strong>Amount:</strong></span><i class="fa fa-inr themecolor"></i> &nbsp;{{$scholarship->scholarship_amount}} </div>
				<?php $start_date1= date('d-m-Y', strtotime($scholarship->scholar_start_date)); ?> 

			<div><span style="width:90px; display: inline-block;"><strong>Start Date:</strong></span><i class="fa fa-calendar themecolor"></i> {{ $start_date1 }}</div>
			<?php $end_date1= date('d-m-Y', strtotime($scholarship->scholar_end_date)); ?> 
			<div><span style="width:90px; display: inline-block;"><strong>End Date:</strong></span><i class="fa fa-calendar themecolor"></i> {{ $end_date1 }}</div>
			<div><span style="width:90px; display: inline-block;"><strong>Duration:</strong></span><i class="fa fa-calendar themecolor"></i> {{ $scholarship->duration }} weeks</div>
			<div><span style="width:90px; display: inline-block;"><strong>Location:</strong></span><i class="fa fa-calendar themecolor"></i> {{ $scholarship->location }}</div>
			<div><span style="width:90px; display: inline-block;"><strong>Last Date:</strong></span><i class="fa fa-calendar themecolor"></i> {{ date('d-m-Y', strtotime($scholarship->last_date)) }}</div>
		</div>
		</div>
		@endforeach

		@if($scholarships->total() > 10)
		<ul class="pagination">
		<li class="{{ $scholarships->currentPage() == $scholarships->firstItem() ? "disabled" : "" }}">
		  <a href="{{ route('search', ['page' => $scholarships->currentPage()-1])."?query=".$query."&search_type=5" }}" aria-label="Previous">
		    <span aria-hidden="true">&laquo;</span>
		  </a>
		</li>
		@for($i = 1; $i <= $scholarships->total(); $i++)
		    <li class="{{ $i == $scholarships->currentPage() ? 'active' : ""}}"><a href="{{ route('search', ['page' => $i])."?query=".$query."&search_type=5" }}">{{ $i }}</a></li>
		@endfor
		<li class="{{ $scholarships->currentPage() == $scholarships->lastPage() ? "disabled" : "" }}">
		  <a href="{{ route('search', ['page' => $scholarships->currentPage()+1])."?query=".$query."&search_type=5" }}" aria-label="Next">
		    <span aria-hidden="true">&raquo;</span>
		  </a>
		</li>
		</ul>
		@endif
    </div>
    <div role="tabpanel" class="tab-pane" id="6">
    	<h4 class="opensans search_heading" style="float: left;">Search Results</h4>
        <h5 class="opensans search_result_heading" style="float: right;">{{ $internshipsCount }} Results</h5>

        @foreach($internships as $internship )
		<div class="col-md-12 cards">
		<div class="col-md-2">
			<img src="{{asset('img/profile')}}/{{ $internship->account_image ? $user->account_image : "blank.png" }}">
		</div>
		<div class="col-md-10">
		<a style="font-family: 'PT Sans';font-size: 15px; font-weight:400; line-height:1.2em; color: #2bbba1; margin:0 0 15px 0;" href="{{ route('internshipDetail', ['id' => $internship->id,'slug' => $internship->slug]) }}">{{ $internship->title }}</a> 
			@if($internship->daysleft < 0)
			<span class="label label-success" style="background-color: #999999; color: #ffffff; float:right;">Closed</span>
			@else
			<span class="label label-success" style="background-color: #29af97; color: #ffffff; float:right;">Active</span>
			@endif
			
			<div>{{ $internship->updated_at->diffForHumans() }}</div>
				<div><span style="width:90px; display: inline-block;"><strong>Amount:</strong></span><i class="fa fa-inr themecolor"></i> &nbsp;{{$internship->internship_amount}} </div>
				<?php $start_date1= date('d-m-Y', strtotime($internship->intern_start_date)); ?> 

			<div><span style="width:90px; display: inline-block;"><strong>Start Date:</strong></span><i class="fa fa-calendar themecolor"></i> {{ $start_date1 }}</div>
			<?php $end_date1= date('d-m-Y', strtotime($internship->intern_end_date)); ?> 
			<div><span style="width:90px; display: inline-block;"><strong>End Date:</strong></span><i class="fa fa-calendar themecolor"></i> {{ $end_date1 }}</div>
			<div><span style="width:90px; display: inline-block;"><strong>Duration:</strong></span><i class="fa fa-calendar themecolor"></i> {{ $internship->duration }} weeks</div>
			<div><span style="width:90px; display: inline-block;"><strong>Location:</strong></span><i class="fa fa-calendar themecolor"></i> {{ $internship->location }}</div>
			<div><span style="width:90px; display: inline-block;"><strong>Last Date:</strong></span><i class="fa fa-calendar themecolor"></i> {{ date('d-m-Y', strtotime($internship->last_date)) }}</div>
		</div>
		</div>
		@endforeach

		@if($internships->total() > 10)
		<ul class="pagination">
		<li class="{{ $internships->currentPage() == $internships->firstItem() ? "disabled" : "" }}">
		  <a href="{{ route('search', ['page' => $internships->currentPage()-1])."?query=".$query."&search_type=5" }}" aria-label="Previous">
		    <span aria-hidden="true">&laquo;</span>
		  </a>
		</li>
		@for($i = 1; $i <= $internships->total(); $i++)
		    <li class="{{ $i == $internships->currentPage() ? 'active' : ""}}"><a href="{{ route('search', ['page' => $i])."?query=".$query."&search_type=5" }}">{{ $i }}</a></li>
		@endfor
		<li class="{{ $internships->currentPage() == $internships->lastPage() ? "disabled" : "" }}">
		  <a href="{{ route('search', ['page' => $internships->currentPage()+1])."?query=".$query."&search_type=5" }}" aria-label="Next">
		    <span aria-hidden="true">&raquo;</span>
		  </a>
		</li>
		</ul>
		@endif
    </div>
  </div>
</div>
@push('bottomscripts')
<script type="text/javascript">
$( document ).ready(function() {
	var searchtype = '{{ $search_type }}';
	if(searchtype >= 7)
	{
		searchtype = 0;
	}
    $('a[href="#'+searchtype+'"]').tab('show');
});
	
	
</script>
@endpush
@endsection