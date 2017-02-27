  @extends('partials.sidebar')

@section('basecontent')

<div class="col-md-12">
<div style="background-image: url('{{asset('img/diversity.jpg')}}'); min-width: 100%; min-height: 100px; background-size: cover; margin-bottom: 0px;"></div>
  <div style=" width: 100%; min-height:200px; padding-top: 20px; display: inline-block; background-color: white;">
    <h3 class="opensans pull-inside-image" style="padding-right: 15px; padding-left: 15px; margin-top: 5px;"><img src="{{ asset('img/profile/'.$internship->post_admin()->profile_pic) }}" style="max-width: 70px; max-height:70px; margin-right: 10px; border-color: #cccccc; border-width: thin; border-style: solid; border-width: 1px; "><b>{{ $internship->title }}</b></h3>
    <div style="padding-right: 15px; padding-left: 15px; margin-left: 0; margin-top: 0px; font-size: 11px; min-width:100%; float:left;">Last updated: {{ timestampToDate($internship->updated_at)}}</div>
    <br>  
  <div>

  <div style="padding-right: 15px; padding-left: 15px; margin-left: 0; margin-top: 20px; font-size: 14px; min-width:100%; float:left;">
    <b>Location:</b> {{ $internship->location }}<br>
    <b>Duration:</b> {{ $internship->duration }}<br>
    <b>Number of Internships:</b> {{ $internship->openings_count }} <br>
    <b>Internship Amount:</b> {{ $internship->stipend_amount }}
  </div>

  <div style="padding-left: 15px; padding-right: 15px; padding-top: 20px; margin-left: 0; margin-top: 20px; font-size: 13px; min-width:100%; float:left; background-color: #f0f2f0;">
    <div class="opensans"> <span class="sectionTitle"> Pre-requisits:</span><br> <h5 class="sectionBody opensans">{{ $internship->prerequisits }}</h5><br></div>
    <div class="opensans"><span class="sectionTitle">Brief Summary:</span><br> <h5 class="sectionBody opensans">{{ $internship->brief_summary }}</h5><br></div>
    <div class="opensans"><span class="sectionTitle">Requirements to Apply:</span><br> <h5 class="sectionBody opensans">{{ $internship->qualifications }}</h5><br></div>
    <div class="opensans"><span class="sectionTitle">About Corporation/School:</span><br> <h5 class="sectionBody opensans">{{ $internship->about_company }}</h5><br></div>
    <div class="opensans"> <span class="sectionTitle">Deliverables:</span><br> <h5 class="sectionBody opensans">{{ $internship->deliverables }}</h5><br></div>
    <div class="opensans"> <span class="sectionTitle">Internship Details:</span><br> <h5 class="sectionBody opensans">{{ $internship->details }}</h5><br></div>
    <div class="opensans" style="display: inline-block; width: 100%;"><span class="sectionTitle">Attachements:</span><b>
      </b>
      <div style="width:100%;"><b>
        <div class="sectionBody opensans" style="display: inline-block;"><div style="float:left; position:relative;"><a target="_blank" href="#">myjs.blade.php</a></div></div>
        </b>
      </div>
    </div>
    @if($internship->daysleft < 0)
      @if(!empty($internship->link))
        <a href="{{$internship->link}}" class="btn btn-success btn-group-lg edu-bg-green " style="width: 200px; margin-top: 20px; margin-bottom: 50px;">Apply Now</a> 
      @else
      <div style="min-height: 20px;"></div>
      <div class="opensans" id="cvdiv"><span class="sectionTitle">Upload Resume:</span><div class="sectionBody opensans" style="display: inline-block;">
      <input type="hidden" name="files_uploaded" id="__files_uploaded" value="">

      <input type="file" class="upload-file-input" id="__files" onchange="filesChanged()" style="float: left; visibility: hidden; max-width: 0;">

      <a href="" class="btn btn-default upload-icon-a" onclick="uploadButtonPressed(); return false;" style="float: left; margin-right: 15px;"><i style="font-size: 18px;" class="glyphicon glyphicon-upload"></i></a>

      <br><div id="__filescontent" style="max-width: 700px; float: left;"></div>
      </div><br></div>
      <button id="applyButton" class="btn edu-bg-green" style="color: #fff; font-size: 14px; height: 30px; width: 200px; margin-top: 20px; margin-bottom: 100px; display: inline-block;" onclick="applyNow()">APPLY NOW</button>
      <div id="appliedDiv" style="background-color: #e85353; border-color: #e85353; color: #eee; visibility: hidden; margin-top: 20px; margin-bottom: 100px;"> You have successfully applied to the internship</div>
      <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
      @endif
    @endif
  </div>
  </div>
  </div>
</div>
@push('bottomscripts')
<script type="text/javascript">
function do_reply()
{  
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

    var application_id    = '{{ $internship->id }}';
    var files             = $('#files_uploaded').text();
    $.ajax({
    type: "POST",
    url: '{{ route('sendMessage') }}',
    data: { application_id: application_id, files: files, '_token': $('input[name=_token]').val() } ,
    success: function(data)
    {
      toastr["success"]("You have successfully applied to the internship");
    }

    });

}
</script>
@endpush
@endsection