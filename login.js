var btn  = document.getElementById('sub_values');
var form = document.getElementById('f_l_e_p');
var divv = document.getElementById('container');

var form_2 = document.getElementById('form_2');

form.style.border = "1px solid steelblue";
form_2.style.border = "1px solid steelblue";

var hidden = true;
var hideThree = true;

if(hidden=true)
{
    $('#form_2_section').hide();
}

if (hideThree=true)
{
    $('#form_3_section').hide();
}
function showSecondForm()
{
    $('#form_2_section').fadeIn();
}
function showThirdForm()
{
    $('#form_3_section').fadeIn();
}


//form.style.border = "1px solid black";
// first form onclick function

$(".stage2_ta").focus(function ()
{
    $(this).attr('rows', 5);
}).blur(function()
    {
        $(this).attr('rows',1);
    });

$(".stage2_ta").click(function ()
{
    $(this).val(" ");
});

btn.onclick = function()
{
    //document.getElementById('f_l_e_p').();
    var x = document.forms['f_l_e_p']['first_name'].value;
    if (x==null || x=="")
    {
        alert("First name must be filled out");
    }else
    {
        //// only do this after form validation /////
        $('#f_l_e_p').animate({  textIndent: 0 },
            { step: function(now,fx)
            {
                $(this).css('moz-box-shadow', ' inset 0 0 10px #000000');
                $(this).css('-webkit-box-shadow', 'inset 0 0 10px #000000');
                $(this).css('box-shadow', 'inset 0 0 10px #000000');
                $(this).css('border', '0px black');
            },
                duration:'fast'
            },'swing');

        $('#top').animate(
            {
                opacity: 0
            },"slow",function()
            {
                //alert("Time to call ajax script");
                hidden = false;
                document.getElementById('top').style.height = 0;
                // remove the element after ajax call.
               // document.getElementById('#entered_first_name').value = $('#first_name').val();
                var parent = document.getElementById('top');
                parent.parentNode.removeChild(parent);
                showSecondForm();
            });
    }
}

//////////////////////////////////////////////////////////////////////
// second form onclick function
window.onload = function ()
{
 document.getElementById('submit_second').onclick = function()
 {  // animate and execute ajax call.
 $('#form_2').animate({  textIndent: 0 },
 { step: function(now,fx)
 {
  // box shadow isnt showing up in firefox :( F them.
 $(this).css('moz-box-shadow', ' inset 0 0 10px #000000');
 $(this).css('-webkit-box-shadow', 'inset 0 0 10px #000000');
 $(this).css('box-shadow', 'inset 0 0 10px #000000');
 $(this).css('border', '0px black');
 },
 duration:'fast'
 },'swing');
 $('#form_2_section').animate
 (
 {
    opacity: 0
 },"slow",function()
 {
 //alert("Time to call ajax script");
     // call function to show third form//
     var parent = document.getElementById('form_2_section');
     parent.parentNode.removeChild(parent);
     hideThree =false;
     showThirdForm();
 });

 };
 
 };
 ////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////
$("#f_l_e_p input").focus(function()
{
    $('#f_l_e_p').animate({height:"75%", width :"75%"},"slow");
});
/////////////////////////////////////////////
$("#form_2 input").focus(function()
{
    $('#form_2').css({ boxShadow : "2px 2px 2px 2px #444" });
});

$(".testing input").focus(function ()
{
   $('.testing').animate({height:"75%", width :"75%"},"slow");
});

 $('#sub_values').click(function()
 {
    //alert("FUNCTION ON NATIVE PAGE CALLED");
	$('#first_entered_first_name').val($('#first_name').val());
    console.log($('#first_entered_first_name').val());
    $('#first_entered_last_name').val($('#last_name').val());
    console.log($('#first_entered_last_name').val());
    $('#first_entered_email').val($('#email').val());
    console.log($('#first_entered_email').val());
    $('#first_entered_pass').val($('#password').val());
    console.log($('#first_entered_pass').val());
 });

$('#submit_second').click(function()
{

 // alert("Submit second checked");
  
  var checked_values = Array();
  
  $('input:checkbox[name=cb]:checked').each(function()
  {
      var val = $(this).val();
	  checked_values.push(val)
  });
  /*for(var x=0; x<checked_values.length; x++)
  {
	  console.log(checked_values[x]);  	DEBUG
  }*/
  var containing_array = new Array(); 
  for(var x=0; x<checked_values.length; x++)
  {
	  containing_array.push((checked_values[x]+", "));
  }
  var container_string = containing_array.join("");
  console.log("String test: " + container_string);
  // NOW TO ADD THAT TO THE HIDDEN FORM SO IT CAN BE A $_POST VARIABLE;
  $('#first_checked_checkboxes').val(container_string);

}); 

$('#sub_passions').click(function()
{
   //alert("CLICKED");
   $('#first_passions_entered_text').val($('#passions').val());
   console.log($('#first_passions_entered_text').val());
   $('#first_one_year_entered_text').val($('#one_year').val());
   console.log($('#one_year_entered_text').val());
   $('#first_three_year_entered_text').val($('#two_year').val());
   console.log($('#three_year_entered_text').val());
   $('#first_five_year_entered_text').val($('#three_year').val());
   console.log($('#five_year_entered_text').val());
   $('#first_proud_text').val($('#proud_textarea').val());
   console.log($('#proud_text').val());
   
   /// now move values over to second hidden form // 
  //alert("FUNCTION ON NATIVE PAGE CALLED");
	$('#entered_first_name').val($('#first_entered_first_name').val());
   // console.log($("#first_name").val());
    $('#entered_last_name').val($('#first_entered_last_name').val());
   // console.log($("#last_name").val());
    $('#entered_email').val($('#first_entered_email').val());
   // console.log($("#email").val());
    $('#entered_pass').val($('#first_entered_pass').val());
    //console.log($("#password").val());
    
   $('#passions_entered_text').val($('#first_passions_entered_text').val());
   console.log($('#passions_entered_text').val());
   $('#one_year_entered_text').val($('#first_one_year_entered_text').val());
   console.log($('#one_year_entered_text').val());
   $('#three_year_entered_text').val($('#first_three_year_entered_text').val());
   console.log($('#three_year_entered_text').val());
   $('#five_year_entered_text').val($('#first_five_year_entered_text').val());
   console.log($('#five_year_entered_text').val());
   $('#proud_text').val($('#first_proud_text').val());
   console.log($('#proud_text').val());
   
   // now submit second form  // because this is an unconventional work-around // 
   
   /////
   
   
   
  // submit form  // 
  
  document.getElementById('file_form').submit();
});

