@extends('partials.sidebar')

@section('basecontent')

<h4 class="sectionhead">Account Setting</h4>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	<div class="panel panel-default">
	    <div class="panel-heading" role="tab" id="headingOne">
	      <h4 class="panel-title">
	        <a role="button" data-toggle="collapse" class="sectionhead2" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
	          Update your information
	        </a>
	      </h4>
	    </div>

	    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
		    <div class="panel-body">
		    {!! Form::open(['route' => 'personalInformationSubmit', 'id' => 'frmpost', 'files'=> true, 'form-horizontal', 'class' => '']) !!}

			@if($user->user_roles()->id == 2 OR $user->user_roles()->id == 3)	

			@include('account.setting_type1_2')

			@elseif($user->user_roles()->id == 4)

			@include('account.setting_type3')

			@elseif($user->user_roles()->id == 5)

			@include('account.setting_type4')

			@endif
			{!!Form::close()!!}
			</div>
	    </div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="headingTwo">
			<h4 class="panel-title">
			<a class="collapsed sectionhead2" role="button" data-toggle="collapse"  data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
			  Reset Password
			</a>
			</h4>
		</div>

    	<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
			<div class="panel-body">
				{!! Form::open(['route' => ['updatePassword'], 'class' => 'form-horizontal']) !!}
					<div class="form-group" style="width:90%;float:left;margin-left:25px;">
						<label>Old Password</label>
						<input type="password" name="old_password" class="form-control input-sm">
					</div>
					<div class="form-group" style="width:90%;float:left;margin-left:25px;">
						<label>New Password</label>
						<input type="password" name="password" class="form-control input-sm">
					</div>
					<div class="form-group" style="width:90%;float:left;margin-left:25px;">
						<label>Confirm New Password</label>
						<input type="password" name="password_confirmation" class="form-control input-sm">
					</div>
					<div class="clear clearfix"></div>
					<div align="center">
						<button class="btn rightNavActive" type="submit" style="width:150px;">  Change Password  </button>
					</div>

                    {!! Form::close() !!}
			</div>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="headingThree">
			<h4 class="panel-title">
				<a class="collapsed sectionhead2" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
				Account Privacy
				</a>
			</h4>
		</div>
		<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
			<div class="panel-body">
			Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
			</div>
		</div>
	</div>
</div>
@push('bottomscripts')
<script>
$(function() {
    $('#dob').datepicker({
      changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: '2017:2019',
        dateFormat: 'yy-mm-dd'
    });
});

function changegender(type) {
  $("#gender").val(type);
  if(type == 1) {
    $("#male").addClass( "active" );
    $("#female").removeClass( "active" );

  } else {
    $("#female").addClass( "active" );
    $("#male").removeClass( "active" );
  }
}

function same_as_address(id)

  {

  var checkedas =  document.getElementById(id);

  if (checkedas.checked) {

  $("#c_address").val($("#p_address").val());

  $("#c_city").val($("#p_city").val());

  $("#c_pin").val($("#p_pin").val());

  $("#c_mobile").val($("#p_mobile").val());

  $("#c_state").val($("#p_state").val());

  $("#c_country").val($("#p_country").val());

  } else {

  $("#c_address").val("");

  $("#c_city").val("");

  $("#c_pin").val("");

  $("#c_mobile").val("");

  $("#c_state").val("");

  $("#c_country").val("");

  }

  }

</script>
</script>
<script>
$(function(){
	//p_city p_state
    $filters = $('#frmpost');
    $filters.on('change', '#p_state', function() {
		//
		var val = $('#p_state').val();
		//alert(val);
		var url = "{{ url('/getcity/') }}/"+val;
        $.ajax({
			
	 type: "GET",
	url: url,
	//data:'state_id='+val,
	success: function(data){
		//alert(data);
		var cities = JSON.parse(data);
		//alert(xx);
		var city = '<option value="">Select Your City</option>';
		for (var i = 0; i < (cities.length); i++) {
			if(cities[i] == null)
			{
				//alert(cities[i]);
				cities[i] = 'Select Your City';
				city += '<option value="">'+cities[i]+'</option>'
			}
			else
			{
			city += '<option>'+cities[i]+'</option>';
			}
		}
		$("#p_city").html(city);
		
	}
		});
		});
		});

</script>
@endpush
@endsection