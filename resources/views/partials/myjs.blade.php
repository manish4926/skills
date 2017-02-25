<script>
function change_account_type(id) {
  if(id == 1) {
    $("#tdiv").css('display','none');
    $("#fname").css('display','block');
    $("#lname").css('display','block');
    
  }
  if(id == 2) {
    
    $("#tdiv").css('display','none');
    $("#fname").css('display','block');
    $("#lname").css('display','block');
  }
  if(id == 3) {

    $("#tdiv").css('display','block');
    $("#tlabel").text('School/ Institute');
    $("#tname").attr("placeholder", "School/ Institute").blur();
    $("#fname").css('display','none');
    $("#lname").css('display','none');

  }
  if(id == 4) {
    $("#tdiv").css('display','block');
    $("#tlabel").text('Organisation Name');
    $("#tname").attr("placeholder", "Organisation Name").blur();
    $("#fname").css('display','none');
    $("#lname").css('display','none');
   }
}

function changeTag(id)  //Change Tab in Group Page
{
  $("#tab1").removeClass('tabtechactive');
  $("#tab2").removeClass('tabtechactive'); 
  $("#tab1").removeClass('tabtech');
  $("#tab2").removeClass('tabtech');

 
  if(id == 1)
  {
    $("#tab1").addClass('tabtech');
    $("#tab2").addClass('tabtechactive');
  }
  else
  {
    $("#tab2").addClass('tabtech');
    $("#tab1").addClass('tabtechactive');
  }
}

function $post_follow()
{  

  var group_id = $(this).data('id');
  
  $.ajax({
    type: "POST",
    url: '{{ route('groupfollow') }}',
    data: { group_id: group_id, '_token': $('input[name=_token]').val()} ,
    success: function(data)
    {
      alert('txf');
      $(this).closest('button').hide();
      $(this).hide();
      $(this).css({"background-color":"grey"});
      //$(this).parents('div').fadeOut;
    }

  });

}

function $post_unfollow()
{   
  var group_id = $(this).data('id');

  $.ajax({
    type: "POST",
    url: '{{ route('groupunfollow') }}',
    data: { group_id: group_id, '_token': $('input[name=_token]').val()} ,
    success: function(data)
    {
      //$(this).closest('button').text('Mnish');
      $(this).closest('button').hide();
      //$(this).parents('div').fadeOut;
    }

  });
}

/* Market JS*/

function updatemarketstatus(id,type) {
  $.ajax({
    type: "POST",
    url: '{{ route('updateMarketStatus') }}',
    data: { id: id,type: type, '_token': $('input[name=_token]').val()} ,
    success: function(data)
    {
      if(data == 'Error Occured')
      {
        toastr["error"](data);
      }
      else {
        toastr["success"](data);
      }
      
    }

  });
}


/* End Market JS*/

/* File Uploader*/
function loadCSSIfNotAlreadyLoadedForSomeReason () {
  var ss = document.styleSheets;
  for (var i = 0, max = ss.length; i < max; i++) {
    if (ss[i].href == "")
      return;
    }
    var link = document.createElement("link");
    link.rel = "stylesheet";
    link.href = "";
    document.getElementsByTagName("head")[0].appendChild(link);
}

loadCSSIfNotAlreadyLoadedForSomeReason();

var fileUploader = function() {
}

var operationsArray={};
var filesDictionary={};
var __isUploadingFiles=false;
var __nextId=0;
fileUploader.changeSubmitButtonState = function(){
  try{
      changePostButtonState();
  }
  catch (e){
  }
}

fileUploader.dispatch = function(file,thread_id){
    var data = new FormData();
    data.append("file",file);
    data.append("_token","{{ csrf_token() }}");

    var http = new XMLHttpRequest();
    var url = "/upload";
    http.open("POST", url, true);
    console.log(data.length);
    //http.setRequestHeader("Content-Length",file.size);

    operationsArray[thread_id] = http;

    http.onreadystatechange = function() {//Call a function when the state changes.
        if(http.readyState == 4 && http.status == 200) {
            var jsonResponse= JSON.parse(http.responseText);
            //filesArray.push(jsonResponse);
            filesDictionary[thread_id]= jsonResponse;
            delete operationsArray[thread_id];
            fileUploader.updateHiddenField();
            var eleid='prodiv'+thread_id;
            document.getElementById(eleid).style.visibility = "hidden";
            document.getElementById(eleid).style.minWidth ="0";
            document.getElementById(eleid).style.width ="0";
            //document.getElementById(eleid).parentElement.removeChild(eleid);
        }
        else if(http.readyState == 4){
          delete operationsArray[thread_id];
          var eleid='progress'+thread_id;
          // document.getElementById(eleid).parentNode.removeChild(eleid);
        }

        if(fileUploader.isEmptyObject(operationsArray)){
          __isUploadingFiles=false;
          fileUploader.changeSubmitButtonState();
        }
    }

    http.upload.onprogress = function(e){
      var pc = parseInt((e.loaded / e.total) * 100);
      var eleid='progress'+thread_id;
      //console.log(eleid);
      var ele=document.getElementById(eleid);
      console.log(ele);

      ele.style['width'] = pc+"%";
      //console.log(thread_id+" progress ("+ e.loaded+","+ e.total+") = "+pc);
    }

    __isUploadingFiles=true;
    fileUploader.changeSubmitButtonState();
    http.send(data);
}

fileUploader.isEmptyObject = function(obj){
    for (var key in operationsArray) {
      return false;
    }
    return true;
}

fileUploader.cancel= function(thread_id){
    if (operationsArray[thread_id]!= null ){
      operationsArray[thread_id].abort();
      delete operationsArray[thread_id];
    }
}

fileUploader.cancelAll= function(){
  for (var key in operationsArray) {
    if (operationsArray.hasOwnProperty(key)) {
        operationsArray[key].abort();
        delete operationsArray[key];
    }
  }

}

fileUploader.removeDownloaded = function(file_id){
  if (filesDictionary.hasOwnProperty(file_id) ){
    delete filesDictionary[file_id];
  }
}

fileUploader.removeAllDownloaded = function(){
  filesDictionary={};
}

fileUploader.updateHiddenField = function(){
  if(fileUploader.isEmptyObject(operationsArray)) {
    var filehiddenfield = document.getElementById('__files_uploaded');
    var filesArray=[];
    try{
      for(var key in filesDictionary){
        filesArray.push(filesDictionary[key]);
      }
    }
    catch(e){
    }

    filehiddenfield.value = '{"files":' + JSON.stringify(filesArray) + '}';
  }
}

fileUploader.remove = function(file){
  fileUploader.cancel(file.id);
  fileUploader.removeDownloaded(file.id);
  fileUploader.updateHiddenField();
  file.parentNode.removeChild(file);
  fileUploader.resetId();
}

fileUploader.resetId = function(){
  __nextId=0;
}

function uploadFiles(__files){
  //fileUploader.dispatch(__files,"file");
  console.log(__files);
  var txt = "";
  if (__files.length == 0) {
    txt = "Select one or more files.";
  } else {
    for (var i = 0; i < __files.length; i++) {
      var file = __files[i];
      var file_id="file"+(__nextId+1);
      __nextId++;
      fileUploader.dispatch(file,file_id);
      txt += '<div id="'+file_id+'" style="float:top; margin-right: 12px; "><span style="font-size: 13px;float:left; color: #777777; font-weight: bold;">'+
      '<img src="/img/icons/blank.jpg" style="width: 18px; height: 18px; margin-right: 5px; margin-top: -2px;"/>'+file.name+'</span>&nbsp;'+
      '<div id="prodiv'+file_id+'" style="float:left;min-width:50px; min-height: 10px; background-color: #888888; max-height: 10px; margin-top:3px;margin-right: 10px; margin-left: 10px;">'+
      '<div id="progress'+file_id+'" style="width:0%; min-height: 10px; background-color: #0000ff;max-height: 05px;float: left; position: relative; display: block;"></div>'+
      '</div>'+
      '<a href="javascript:fileUploader.remove('+file_id+')" id="__file'+(i+1)+'" style="float:left;"><img src="/img/icons/delete.png" style="max-height: 14px;float:left;"/></a><br/></div>';
      //txt += "<br><strong>" + (i+1) + ". file</strong><br>";
      if ('name' in file) {
        //txt += "name: " + file.name + "<br>";
      }

      if ('size' in file) {
        // txt += "size: " + file.size + " bytes <br>";
      }
    }
  }

  return txt;
}

function filesChanged(){
  console.log("files changed");
  var __files;
  //fileUploader.cancelAll();
  //fileUploader.removeAllDownloaded();
  //$("#__filescontent").html('');
  var x = document.getElementById("__files");
  var txt="";
  if ('files' in x) {
    __files= x.files;
    txt=uploadFiles(__files);
  }
  else {
    if (x.value == "") {
      txt += "Select one or more files.";
    } else {
      txt += "The files property is not supported by your browser!";
      txt  += "<br>The path of the selected file: " + x.value;
    }
  }

  contentele=document.getElementById("__filescontent");

  if(contentele!=null){
    contentele.innerHTML += txt;
  }
}

function uploadButtonPressed(){
    $("input#__files").val('');
    $("input#__files").click();
    return false;
}

/* End File Uploader*/
</script>