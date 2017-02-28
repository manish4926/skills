@extends('partials.sidebar')

@section('basecontent')
<div class="col-m-12">
    <div class="col-md-6 catbuttons">
        <a href="{{ route('addInternship')}}">
        <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
        <span>Add Internship</span>
        </a>
    </div>
    <div class="col-md-6 catbuttons">
        <a href="{{ route('addInternship',['type'=>'linked'])}}">
        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
        <span>Add Linked Internship</span>
        </a>
    </div>
    
</div>
<div class="col-md-12">
<br>
<h4 class="opensans" style="font-family: 'PT Sans';color: #000000;margin-top: 4px;margin-left:5px;">Submitted Internships</h4>
<!-- Nav tabs -->
<ul class="nav nav-tabs nav-justified" role="tablist">
	<li role="presentation" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
	<li role="presentation"><a href="#linked" aria-controls="linked" role="tab" data-toggle="tab">Linked</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">

<div role="tabpanel" class="tab-pane fade in active" id="general">
	
	@foreach($generalInternships as $generalInternship )
	<div class="col-md-12 cards">
	<div class="col-md-2">
		<img src="{{asset('img/profile')}}/{{ $generalInternship->account_image ? $user->account_image : "blank.png" }}">
	</div>
	<div class="col-md-5">
	<a style="font-family: 'PT Sans';font-size: 15px; font-weight:400; line-height:1.2em; color: #2bbba1; margin:0 0 15px 0;" href="{{ route('internshipsDetail', ['id' => $generalInternship->id,'slug' => $generalInternship->slug]) }}">{{ $generalInternship->title }}</a> 
		
		
		<div>{{ $generalInternship->updated_at->diffForHumans() }}</div>
			<div><span style="width:90px; display: inline-block;"><strong>Amount:</strong></span><i class="fa fa-inr themecolor"></i> &nbsp;{{$generalInternship->internships_amount}} </div>
			<?php $start_date1= date('d-m-Y', strtotime($generalInternship->intern_start_date)); ?> 

		<div><span style="width:90px; display: inline-block;"><strong>Start Date:</strong></span><i class="fa fa-calendar themecolor"></i> {{ $start_date1 }}</div>
		<?php $end_date1= date('d-m-Y', strtotime($generalInternship->intern_end_date)); ?> 
		<div><span style="width:90px; display: inline-block;"><strong>End Date:</strong></span><i class="fa fa-calendar themecolor"></i> {{ $end_date1 }}</div>
		<div><span style="width:90px; display: inline-block;"><strong>Duration:</strong></span><i class="fa fa-calendar themecolor"></i> {{ $generalInternship->duration }} weeks</div>
		<div><span style="width:90px; display: inline-block;"><strong>Location:</strong></span><i class="fa fa-calendar themecolor"></i> {{ $generalInternship->location }}</div>
		<div><span style="width:90px; display: inline-block;"><strong>Last Date:</strong></span><i class="fa fa-calendar themecolor"></i> {{ date('d-m-Y', strtotime($generalInternship->last_date)) }}</div>
	</div>
	<div class="col-md-3"><br>
		<a class="btn btn-default" href="{{ route('editInternship', ['id' => $generalInternship->id]) }}" role="button">Edit</a>&emsp;
		<a class="btn btn-danger" onclick="updateinternshipsstatus({{ $generalInternship->id }},'delete')" role="button">Delete</a><br><br>
		@if($generalInternship->status == 0)

		<a class="btn btn-success" onclick="updateinternshipsstatus({{ $generalInternship->id }},'publish')" role="button">Publish</a>

		@else

		<a class="btn btn-warning" onclick="updateinternshipsstatus({{ $generalInternship->id }},'unpublish')" role="button">&emsp; Unpublish &emsp;</a>

		@endif
	</div>
	<div class="col-md-2">
		@if($generalInternship->status == 0)
		<span class="label label-success" style="background-color: #999999; color: #ffffff; float:right;">Draft</span>
		@elseif($generalInternship->daysleft < 0)
		<span class="label label-success" style="background-color: #999999; color: #ffffff; float:right;">Closed</span>
		@else
		<span class="label label-success" style="background-color: #29af97; color: #ffffff; float:right;">Active</span>
		@endif
	</div>
	</div>
	@endforeach

	@if($generalInternships->total() > 10)
	<ul class="pagination">
	<li class="{{ $generalInternships->currentPage() == $generalInternships->firstItem() ? "disabled" : "" }}">
	  <a href="{{ route('internships', ['page' => $generalInternships->currentPage()-1]) }}" aria-label="Previous">
	    <span aria-hidden="true">&laquo;</span>
	  </a>
	</li>
	@for($i = 1; $i <= $generalInternships->total(); $i++)
	    <li class="{{ $i == $generalInternships->currentPage() ? 'active' : ""}}"><a href="{{ route('internships', ['page' => $i]) }}">{{ $i }}</a></li>
	@endfor
	<li class="{{ $generalInternships->currentPage() == $generalInternships->lastPage() ? "disabled" : "" }}">
	  <a href="{{ route('internships', ['page' => $generalInternships->currentPage()+1]) }}" aria-label="Next">
	    <span aria-hidden="true">&raquo;</span>
	  </a>
	</li>
	</ul>
	@endif

</div>
<div role="tabpanel" class="tab-pane fade" id="linked">
	
	@foreach($linkedInternships as $linkedInternship )
	<div class="col-md-12 cards">
	<div class="col-md-2">
		<img src="{{asset('img/profile')}}/{{ $linkedInternship->account_image ? $user->account_image : "blank.png" }}">
	</div>
	<div class="col-md-5">
	<a style="font-family: 'PT Sans';font-size: 15px; font-weight:400; line-height:1.2em; color: #2bbba1; margin:0 0 15px 0;" href="{{ route('internshipsDetail', ['id' => $linkedInternship->id,'slug' => $linkedInternship->slug]) }}">{{ $linkedInternship->title }}</a> 
		
		<div>{{ $linkedInternship->updated_at->diffForHumans() }}</div>
			<div><span style="width:90px; display: inline-block;"><strong>Amount:</strong></span><i class="fa fa-inr themecolor"></i> &nbsp;{{$linkedInternship->internships_amount}} </div>
			<?php $start_date1= date('d-m-Y', strtotime($linkedInternship->intern_start_date)); ?> 

		<div><span style="width:90px; display: inline-block;"><strong>Start Date:</strong></span><i class="fa fa-calendar themecolor"></i> {{ $start_date1 }}</div>
		<?php $end_date1= date('d-m-Y', strtotime($linkedInternship->intern_end_date)); ?> 
		<div><span style="width:90px; display: inline-block;"><strong>End Date:</strong></span><i class="fa fa-calendar themecolor"></i> {{ $end_date1 }}</div>
		<div><span style="width:90px; display: inline-block;"><strong>Duration:</strong></span><i class="fa fa-calendar themecolor"></i> {{ $linkedInternship->duration }} weeks</div>
		<div><span style="width:90px; display: inline-block;"><strong>Location:</strong></span><i class="fa fa-calendar themecolor"></i> {{ $linkedInternship->location }}</div>
		<div><span style="width:90px; display: inline-block;"><strong>Last Date:</strong></span><i class="fa fa-calendar themecolor"></i> {{ date('d-m-Y', strtotime($linkedInternship->last_date)) }}</div>

	</div>
	<div class="col-md-3"><br>
		<a class="btn btn-default" href="{{ route('editInternship', ['id' => $linkedInternship->id]) }}" role="button">Edit</a>&emsp;
		<a class="btn btn-danger" onclick="updateinternshipsstatus({{ $linkedInternship->id }},'delete')" role="button">Delete</a><br><br>
		@if($linkedInternship->status == 0)

		<a class="btn btn-success" onclick="updateinternshipsstatus({{ $linkedInternship->id }},'publish')" role="button">Publish</a>

		@else

		<a class="btn btn-warning" onclick="updateinternshipsstatus({{ $linkedInternship->id }},'unpublish')" role="button">&emsp; Unpublish &emsp;</a>

		@endif
	</div>
	<div class="col-md-2">
		@if($linkedInternship->status == 0)
		<span class="label label-success" style="background-color: #999999; color: #ffffff; float:right;">Draft</span>
		@elseif($linkedInternship->daysleft < 0)
		<span class="label label-success" style="background-color: #999999; color: #ffffff; float:right;">Closed</span>
		@else
		<span class="label label-success" style="background-color: #29af97; color: #ffffff; float:right;">Active</span>
		@endif
	</div>
	</div>
	@endforeach

	@if($linkedInternships->total() > 10)
	<ul class="pagination">
	<li class="{{ $linkedInternships->currentPage() == $linkedInternships->firstItem() ? "disabled" : "" }}">
	  <a href="{{ route('internships', ['page' => $linkedInternships->currentPage()-1]) }}" aria-label="Previous">
	    <span aria-hidden="true">&laquo;</span>
	  </a>
	</li>
	@for($i = 1; $i <= $linkedInternships->total(); $i++)
	    <li class="{{ $i == $linkedInternships->currentPage() ? 'active' : ""}}"><a href="{{ route('internships', ['page' => $i]) }}">{{ $i }}</a></li>
	@endfor
	<li class="{{ $linkedInternships->currentPage() == $linkedInternships->lastPage() ? "disabled" : "" }}">
	  <a href="{{ route('internships', ['page' => $linkedInternships->currentPage()+1]) }}" aria-label="Next">
	    <span aria-hidden="true">&raquo;</span>
	  </a>
	</li>
	</ul>
	@endif
</div>
</div>

	

</div>
@endsection