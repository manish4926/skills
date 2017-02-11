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