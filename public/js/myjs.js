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
  
  var url = "{{ route('groupfollow') }}";
  var group_id = $(this).data('id');

  $.ajax({
    type: "POST",
    url: url,
    data: { group_id: group_id} ,
    success: function(data)
    {
      //$(this).closest('button').text('Mnish');
      $(this).text('Mnish');
      //$(this).parents('div').fadeOut;
    }

});

}

function $post_unfollow()
{   
  
  var url = "{{ route('groupunfollow') }}";
  var group_id = $(this).data('id');

  $.ajax({
    type: "POST",
    url: url,
    data: { group_id: group_id} ,
    success: function(data)
    {
      //$(this).closest('button').text('Mnish');
      $(this).parents('.col-md-12').hide();
      //$(this).parents('div').fadeOut;
    }

});

}
