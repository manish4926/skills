@extends('partials.sidebar')

@section('basecontent')

@push('topscripts')
<style>
.form-control {
    background-color: #f9f9f9;
}

.sectionhead {
    border-bottom: 2px dotted #cfcfcf;
    border-top: 2px dotted #cfcfcf;
    font-family: "PT Sans";
    font-size: 14px;
    font-weight: bold;
    padding-bottom: 10px;
    padding-top: 10px;
    text-transform: uppercase;
}

.thumbnail{
    height: 71px;
    width:75px;
    margin-left: 5px;
    float:left;
}

.textHover {
    background-color: #b7b7b7;
    color: white;
    cursor: pointer;
    display: none;
    height: 100%;
    left: 0;
    opacity: 0.93;
    padding: 22px;
    position: absolute;
    text-align: center;
    top: 0;
    width: 100%;
}

.imgContain {
    display: table;
    position: relative;
    margin-top: -3px;
    float: left;
}

.imgContain:hover .textHover {
    display:block;
}
</style>
@endpush

{!! Form::open(['url' => '/market/add', 'id' => 'frmpost', 'files'=> true, 'form-horizontal', 'class' => '']) !!}
<input name="post_status" id="post_status" type="hidden" value="1">
<input name="images_uploaded" id="images_uploaded" type="hidden" value="">
<br />

<h4 class="sectionhead">Sell your own Items.</h4>
<h4 class="sectionhead"><i class="glyphicon glyphicon-file"></i> Main Details</h4>
<div class="form-group" style="width:100%;float:left;">
	<input name="title" id="title" type="text" value="" placeholder="*Title" class="form-control input-sm">
</div>
<div class="form-group"  style="width:100%;float:left;">
    <textarea name="body" id="body" class="form-control input-sm" placeholder="*Body" style="height:190px;"></textarea>
</div>
<div class="form-group" style="width:100%;float:left;">
    <input name="author" id="" type="text" value="" placeholder="Author Name" class="form-control input-sm">
</div>
<div class="form-group" style="width:100%;float:left;">
    <input name="price" id="price" type="text" value="" placeholder="*Price (INR)" class="form-control input-sm">
</div>
<div class="form-group" style="width:100%;float:left;">
	<input name="discount" id="discount" type="text" value="" placeholder="Discount Price (INR)" class="form-control input-sm">
</div>
<div class="form-group" style="width:100%;float:left;">
	<input name="priority" id="priority" type="text" placeholder="Set Priority" class="form-control input-sm">
</div>
<div class="form-group" style="width:100%;margin-left:25px;float:right;">
    <select size="1" name="category" id="category" class="form-control input-sm">
	    <option selected="" disabled="">*Please Select Category</option>
        <option value="Books">Books</option>
        <option value="Competitive Examination books">Competitive Examination books</option>
        <option value="Education stuff">Education stuff</option>
        <option value="Educational DVD/Software">Educational DVD/Software</option>
        <option value="Notes">Notes</option>
        <option value="Promotion">Promotion</option>
        <option value="Tutorial Hours">Tutorial Hours</option>
	</select>
</div>
<div class="clear clearfix"></div>

<h4 class="sectionhead"><i class="glyphicon glyphicon-picture"></i> Upload your item photos ( 5 images ) </h4>
<div id="resultx">   </div>
<img onclick="document.getElementById('images').click(); return false" style="cursor: pointer;float:left;" src="{{asset('img/icons/upload.png')}}" alt="" border="0">
<div class="gallery" id="images_preview" style="float: left;width: 373px;">
</div>
<div class="clear clearfix"></div>
	<div class="uploading none" style="display:none;">
		<img src="{{asset('img/ajax-loader.gif')}}"/>
    </div>
	<p class="opensans">Note: You can select multiple images and at least one image is required.</p>
	<div class="clear clearfix"></div>
	<h4 class="sectionhead"><i class="glyphicon glyphicon-user"></i> Contact Details</h4>
	<div class="form-group">
	Select State
        <select size="1" name="category" id="category" class="form-control input-sm">
            <option selected="" disabled="">*Please Select State</option>
            @foreach(state() as $key =>$states) 
                
                <option value="{{ $key }}">{{ $key }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
	    <input name="phone" id="phone" type="text" placeholder="*Phone Number" value="" class="form-control input-sm">
    </div>
    <div class="form-group">
	    <input name="email" id="email" type="email" placeholder="Email Address" readonly=""  value="{{ $user->email }}" class="form-control input-sm">
    </div>

    <div class="form-group">
	    <input name="address" id="address" type="text"  placeholder="*Address" value="" class="form-control input-sm">
	    <br /><p class="opensans">Note: Your contact details will be published with the ad.<br />
	    <input name="show" type="checkbox" value="ON" style="display: inline;"> Allow visitors to see my phone number and email address.
	    </p>
    </div>

    <br />

    <div align="center">
        <button class="btn rightNavActive" onclick="control_validate(1)" type="button" style="width:150px;">  Publish  </button>
        <button class="btn rightNavActive" onclick="control_validate(0)" type="button" style="width:150px;">  Save As Draft  </button>
    </div>
    <br />
{!! Form::close() !!}
@endsection