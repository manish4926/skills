@extends('partials.sidebar')

@section('basecontent')
<div class="col-md-12">
<br>
	<h4 class="opensans" style="font-family: 'PT Sans';color: #000000;margin-top: 4px;margin-left:5px;">Submitted Scholarships</h4>
	@foreach($scholarships as $scholarship )
	<div class="col-md-12 cards">
	<div class="col-md-2">
		<img src="{{asset('img/profile')}}/{{ $scholarship->account_image ? $user->account_image : "blank.png" }}">
	</div>
	<div class="col-md-10">
	<a style="font-family: 'PT Sans';font-size: 15px; font-weight:400; line-height:1.2em; color: #2bbba1; margin:0 0 15px 0;" href="{{ route('scholarshipDetail', ['id' => $scholarship->id,'slug' => $scholarship->slug]) }}">{{ $scholarship->title }}</a> 
		@if($scholarship->status == 0)
		<span class="label label-success" style="background-color: #999999; color: #ffffff; float:right;">Draft</span>
		@else
		<span class="label label-success" style="background-color: #29af97; color: #ffffff; float:right;">Active</span>
		@endif
		
		<div>{{ $scholarship->updated_at->diffForHumans() }}</div>
			<div><span style="width:90px; display: inline-block;"><strong>Amount:</strong></span><i class="fa fa-inr themecolor"></i> &nbsp;{{$scholarship->scholarship_amount}} </div>
			<?php $start_date1= date('d-m-Y', strtotime($scholarship->scholar_start_date)); ?> 

		<div><span style="width:90px; display: inline-block;"><strong>Start Date:</strong></span><i class="fa fa-calendar themecolor"></i> <?php echo $start_date1; ?></div>
		<?php $end_date1= date('d-m-Y', strtotime($scholarship->scholar_end_date)); ?> 
		<div><span style="width:90px; display: inline-block; float:left;"><strong>End Date:</strong></span><i class="fa fa-calendar themecolor"></i> <?php echo $end_date1; ?></div>
	</div>
	</div>
	@endforeach

@if($scholarships->total() > 10)
<ul class="pagination">
<li class="{{ $scholarships->currentPage() == $scholarships->firstItem() ? "disabled" : "" }}">
  <a href="{{ route('scholarship', ['page' => $scholarships->currentPage()-1]) }}" aria-label="Previous">
    <span aria-hidden="true">&laquo;</span>
  </a>
</li>
@for($i = 1; $i <= $scholarships->total(); $i++)
    <li class="{{ $i == $scholarships->currentPage() ? 'active' : ""}}"><a href="{{ route('scholarship', ['page' => $i]) }}">{{ $i }}</a></li>
@endfor
<li class="{{ $scholarships->currentPage() == $scholarships->lastPage() ? "disabled" : "" }}">
  <a href="{{ route('scholarship', ['page' => $scholarships->currentPage()+1]) }}" aria-label="Next">
    <span aria-hidden="true">&raquo;</span>
  </a>
</li>
</ul>
@endif

</div>
@endsection