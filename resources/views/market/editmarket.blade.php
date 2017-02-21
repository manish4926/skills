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

{!! Form::open(['route' => 'editMarketSubmit', 'id' => 'frmpost', 'files'=> true, 'form-horizontal', 'class' => '']) !!}
<input name="post_status" id="post_status" type="hidden" value="1">
<input name="post_id" type="hidden" value="{{ $mymarket->id }}">
<input name="images_uploaded" id="images_uploaded" type="hidden" value="">
<br />

<h4 class="sectionhead">Sell your own Items.</h4>
<h4 class="sectionhead"><i class="glyphicon glyphicon-file"></i> Main Details</h4>
<div class="form-group" style="width:100%;float:left;">
	<input name="title" id="title" type="text" value="{{ $mymarket->title }}" placeholder="*Title" class="form-control input-sm">
</div>
<div class="form-group"  style="width:100%;float:left;">
    <textarea name="body" id="body" class="form-control input-sm" placeholder="*Body" style="height:190px;">{{ $mymarket->description }}</textarea>
</div>
<div class="form-group" style="width:100%;float:left;">
    <input name="author" id="" type="text" value="{{ $mymarket->author_name }}" placeholder="Author Name" class="form-control input-sm">
</div>
<div class="form-group" style="width:100%;float:left;">
    <input name="price" id="price" type="text" value="{{ $mymarket->price }}" placeholder="*Price (INR)" class="form-control input-sm">
</div>
<div class="form-group" style="width:100%;float:left;">
	<input name="discount" id="discount" type="text" value="{{ $mymarket->discount }}" placeholder="Discount Price (INR)" class="form-control input-sm">
</div>
<div class="form-group" style="width:100%;float:left;">
	<input name="priority" id="priority" type="text" value="{{ $mymarket->priority }}" placeholder="Set Priority" class="form-control input-sm">
</div>
<div class="form-group" style="width:100%;margin-left:25px;float:right;">
    <select size="1" name="category" id="category" class="form-control input-sm">
	    <option disabled="">*Please Select Category</option>
        <option value="Books" {{ $mymarket->priority == "Books" ? "selected" : "" }}>Books</option>
        <option value="Competitive Examination books" {{ $mymarket->priority == "Competitive Examination books" ? "selected" : "" }}>Competitive Examination books</option>
        <option value="Education stuff" {{ $mymarket->priority == "ducation stuff" ? "selected" : "" }}>Education stuff</option>
        <option value="Educational DVD/Software" {{ $mymarket->priority == "Educational DVD/Software" ? "selected" : "" }}>Educational DVD/Software</option>
        <option value="Notes" {{ $mymarket->priority == "Notes" ? "selected" : "" }}>Notes</option>
        <option value="Tutorial Hours" {{ $mymarket->priority == "Tutorial Hours" ? "selected" : "" }}>Tutorial Hours</option>
	</select>
</div>
<div class="clear clearfix"></div>

<h4 class="sectionhead"><i class="glyphicon glyphicon-picture"></i> Upload your item photos ( 5 images ) </h4>
<div id="resultx">   </div>
<img onclick="document.getElementById('images').click(); return false" style="cursor: pointer;float:left;" src="{{asset('img/icons/upload.png')}}" alt="" border="0">

@if ($mymarket->images != "")
@foreach(explode(',', $mymarket->images) as $images)
<div class="imgContain" id="ssl<?php echo md5($mymarket->images); ?>" onclick="$('#ssl{{ md5($images) }}').remove()">

    <img class="grayscale" style="float: left;height: 70px;margin: 3px;width: 70px;border: 2px solid #ffffff;border-radius: 5px;" src="{{ asset('img/books/' . $images) }}" alt="">

    <div class="textHover" align="center"><img src="<?php echo asset('img/icons/trash.png'); ?>" border="0"></div>

    <input name="images_ids[]" type="hidden" value="<?php echo $images; ?>">

</div>
@endforeach
@endif


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
        <select size="1" name="location" id="location" class="form-control input-sm">
            <option disabled="">*Please Select State</option>
            @foreach(state() as $key =>$states) 
                
                <option value="{{ $key }}" {{ $mymarket->location == $key ? "selected" : "" }}>{{ $key }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
	    <input name="phone" id="phone" type="text" placeholder="*Phone Number" value="{{ $mymarket->phone }}" class="form-control input-sm">
    </div>
    <div class="form-group">
	    <input name="email" id="email" type="email" placeholder="Email Address" readonly=""  value="{{ $user->email }}" class="form-control input-sm">
    </div>

    <div class="form-group">
	    <input name="address" id="address" type="text"  placeholder="*Address" value="{{ $mymarket->address }}" class="form-control input-sm">
	    <br /><p class="opensans">Note: Your contact details will be published with the ad.<br />
	    <input name="show" type="checkbox" value="1" {{ $mymarket->contact_visibility == 1 ? "checked" : "" }} style="display: inline;"> Allow visitors to see my phone number and email address.
	    </p>
    </div>

    <br />

    <div align="center">
        <button class="btn rightNavActive" onclick="control_validate(1)" type="button" style="width:150px;">  Publish  </button>
        <button class="btn rightNavActive" onclick="control_validate(0)" type="button" style="width:150px;">  Save As Draft  </button>
    </div>
    <br />
{!! Form::close() !!}

<!--IMAGE UPLOAD-->
<div class="upload_div">

{!! Form::open(['route' => 'addMarketImageSubmit', 'id' => 'multiple_upload_form' , 'name' => 'multiple_upload_form', 'files'=> true, 'form-horizontal', 'class' => 'facebook-share-box']) !!}

<input type="hidden" name="image_form_submit" value="1"/>

<input type="file" name="images[]" accept=".jpg, .jpeg, .png" id="images" style="visibility: hidden; width: 1px; height: 1px"  multiple >

{!! Form::close() !!}
</div>

@push('bottomscripts')
<script>
function control_validate(id)
{
    var values = $("input[name='images_ids[]']").map(function(){return $(this).val();}).get();
    $("#images_uploaded").val(""+values+"");
    var theval = $('input[name="images_ids[]"]').length;
    if($("#title").val() == "")
    {
        alert("Please enter the item title.");
        $("#title").focus();
        $(window).scrollTop(0);
    }
    else if($("#body").val() == "")
    {    
        alert("Please enter the item body.");
        $("#body").focus();
        $(window).scrollTop(0);
    }
    else if($("#price").val() == "")
    {
        alert("Please enter the item price.");
        $("#price").focus();
        $(window).scrollTop(0);
    }
    else if($("#discount").val() != "" && isNaN($("#discount").val()))
    {
        alert("Please enter the numeric value.");
        $("#discount").focus();
        $(window).scrollTop(0);
    }
    else if($("#category :selected").val() == 0)
    {
        alert("Please choose the item category.");
        $("#category").focus();
        $(window).scrollTop(0);
    }
    else if(theval == "0")
    {
        alert("Please choose the item images.");
        $(window).scrollTop(0);
    }
    else if (theval > 5){
        alert("You can only upload a maximum of 5 images");
    }
    else if($("#phone").val() == "")
    {
        alert("Please enter your phone number.");
    }
    else if($("#email").val() == "")
    {
        alert("Please enter your email address.");
    }
    else if($("#address").val() == "")
    {
        alert("Please enter your address.");
    }
    else
    {
        $("#post_status").val(id);
        $("#frmpost").submit();
    }
}

$(document).ready(function(){
    $('#images').on('change',function(){
        $('#multiple_upload_form').ajaxForm({
            target:'#images_preview',
            beforeSubmit:function(e){
                $('.uploading').show();
                //$("#mypostbutton").prop('disabled', true);
            },
            success:function(e){
                $('.uploading').hide();
                //$("#mypostbutton").prop('disabled', false);
            },
            error:function(e){
            }
        }).submit();
    });
});
</script>
@endpush
@endsection