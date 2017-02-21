@extends('partials.sidebar')

@section('basecontent')
<div class="col-md-12">
<br>
<h4 class="opensans" style="font-family: 'PT Sans';color: #000000;margin-top: 4px;margin-left:5px;">Submitted Scholarships</h4>
<!-- Nav tabs -->
<ul class="nav nav-tabs nav-justified" role="tablist">
	<li role="presentation" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
	<li role="presentation"><a href="#linked" aria-controls="linked" role="tab" data-toggle="tab">Linked</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">

<div role="tabpanel" class="tab-pane fade in active" id="general">
	
	@foreach($generalScholarships as $generalScholarship )
	<div class="col-md-12 cards">
	<div class="col-md-2">
		<img src="{{asset('img/profile')}}/{{ $generalScholarship->account_image ? $user->account_image : "blank.png" }}">
	</div>
	<div class="col-md-5">
	<a style="font-family: 'PT Sans';font-size: 15px; font-weight:400; line-height:1.2em; color: #2bbba1; margin:0 0 15px 0;" href="{{ route('scholarshipDetail', ['id' => $generalScholarship->id,'slug' => $generalScholarship->slug]) }}">{{ $generalScholarship->title }}</a> 
		
		
		<div>{{ $generalScholarship->updated_at->diffForHumans() }}</div>
			<div><span style="width:90px; display: inline-block;"><strong>Amount:</strong></span><i class="fa fa-inr themecolor"></i> &nbsp;{{$generalScholarship->scholarship_amount}} </div>
			<?php $start_date1= date('d-m-Y', strtotime($generalScholarship->scholar_start_date)); ?> 

		<div><span style="width:90px; display: inline-block;"><strong>Start Date:</strong></span><i class="fa fa-calendar themecolor"></i> {{ $start_date1 }}</div>
		<?php $end_date1= date('d-m-Y', strtotime($generalScholarship->scholar_end_date)); ?> 
		<div><span style="width:90px; display: inline-block;"><strong>End Date:</strong></span><i class="fa fa-calendar themecolor"></i> {{ $end_date1 }}</div>
		<div><span style="width:90px; display: inline-block;"><strong>Duration:</strong></span><i class="fa fa-calendar themecolor"></i> {{ $generalScholarship->duration }} weeks</div>
		<div><span style="width:90px; display: inline-block;"><strong>Location:</strong></span><i class="fa fa-calendar themecolor"></i> {{ $generalScholarship->location }}</div>
		<div><span style="width:90px; display: inline-block;"><strong>Last Date:</strong></span><i class="fa fa-calendar themecolor"></i> {{ date('d-m-Y', strtotime($generalScholarship->last_date)) }}</div>
	</div>
	<div class="col-md-3"><br>
		<a class="btn btn-default" href="{{ route('editScholarship', ['id' => $generalScholarship->id]) }}" role="button">Edit</a>&emsp;
		<a class="btn btn-danger" onclick="updatescholarshipstatus({{ $generalScholarship->id }},'delete')" role="button">Delete</a><br><br>
		@if($generalScholarship->status == 0)

		<a class="btn btn-success" onclick="updatescholarshipstatus({{ $generalScholarship->id }},'publish')" role="button">Publish</a>

		@else

		<a class="btn btn-warning" onclick="updatescholarshipstatus({{ $generalScholarship->id }},'unpublish')" role="button">&emsp; Unpublish &emsp;</a>

		@endif
	</div>
	<div class="col-md-2">
		@if($generalScholarship->status == 0)
		<span class="label label-success" style="background-color: #999999; color: #ffffff; float:right;">Draft</span>
		@elseif($generalScholarship->daysleft < 0)
		<span class="label label-success" style="background-color: #999999; color: #ffffff; float:right;">Closed</span>
		@else
		<span class="label label-success" style="background-color: #29af97; color: #ffffff; float:right;">Active</span>
		@endif
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
<div role="tabpanel" class="tab-pane fade" id="linked">
	
	@foreach($linkedScholarships as $linkedScholarship )
	<div class="col-md-12 cards">
	<div class="col-md-2">
		<img src="{{asset('img/profile')}}/{{ $linkedScholarship->account_image ? $user->account_image : "blank.png" }}">
	</div>
	<div class="col-md-5">
	<a style="font-family: 'PT Sans';font-size: 15px; font-weight:400; line-height:1.2em; color: #2bbba1; margin:0 0 15px 0;" href="{{ route('scholarshipDetail', ['id' => $linkedScholarship->id,'slug' => $linkedScholarship->slug]) }}">{{ $linkedScholarship->title }}</a> 
		
		<div>{{ $linkedScholarship->updated_at->diffForHumans() }}</div>
			<div><span style="width:90px; display: inline-block;"><strong>Amount:</strong></span><i class="fa fa-inr themecolor"></i> &nbsp;{{$linkedScholarship->scholarship_amount}} </div>
			<?php $start_date1= date('d-m-Y', strtotime($linkedScholarship->scholar_start_date)); ?> 

		<div><span style="width:90px; display: inline-block;"><strong>Start Date:</strong></span><i class="fa fa-calendar themecolor"></i> {{ $start_date1 }}</div>
		<?php $end_date1= date('d-m-Y', strtotime($linkedScholarship->scholar_end_date)); ?> 
		<div><span style="width:90px; display: inline-block;"><strong>End Date:</strong></span><i class="fa fa-calendar themecolor"></i> {{ $end_date1 }}</div>
		<div><span style="width:90px; display: inline-block;"><strong>Duration:</strong></span><i class="fa fa-calendar themecolor"></i> {{ $linkedScholarship->duration }} weeks</div>
		<div><span style="width:90px; display: inline-block;"><strong>Location:</strong></span><i class="fa fa-calendar themecolor"></i> {{ $linkedScholarship->location }}</div>
		<div><span style="width:90px; display: inline-block;"><strong>Last Date:</strong></span><i class="fa fa-calendar themecolor"></i> {{ date('d-m-Y', strtotime($linkedScholarship->last_date)) }}</div>

	</div>
	<div class="col-md-3"><br>
		<a class="btn btn-default" href="{{ route('editScholarship', ['id' => $linkedScholarship->id]) }}" role="button">Edit</a>&emsp;
		<a class="btn btn-danger" onclick="updatescholarshipstatus({{ $linkedScholarship->id }},'delete')" role="button">Delete</a><br><br>
		@if($linkedScholarship->status == 0)

		<a class="btn btn-success" onclick="updatescholarshipstatus({{ $linkedScholarship->id }},'publish')" role="button">Publish</a>

		@else

		<a class="btn btn-warning" onclick="updatescholarshipstatus({{ $linkedScholarship->id }},'unpublish')" role="button">&emsp; Unpublish &emsp;</a>

		@endif
	</div>
	<div class="col-md-2">
		@if($linkedScholarship->status == 0)
		<span class="label label-success" style="background-color: #999999; color: #ffffff; float:right;">Draft</span>
		@elseif($linkedScholarship->daysleft < 0)
		<span class="label label-success" style="background-color: #999999; color: #ffffff; float:right;">Closed</span>
		@else
		<span class="label label-success" style="background-color: #29af97; color: #ffffff; float:right;">Active</span>
		@endif
	</div>
	</div>
	@endforeach

	@if($linkedScholarships->total() > 10)
	<ul class="pagination">
	<li class="{{ $linkedScholarships->currentPage() == $linkedScholarships->firstItem() ? "disabled" : "" }}">
	  <a href="{{ route('scholarship', ['page' => $linkedScholarships->currentPage()-1]) }}" aria-label="Previous">
	    <span aria-hidden="true">&laquo;</span>
	  </a>
	</li>
	@for($i = 1; $i <= $linkedScholarships->total(); $i++)
	    <li class="{{ $i == $linkedScholarships->currentPage() ? 'active' : ""}}"><a href="{{ route('scholarship', ['page' => $i]) }}">{{ $i }}</a></li>
	@endfor
	<li class="{{ $linkedScholarships->currentPage() == $linkedScholarships->lastPage() ? "disabled" : "" }}">
	  <a href="{{ route('scholarship', ['page' => $linkedScholarships->currentPage()+1]) }}" aria-label="Next">
	    <span aria-hidden="true">&raquo;</span>
	  </a>
	</li>
	</ul>
	@endif
</div>
</div>

	

</div>
@endsection