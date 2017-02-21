 <div id="frmtype{{$type}}" style="background-color:#F5F5F5;padding: 50px; margin: 10px;display:none;">

 <form type="POST" id="frmpost{{$type}}" name="frmpost{{$type}}" action="">

 <input name="id_type{{$type}}" id="id_type{{$type}}" type="hidden" value="0">

 <input name="type" type="hidden" value="{{$type}}">

 <input name="f2" id="text_type{{$type}}_f2" type="hidden" value="">

 <input name="f3" id="text_type{{$type}}_f3" type="hidden" value="">

 <input name="f4" id="text_type{{$type}}_f4" type="hidden" value="">

 <input name="f5" id="text_type{{$type}}_f5" type="hidden" value="">

 <input name="f6" id="text_type{{$type}}_f6" type="hidden" value="">

 <input name="f7" id="text_type{{$type}}_f7" type="hidden" value="">

 <input name="f8" id="text_type{{$type}}_f8" type="hidden" value="">

 <input name="f9" id="text_type{{$type}}_f9" type="hidden" value="">

  <div class="form-group">

         <label>Description <small style="color:red;">*</small></label>



         <textarea name="f1"  id="text_type{{$type}}_f1" rows=5 cols=20 class="form-control"></textarea>



      </div>







     <div class="form-group" align="center">

        <button type="button" class="btn opensans" style="background-color: #2bbba1;color:white;width:100px;" onclick="SaveType{{$type}}()">Save</button>

        <button type="button" class="btn opensans" style="background-color: #2bbba1;color:white;width:100px;" onclick="CloseType{{$type}}({{$type}})">Close</button>

      </div>





 {!! Form::close() !!}



 <script>



  function editType{{$type}}(id,id2)

    {

   $("#sectioncontent_"+id2).css('display','none');

   $("#frmtype"+id2).css('display','block');

   $("#id_type{{$type}}").val(""+id+"");

   $("#text_type{{$type}}_f1").val($("#f1_profileitem_"+id).text());

    }



   function removeType{{$type}}(id)

    {



    }



    function CloseType{{$type}}(id)

     {

    $("#sectioncontent_"+id).css('display','block');

   $("#frmtype"+id).css('display','none');

   $("#id_type{{$type}}").val("0");

   $("#text_type{{$type}}_f1").val("");

   $("#text_type{{$type}}_f2").val("");

   $("#text_type{{$type}}_f3").val("");

   $("#text_type{{$type}}_f4").val("");

     }



   function SaveType{{$type}}()

     {



      if($("#text_type{{$type}}_f1").val() == "")

           {

         alert("Please insert 'Description' text.");

          $("#text_type{{$type}}_f1").focus();

           }

           else

           {

     var url = "{{ route('saveTypeItem')}}";



		 $.ajax({

           type: "GET",

           url: url,

           data: $("#frmpost{{$type}}").serialize(), // serializes the form's elements.

           success: function(data)

           {

               if(data == '1')

                {

            $("#section_{{$type}}").append("Saving ...");

            $("#section_{{$type}}").remove();

            get_section({{$type}});

                }

           }

         });



         }

     }

 </script>

 </div>