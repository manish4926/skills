@extends('partials.sidebar')

@section('basecontent')
<div class="col-md-12">
<br>
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
	<li role="presentation"><a href="#linked" aria-controls="linked" role="tab" data-toggle="tab">Linked</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
<div role="tabpanel" class="tab-pane fade in active" id="general">...</div>
<div role="tabpanel" class="tab-pane fade" id="linked">...</div>
</div>

	<h4 class="opensans" style="font-family: 'PT Sans';color: #000000;margin-top: 4px;margin-left:5px;">Submitted Scholarships</h4>
	@foreach($generalScholarships as $generalScholarship )
	<div class="col-md-12 cards">
	<div class="col-md-2">
		<img src="{{asset('img/profile')}}/{{ $generalScholarship->account_image ? $user->account_image : "blank.png" }}">
	</div>
	<div class="col-md-10">
	<a style="font-family: 'PT Sans';font-size: 15px; font-weight:400; line-height:1.2em; color: #2bbba1; margin:0 0 15px 0;" href="{{ route('scholarshipDetail', ['id' => $generalScholarship->id,'slug' => $generalScholarship->slug]) }}">{{ $generalScholarship->title }}</a> 
		@if($generalScholarship->status == 0)
		<span class="label label-success" style="background-color: #999999; color: #ffffff; float:right;">Draft</span>
		@else
		<span class="label label-success" style="background-color: #29af97; color: #ffffff; float:right;">Active</span>
		@endif
		
		<div>{{ $generalScholarship->updated_at->diffForHumans() }}</div>
			<div><span style="width:90px; display: inline-block;"><strong>Amount:</strong></span><i class="fa fa-inr themecolor"></i> &nbsp;{{$generalScholarship->scholarship_amount}} </div>
			<?php $start_date1= date('d-m-Y', strtotime($generalScholarship->scholar_start_date)); ?> 

		<div><span style="width:90px; display: inline-block;"><strong>Start Date:</strong></span><i class="fa fa-calendar themecolor"></i> <?php echo $start_date1; ?></div>
		<?php $end_date1= date('d-m-Y', strtotime($generalScholarship->scholar_end_date)); ?> 
		<div><span style="width:90px; display: inline-block; float:left;"><strong>End Date:</strong></span><i class="fa fa-calendar themecolor"></i> <?php echo $end_date1; ?></div>
	</div>
	</div>
	@endforeach

@if($generalScholarships->total() > 10)
<ul class="pagination">
<li class="{{ $generalScholarships->currentPage() == $generalScholarships->firstItem() ? "disabled" : "" }}">
  <a href="{{ route('scholarship', ['page' => $generalScholarships->currentPage()-1]) }}" aria-label="Previous">
    <span aria-hidden="true">&laquo;</span>
  </a>
</li>
@for($i = 1; $i <= $generalScholarships->total(); $i++)
    <li class="{{ $i == $generalScholarships->currentPage() ? 'active' : ""}}"><a href="{{ route('scholarship', ['page' => $i]) }}">{{ $i }}</a></li>
@endfor
<li class="{{ $generalScholarships->currentPage() == $generalScholarships->lastPage() ? "disabled" : "" }}">
  <a href="{{ route('scholarship', ['page' => $generalScholarships->currentPage()+1]) }}" aria-label="Next">
    <span aria-hidden="true">&raquo;</span>
  </a>
</li>
</ul>
@endif

</div>
@endsection