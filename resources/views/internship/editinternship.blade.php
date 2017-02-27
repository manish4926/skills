@extends('partials.sidebar')

@section('basecontent')

{!! Form::open(['route' => 'addInternshipSubmit', 'id' => 'frmpost', 'files'=> true, 'form-horizontal', 'class' => '', 'enctype'=>'multipart/form-data']) !!}
<input name="post_status" id="post_status" type="hidden" value="1">
<input name="post_id" id="post_id" type="hidden" value="{{ $internship->id }}">
<div style=" width: 100%; min-height:200px; margin-top: 20px;">
	@if(empty($internship->link))
	<h4 class="sectionhead">SUBMIT A NEW INTERNSHIP</h4>
	@elseif(!empty($internship->link))
	<h4 class="sectionhead">SUBMIT A LINKED INTERNSHIP</h4>
	@endif
	<h4 class="sectionhead"><i class="glyphicon glyphicon-file"></i>Internship Summary</h4>
<div>

<div class="form-group">
	<input type="text" name="title" placeholder="*Internship Title" value="{{ $internship->title }}" class="form-control input-sm">
</div>
@if(empty($internship->link))
<input type="hidden" name="link">
@elseif(!empty($internship->link))
<div class="form-group">
	<input type="text" name="link" placeholder="Internship Link" value="{{ $internship->link }}" class="form-control input-sm">
</div>
@endif

<div class="form-group">
    <input name="location" id="city" type="text" value="{{ $internship->location }}" placeholder="*City" class="form-control input-sm">
</div>

<div class="form-group">
	<select class="form-control gray" name="state" id="state" >
		@foreach(state() as $key =>$states) 

            <option value="{{ $key }}" {{ $internship->state == $key ? "selected" : ""  }}>{{ $key }}</option>
        @endforeach
	</select>
</div>

<div class="form-group">
    <input name="amount" id="amount" type="text" value="{{ $internship->stipend_amount }}" placeholder="*Stipend (INR)" class="form-control input-sm">
</div>

<div class="form-group">
    <input name="openings_count" id="openings_count" type="text" value="{{ $internship->openings_count }}" placeholder="*Number of Open Internships " class="form-control input-sm">
</div>


					
<!--Start-Application Submission Dead Line Date-->
<div style="display: inline-block; margin-right: 50px;"><h4 class="sectionhead">Application Submission Dead Line Date</h4></div><br/>
	<div class="form-group">
    	<input name="last_date" id="last_date" type="text" value="{{ $internship->last_date }}" placeholder="End Date " class="form-control input-sm">
	</div>
<!--End-Application Submission Dead Line Date-->

<div style="display: inline-block; margin-right: 50px;"><h4 class="sectionhead">Internship Duration</h4></div><br/>
<div class="form-group">
	<input name="coursestartdate" id="coursestartdate" type="text" value="{{ $internship->intern_start_date }}" placeholder="Internship Start Date " class="form-control input-sm"><br>
	<input name="courseenddate" id="courseenddate" type="text" value="{{ $internship->intern_end_date }}" placeholder="Internship End Date " class="form-control input-sm">
</div>


<div class="form-group" >
	<textarea name="description" id="description" class="form-control input-sm" placeholder="*Brief Summary" style="height:190px;">{{ $internship->brief_summary }}</textarea>
</div>

<div style="margin-bottom: 55px; width: 100%;">
	
	<h4 class="sectionhead">Internship Details</h4>

	<div class="form-group">
		<textarea name="qualifications" id="qualifications" class="form-control input-sm" placeholder="Requirements to Apply" style="height:190px;">{{ $internship->qualifications }}</textarea>
	</div>

	<div class="form-group">
		<textarea name="prerequisits" id="pre" class="form-control input-sm" placeholder="Internship Prerequisits" style="height:190px;">{{ $internship->prerequisits }}</textarea>
	</div>

	<div class="form-group">
		<textarea name="details" id="details" class="form-control input-sm" placeholder="Internship Details" style="height:190px;">{{ $internship->details }}</textarea>
	</div>

	<div class="form-group">
		<textarea name="about_corp" id="about" class="form-control input-sm" placeholder="About Company/School" style="height:190px;">{{ $internship->about_company }}</textarea>
	</div>
	

	<div class="form-group"> <h4 class="sectionhead">Attachment Files </h4>

	File Upload Form 
	
<!-- File Upload Start -->
	<table><tr> <td style="vertical-align: top;">
	        
			<input type="hidden" name="files_uploaded" id="__files_uploaded" value="">

			<input type="file" name="file" class="upload-file-input" id="__files" onchange="filesChanged()" style="float: left; visibility: hidden; max-width: 0;" multiple>

			<a href="" class="btn btn-default upload-icon-a" onclick="uploadButtonPressed(); return false;"  style="float: left; margin-right: 15px;"><i style="font-size: 18px;" class="glyphicon glyphicon-upload"></i></a>

	        </td> <td><div id="__filescontentold" style="max-width: 700px; float: left;">
		   
		</div><br/>

		<div id="__filescontent" style="max-width: 700px; float: left;"></div>

		</td></tr></table>

	</div>
<!-- End File Upload-->
	</div>

	<div class="form-group">
		<textarea name="deliverables" id="deliverables" class="form-control input-sm" placeholder="Deliverables" style="height:190px;">{{ $internship->selection_criteria }}</textarea>
	</div>

	<div class="form-group">
		<textarea name="other" id="other" class="form-control input-sm" placeholder="Other" style="height:190px;">{{ $internship->others }}</textarea>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading" role="tab" id="headingTwo">
		<h4 class="panel-title">
			<a role="button" data-toggle="collapse" class="sectionhead2" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
				CONTACT PERSON INFO
			</a>
		</h4>
	</div>
	<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
		<div class="panel-body" style="">
			<div>
				<div>
					<input class="btn rightNavActive"  type="button" value="Import Contact Details from my Profile" onclick="importDetails(); return false;" style="margin-bottom: 20px; float: right;" />
				</div>

				<div class="form-group">
				    <input name="contact_name" id="contact_name" type="text" value="{{ $internship->name }}" placeholder="*Name" class="form-control input-sm">
				</div>
				<div class="form-group"> 
				    <input name="contact_phone" id="contact_phone" type="text" value="{{ $internship->phone }}" placeholder="*Phone" class="form-control input-sm">
				</div>
				<div class="form-group">
					<input name="contact_email" id="contact_email" type="text" value="{{ $internship->email }}" placeholder="*Email" class="form-control input-sm">
				</div>
			</div>

		</div>

	</div>

</div>
	<input type="hidden" name="posted_by" value="{{$user->id}}"/>


<div style="margin-top: 15px; align:center">
	<input id="submit" class="btn rightNavActive" type="submit" value="Submit Internship" onclick="submit(id);"/>
		<input id="submit" class="btn rightNavActive" type="submit" value="Save as Draft" onclick="submit(id);" style=" margin-left: 20px;"/>
</div>
{!!Form::close()!!}

@push('bottomscripts')
<script>
$(function() {
    $('#last_date').datepicker({
    	changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: '2017:2019',
        dateFormat: 'yy-mm-dd'
    });

    $('#coursestartdate').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: '2017:2019',
        dateFormat: 'yy-mm-dd'
    });

    $('#courseenddate').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: '2017:2019',
        dateFormat: 'yy-mm-dd'
    });
});

function submit(id){
	$("#post_status").val(id);
    $("#frmpost").submit();
}
</script>
@endpush
@endsection