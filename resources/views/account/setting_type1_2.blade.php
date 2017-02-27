<div class="form-group col-md-6">
  <lable>First Name <small style="color:red;">*</small></lable>
  <input id="first_name" name="first_name" type="text" value="{{ $user->first_name }}" placeholder="First Name" class="form-control input-sm">
</div>

<div class="form-group col-md-6">
  <lable>Last Name <small style="color:red;">*</small></lable>
  <input id="last_name" name="last_name" type="text" value="{{ $user->last_name }}" placeholder="Last Name" class="form-control input-sm">
</div>

<div class="form-group col-md-6" >
  <lable>Gender</lable>
  <?php $gender = $user->user_profile() ? $user->user_profile()->gender : "";?>
  <input name="gender" id="gender" type="hidden" value="{{ $gender == 1 ? 1 : 0 }}">
  <div class="gender">
    <span onclick="changegender(1)" id="male" {{ $gender == 1 ? "active" : ""}}><i class="fa fa-male" aria-hidden="true" ></i> Male</span>
    <span onclick="changegender(0)" id="female" {{ $gender == 1 ? "active" : ""}}><i class="fa fa-female" aria-hidden="true" {{ $gender != 1 ? "active" : ""}}></i> Female</span>
  </div>
</div>

<div class="form-group col-md-6">
  <lable>Date of birth</lable>
  <input name="dob" id="dob" type="text" value="{{ $user->user_profile()->dob }}" placeholder="Date of Birth " class="form-control input-sm">
</div>

<div class="form-group col-md-6">
  <lable>Mobile Number</lable>
  <input name="p_mobile" id="p_mobile" type="text" value="{{ $user->phone }}" placeholder="Mobile Number" class="form-control input-sm">
</div>

<div class="form-group col-md-6">
  <lable>Basic Education</lable>
  <select name="basic_education" id="basic_education" class="form-control input-sm">
    <option disabled="" value="">Select Basic Education</option>
    <?php $basic_education = $user->user_profile() ? $user->user_profile()->basic_education : ""; ?>
    @foreach($list = basic_education() as $basic_edu)
    <option {{ $basic_education == $basic_edu ? "selected" : ""}}>{{ $basic_edu }}</option>
    @endforeach 
  </select>
</div>

<div class="clear clearfix"></div>

<h4 class="sectionhead">Permanent Address</h4>

<div class="form-group col-md-4">
  <lable>Address</lable>
  <input name="p_address" id="p_address" type="text" value="{{ $user->user_profile() ? $user->user_profile()->p_address : "" }}" placeholder="" class="form-control input-sm">
</div>

<div class="form-group col-md-4">
  <lable>State</lable>
  <select name="p_state" id="p_state" class="form-control input-md">
    <option value="" >Select State</option>
    <?php $selectState = $user->user_profile() ? $user->user_profile()->p_state : ""; ?>
    @foreach($states as $state)
    <option {{ $selectState == $state->states ? "selected" : ""}}>{{ $state->states }}</option>
    @endforeach
  </select>
</div>

<div class="form-group col-md-4">
  <lable>City</lable>
  <select name="p_city" id="p_city" class="form-control input-sm" required="">
    <option value="" disabled="">Select Your City</option>
  </select>
</div>

<div class="form-group col-md-6">
  <lable>Country</lable>
  <input name="p_country" id="p_country" type="text" value="{{ $user->user_profile() ? $user->user_profile()->p_country : "" }}" placeholder="Country" class="form-control input-sm">
</div>

<div class="form-group col-md-6">
  <lable>PIN</lable>
  <input name="p_pin" id="p_pin" type="text" value="{{ $user->user_profile() ? $user->user_profile()->p_pincode : "" }}" placeholder="" class="form-control input-sm">
</div>

<div class="clear clearfix"></div>


<h4>Correspondence Address <span class="pull-right np-mob db-mob mt10-mob" style="  font-size: 14px;font-weight: normal;margin-left: 5px;margin-top: -4px;text-transform: none;"><input onclick="same_as_address()" id="sameas" name="sameas" type="checkbox" value="ON"> Same as Permanent</span></h4>

<div class="form-group col-md-4" >
  <lable>Address</lable>
  <input name="c_address" id="c_address" type="text" value="{{ $user->user_profile() ? $user->user_profile()->c_address : "" }}" placeholder="Address" class="form-control input-sm">
</div>

<div class="form-group col-md-4">
  <lable>State</lable>
  <select name="c_state" id="c_state" class="form-control input-md">
    <option value="">Select State</option>
    <?php $selectState = $user->user_profile() ? $user->user_profile()->c_state : ""; ?>
    @foreach($states as $state)
    <option {{ $selectState == $state->states ? "selected" : ""}}>{{ $state->states }}</option>
    @endforeach
  </select>
</div>
		
<div class="form-group col-md-4">
  <lable>City</lable>
  <select name="c_city" id="c_city" class="form-control input-sm">
    <option value="" disabled="">Select Your City</option>

  </select>
</div>

<div class="form-group col-md-6">
  <lable>Country</lable>
  <input name="p_country" id="p_country" type="text" value="{{ $user->user_profile() ? $user->user_profile()->c_country : "" }}" placeholder="Country" class="form-control input-sm">
</div>

<div class="form-group col-md-6">
  <lable>PIN</lable>
  <input name="c_pin" id="c_pin" type="text" value="{{ $user->user_profile() ? $user->user_profile()->c_address : "" }}" placeholder="PIN" class="form-control input-sm">
</div>

<div class="clear clearfix"></div>

<h4 class="sectionhead">Other Information</h4>
<div class="form-group">
  <lable>Website</lable>
    <input name="website_link" type="text" value="{{ $user->user_profile() ? $user->user_profile()->website : "" }}" placeholder="" class="form-control input-sm">
</div>

<div class="form-group">
  <lable>Online Teaching Experience? (If yes) add sample teaching video from youtube.</lable>
  <input name="online_video_link" type="text" value="{{ $user->user_profile() ? $user->user_profile()->youtube : "" }}" placeholder="" class="form-control input-sm">
</div>

<div class="form-group">
  <lable>Online Teaching Experience Level.</lable>
  <select name="exp_level" id="exp_level" class="form-control input-md">
    <option value="" disabled="">Select State</option>
    <?php $teaching_level = $user->user_profile() ? $user->user_profile()->exp_level : ""; ?>
    @foreach($list = teaching_exp() as $exp_level)
    <option {{ $teaching_level == $exp_level ? "selected" : ""}}>{{ $exp_level }}</option>
    @endforeach
  </select>
</div>


<div class="clear clearfix"></div>
<div class="col-md-12">
<span class="opensans">

  <input name="allow_contact" type="checkbox" @if($contact_visibility = $user->user_profile() ? $user->user_profile()->contact_visibility : 0 == 1) checked="" @endif value="1" style="display: inline-block;"> Allow displaying my contact info.</span> <br />
  <p class="opensans" style="color:red;">Note: This will display your phone number and your email address in the profile page.</p><br />
</div>
          
<div align="center"><button type="submit" class="btn rightNavActive" type="button" style="width:150px;">  Save  </button></div>

{!! Form::close() !!}