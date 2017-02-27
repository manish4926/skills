@extends('partials.sidebar')

@section('basecontent')
<div class="col-md-12">
<br>
	<h4 class="opensans" style="font-family: 'PT Sans';color: #000000;margin-top: 4px;margin-left:5px;">Submitted Scholarships</h4>
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
  <a href="{{ route('internship', ['page' => $internships->currentPage()-1]) }}" aria-label="Previous">
    <span aria-hidden="true">&laquo;</span>
  </a>
</li>
@for($i = 1; $i <= $internships->total(); $i++)
    <li class="{{ $i == $internships->currentPage() ? 'active' : ""}}"><a href="{{ route('internship', ['page' => $i]) }}">{{ $i }}</a></li>
@endfor
<li class="{{ $internships->currentPage() == $internships->lastPage() ? "disabled" : "" }}">
  <a href="{{ route('internship', ['page' => $internships->currentPage()+1]) }}" aria-label="Next">
    <span aria-hidden="true">&raquo;</span>
  </a>
</li>
</ul>
@endif

</div>
@endsection