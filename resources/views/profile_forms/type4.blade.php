 <div id="frmtype{{$type}}" style="background-color:#F5F5F5;padding: 50px; margin: 10px;display:none;">

 <form type="POST" id="frmpost{{$type}}" name="frmpost{{$type}}" action="">

 <input name="id_type{{$type}}" id="id_type{{$type}}" type="hidden" value="0">

 <input name="type" type="hidden" value="{{$type}}">

 <input name="f7" id="text_type{{$type}}_f7" type="hidden" value="">

 <input name="f8" id="text_type{{$type}}_f8" type="hidden" value="">

 <input name="f9" id="text_type{{$type}}_f9" type="hidden" value="">

  <div class="form-group">

         <label>Name of school /Insititution <small style="color:red;">*</small></label>

         <input name="f1"  id="text_type{{$type}}_f1" type="text" value="" class="form-control">



      </div>

      <div class="form-group">

         <label>Designation & Assignments <small style="color:red;">*</small></label>

         <input name="f2" id="text_type{{$type}}_f2" type="text" value="" class="form-control">

      </div>



       <div class="form-group">

         <label>From date <small style="color:red;">*</small></label>

         <input name="f3" id="text_type{{$type}}_f3" type="text" value="" class="form-control">

      </div>



      <div class="form-group">

         <label>To date <small style="color:red;">*</small></label>

         <input name="f4" id="text_type{{$type}}_f4" type="text" value="" class="form-control">

     </div>



       <div class="form-group">

         <label>Subject Taught <small style="color:red;">*</small></label>

         <input name="f5" id="text_type{{$type}}_f5" type="text" value="" class="form-control">

      </div>



       <div class="form-group">

         <label>Class <small style="color:red;">*</small></label>

         <input name="f6" id="text_type{{$type}}_f6" type="text" value="" class="form-control">

      </div>





    <div class="form-group" align="center">

        <button type="button" class="btn opensans" style="background-color: #2bbba1;color:white;width:100px;" onclick="SaveType{{$type}}()">Save</button>

        <button type="button" class="btn opensans" style="background-color: #2bbba1;color:white;width:100px;" onclick="CloseType{{$type}}({{$type}})">Close</button>

      </div>



 {!! Form::close() !!}



 <script type="text/javascript">



 $(function() {

    $('#text_type{{$type}}_f3').datepicker( {

        changeMonth: true,

        changeYear: true,

        showButtonPanel: true,

        dateFormat: 'MM yy',

        yearRange: '1950:2015',

        onClose: function(dateText, inst) {

            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();

            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();

            $(this).datepicker('setDate', new Date(year, month, 1));

        }

    });

});





 $(function() {

    $('#text_type{{$type}}_f4').datepicker( {

        changeMonth: true,

        changeYear: true,

        showButtonPanel: true,

        dateFormat: 'MM yy',

        yearRange: '1950:2015',

        onClose: function(dateText, inst) {

            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();

            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();

            $(this).datepicker('setDate', new Date(year, month, 1));

        }

    });

});



    </script>



 <script>



  function editType{{$type}}(id,id2)

    {   $("#sectioncontent_"+id2).css('display','none');

   $("#frmtype"+id2).css('display','block');

   $("#id_type{{$type}}").val(""+id+"");

   $("#text_type{{$type}}_f1").val($("#f1_profileitem_"+id).text());

   $("#text_type{{$type}}_f2").val($("#f2_profileitem_"+id).text());

   $("#text_type{{$type}}_f3").val($("#f3_profileitem_"+id).text());

   $("#text_type{{$type}}_f4").val($("#f4_profileitem_"+id).text());

   $("#text_type{{$type}}_f5").val($("#f5_profileitem_"+id).text());

   $("#text_type{{$type}}_f6").val($("#f5_profileitem_"+id).text());

    }



   function removeType{{$type}}(id)

    {



    }



    function CloseType{{$type}}(id)

     {

    $("#sectioncontent_"+id).css('display','block');

   $("#frmtype"+id).css('display','none');

   $("#id_type{{$type}}").val("0");   $("#text_type{{$type}}_f1").val("");

   $("#text_type{{$type}}_f2").val("");

   $("#text_type{{$type}}_f3").val("");

   $("#text_type{{$type}}_f4").val("");

   $("#text_type{{$type}}_f5").val("");

   $("#text_type{{$type}}_f6").val("");

     }



    function SaveType{{$type}}()

     {



         if($("#text_type{{$type}}_f1").val() == "")

           {

         alert("Please insert 'Name of school /Insititution' text.");

          $("#text_type{{$type}}_f1").focus();

           }

     else if($("#text_type{{$type}}_f2").val() == "")

           {

          alert("Please insert 'Designation & Assignments' text.");

          $("#text_type{{$type}}_f2").focus();

           }

     else if($("#text_type{{$type}}_f3").val() == "")

           {

          alert("Please insert 'From Date' text.");

          $("#text_type{{$type}}_f3").focus();

           }

     else if($("#text_type{{$type}}_f4").val() == "")

           {

          alert("Please insert 'To Date' text.");

          $("#text_type{{$type}}_f4").focus();

           }

    else if($("#text_type{{$type}}_f5").val() == "")

           {

          alert("Please insert 'Subject Taught' text.");

          $("#text_type{{$type}}_f5").focus();

           }

    else if($("#text_type{{$type}}_f6").val() == "")

           {

          alert("Please insert 'Class' text.");

          $("#text_type{{$type}}_f6").focus();

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