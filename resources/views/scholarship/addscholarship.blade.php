@extends('partials.sidebar')

@section('basecontent')


{!!Form::open(array('enctype'=>'multipart/form-data'))!!}

<div style=" width: 100%; min-height:200px; margin-top: 20px;">
	<h4 class="sectionhead">SUBMIT A NEW SCHOLARSHIP</h4>
	<h4 class="sectionhead"><i class="glyphicon glyphicon-file"></i>Scholarship Summary</h4>
<div>

<div class="form-group">
	<input type="text" name="title" placeholder="*Scholarship Title" class="form-control input-sm">
</div>
								
<input type="hidden" name="stype" id="stype" value="1"/>

<div class="form-group">
    <input name="location" id="city" type="text" value="" placeholder="*City" class="form-control input-sm">
</div>

<div class="form-group">
	<select class="form-control gray" name="state" id="state" >
		@foreach(state() as $key =>$states) 
            <option value="{{ $key }}">{{ $key }}</option>
        @endforeach
	</select>
</div>

<div class="form-group">
    <input name="amount" id="amount" type="text" value="" placeholder="*Scholarship Amount (INR)" class="form-control input-sm">
</div>

<div class="form-group">
    <input name="openings_count" id="openings_count" type="text" value="" placeholder="*Number of Open Scholarships " class="form-control input-sm">
</div>


					
<!--Start-Application Submission Dead Line Date-->
<div style="margin-bottom: 55px; width: 100%;"><div style="display: inline-block; margin-right: 50px;"><h4 class="sectionhead">Application Submission Dead Line Date</h4></div><br/>
	<div class="form-group">
    	<input name="submitstartdate" id="submitstartdate" type="text" value="" placeholder="Start Date " class="form-control input-sm"><br>
    	<input name="submitenddate" id="submitenddate" type="text" value="" placeholder="End Date " class="form-control input-sm">
	</div>
</div>
<!--End-Application Submission Dead Line Date-->

<div style="margin-bottom: 55px; width: 100%;"><div style="display: inline-block; margin-right: 50px;"><h4 class="sectionhead">Scholarship Duration</h4></div><br/>

	<div class="form-group">
    	<input name="coursestartdate" id="coursestartdate" type="text" value="" placeholder="Scholarship Start Date " class="form-control input-sm"><br>
    	<input name="courseenddate" id="courseenddate" type="text" value="" placeholder="Scholarship End Date " class="form-control input-sm">
	</div>

</div>

<div class="form-group" >
	<textarea name="description" id="description" class="form-control input-sm" placeholder="*Brief Summary" style="height:190px;"></textarea>
</div>

<div style="margin-bottom: 55px; width: 100%;">
	
	<h4 class="sectionhead">Scholarship Details</h4>

	<div class="form-group">
		<textarea name="requirements" id="requirements" class="form-control input-sm" placeholder="Requirements to Apply" style="height:190px;"></textarea>
	</div>

	<div class="form-group">
		<textarea name="prerequisits" id="pre" class="form-control input-sm" placeholder="Scholarship Prerequisits" style="height:190px;"></textarea>
	</div>

	<div class="form-group">
		<textarea name="details" id="details" class="form-control input-sm" placeholder="Scholarship Details" style="height:190px;"></textarea>
	</div>

	<div class="form-group">
		<textarea name="about_corp" id="about" class="form-control input-sm" placeholder="About Company/School" style="height:190px;"></textarea>
	</div>
	
	<div class="form-group">
		<textarea name="application_info" id="app_info" class="form-control input-sm" placeholder="Application info" style="height:190px;"></textarea>
	</div>

	<div class="form-group"> <h4 class="sectionhead">Attachment Files </h4>

	File Upload Form 

	</div>

	<div class="form-group">
		<textarea name="criteria" id="criteria" class="form-control input-sm" placeholder="Selection Criteria" style="height:190px;"></textarea>
	</div>

	<div class="form-group">
		<textarea name="other" id="other" class="form-control input-sm" placeholder="Other" style="height:190px;"></textarea>
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
				    <input name="contact_name" id="contact_name" type="text" value="" placeholder="*Name" class="form-control input-sm">
				</div>
				<div class="form-group"> 
				    <input name="contact_phone" id="contact_phone" type="text" placeholder="*Phone" class="form-control input-sm">
				</div>
				<div class="form-group">
					<input name="contact_email" id="contact_email" type="text" placeholder="*Email" class="form-control input-sm">
				</div>
			</div>

		</div>

	</div>

</div>
	<input type="hidden" name="posted_by" value="{{$user->id}}"/>


<div style="margin-top: 15px; align:center">
	<input id="submit" class="btn rightNavActive" type="submit" value="Submit Scholarship" onclick="return validate(); checkDOB();checkDOB1(); setAsNonDraft(); " style="color: #ffffff;"/>
		<input id="submit" class="btn rightNavActive" type="submit" value="Save as Draft" onclick="checkDOB();checkDOB1(); setAsDraft(); return true;" style=" margin-left: 20px;"/>
</div>
{!!Form::close()!!}

@push('bottomscripts')
<script>
$(function() {
    $('#submitstartdate').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'dd MM yy',
        yearRange: '2016:2018',
        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, month));
        }
    });

    $('#submitenddate').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'dd MM yy',
        yearRange: '2016:2018',
        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, month));
        }
    });

    $('#coursestartdate').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'dd MM yy',
        yearRange: '2016:2018',
        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, month));
        }
    });

    $('#courseenddate').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'dd MM yy',
        yearRange: '2016:2018',
        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, month));
        }
    });
});
</script>
@endpush
@endsection