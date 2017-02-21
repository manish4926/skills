 <div id="frmtype{{$type}}" style="background-color:#F5F5F5;padding: 50px; margin: 10px;display:none;">

 <form type="POST" id="frmpost{{$type}}" name="frmpost{{$type}}" action="">

 <input name="id_type{{$type}}" id="id_type{{$type}}" type="hidden" value="0">

 <input name="type" type="hidden" value="{{$type}}">

 <input name="f9" id="text_type{{$type}}_f9" type="hidden" value="">



      <div class="form-group">

         <label>Branch Name <small style="color:red;">*</small></label>

         <input name="f1"  id="text_type{{$type}}_f1" type="text" value="" class="form-control">

      </div>



        <div class="form-group">

         <label>Contact Person <small style="color:red;">*</small></label>

         <input name="f2"  id="text_type{{$type}}_f2" type="text" value="" class="form-control">

      </div>



        <div class="form-group">

         <label>Address <small style="color:red;">*</small></label>

         <input name="f3"  id="text_type{{$type}}_f3" type="text" value="" class="form-control">

      </div>



        <div class="form-group">

         <label>City <small style="color:red;">*</small></label>

         <input name="f4"  id="text_type{{$type}}_f4" type="text" value="" class="form-control">

      </div>



        <div class="form-group">

         <label>State <small style="color:red;">*</small></label>

         <input name="f5"  id="text_type{{$type}}_f5" type="text" value="" class="form-control">

      </div>



        <div class="form-group">

         <label>Country <small style="color:red;">*</small></label>

         <input name="f6"  id="text_type{{$type}}_f6" type="text" value="" class="form-control">

      </div>



      <div class="form-group">

         <label>Telephone <small style="color:red;">*</small></label>

         <input name="f7"  id="text_type{{$type}}_f7" type="text" value="" class="form-control">

      </div>



      <div class="form-group">

         <label>Email <small style="color:red;">*</small></label>

         <input name="f8"  id="text_type{{$type}}_f8" type="text" value="" class="form-control">

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

   $("#text_type{{$type}}_f2").val($("#f2_profileitem_"+id).text());

   $("#text_type{{$type}}_f3").val($("#f3_profileitem_"+id).text());

   $("#text_type{{$type}}_f4").val($("#f4_profileitem_"+id).text());

   $("#text_type{{$type}}_f5").val($("#f5_profileitem_"+id).text());

   $("#text_type{{$type}}_f6").val($("#f6_profileitem_"+id).text());

   $("#text_type{{$type}}_f7").val($("#f7_profileitem_"+id).text());

   $("#text_type{{$type}}_f8").val($("#f8_profileitem_"+id).text());

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

   $("#text_type{{$type}}_f5").val("");

   $("#text_type{{$type}}_f6").val("");

   $("#text_type{{$type}}_f7").val("");

   $("#text_type{{$type}}_f8").val("");

     }



   function SaveType{{$type}}()

     {



       if($("#text_type{{$type}}_f1").val() == "")

           {

         alert("Please insert 'Branch Name' text.");

          $("#text_type{{$type}}_f1").focus();

           }

     else if($("#text_type{{$type}}_f2").val() == "")

           {

          alert("Please insert 'Contact Person' text.");

          $("#text_type{{$type}}_f2").focus();

           }

     else if($("#text_type{{$type}}_f3").val() == "")

           {

          alert("Please insert 'Address' text.");

          $("#text_type{{$type}}_f3").focus();

           }

     else if($("#text_type{{$type}}_f4").val() == "")

           {

          alert("Please insert 'City' text.");

          $("#text_type{{$type}}_f4").focus();

           }

    else if($("#text_type{{$type}}_f5").val() == "")

           {

          alert("Please insert 'State' text.");

          $("#text_type{{$type}}_f5").focus();

           }

      else if($("#text_type{{$type}}_f6").val() == "")

           {

          alert("Please insert 'Country' text.");

          $("#text_type{{$type}}_f6").focus();

           }

        else if($("#text_type{{$type}}_f7").val() == "")

           {

          alert("Please insert 'Telephone' text.");

          $("#text_type{{$type}}_f7").focus();

           }

        else if($("#text_type{{$type}}_f8").val() == "")

           {

          alert("Please insert 'Email' text.");

          $("#text_type{{$type}}_f8").focus();

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