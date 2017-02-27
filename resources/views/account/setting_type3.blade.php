<div class="form-group col-md-12">
    <lable>School /College Name <small style="color:red;">*</small></lable>
    <input name="name" required type="text" value="{{$user->name }}" placeholder="School /College Name" class="form-control input-sm">
</div>

<div class="form-group col-md-6">
    <lable>Category Of School/Institute*</lable>
    <input name="category_school" id="cate" type="text" value="{{ $user->user_profile() ? $user->user_profile()->school_category : "" }}" placeholder="Category Of School/Institute*" class="form-control input-sm">
</div>
<div class="clear clearfix"></div>
<h4 class="sectionhead">Contact and Address Information</h4>

<div class="form-group col-md-12" style="width:98%;float:left;">
<lable>Principal/ Chairman / Chancellor</lable>
<input name="p_person" id="p_person"  type="text" value="{{ $user->user_profile() ? $user->user_profile()->permanent_person : "" }}" placeholder="" class="form-control input-sm">
</div>

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
  
  <input name="c_city" id="c_city" type="text" value="{{ $user->user_profile() ? $user->user_profile()->c_city : "" }}" placeholder="City" class="form-control input-sm">
</div>

<div class="form-group col-md-6">
  <lable>Country</lable>
  <input name="c_country" id="c_country" type="text" value="{{ $user->user_profile() ? $user->user_profile()->c_country : "" }}" placeholder="Country" class="form-control input-sm">
</div>

<div class="form-group col-md-6">
  <lable>PIN</lable>
  <input name="c_pin" id="c_pin" type="text" value="{{ $user->user_profile() ? $user->user_profile()->c_address : "" }}" placeholder="PIN" class="form-control input-sm">
</div>

<div class="form-group col-md-6">
    <lable>Telephone</lable>
    <input name="p_mobile" id="p_mobile"  type="text" value="{{ $user->user_profile() ? $user->user_profile()->telephone : "" }}" placeholder="Office Telephone" class="form-control input-sm">
</div>

<div class="form-group col-md-6">
    <lable>Email Address</lable>
    <input name="p_email" id="p_email"  type="email"  value="{{ $user->user_profile() ? $user->user_profile()->office_email : "" }}" placeholder="Office Email" class="form-control input-sm">
</div>

<div class="clear clearfix"></div>
<h4 class="sectionhead">Other Information</h4>
<div class="form-group col-md-12">
  <lable>Website</lable>
    <input name="website_link" type="text" value="{{ $user->user_profile() ? $user->user_profile()->website : "" }}" placeholder="" class="form-control input-sm">
</div>

<div align="center"><button class="btn rightNavActive" type="submit" style="width:150px;">  Save  </button></div>