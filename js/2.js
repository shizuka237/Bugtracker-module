$(document).ready(function(){
	//	alert('ss');
	$("#register").hide();
//	$("#main").hide();
	
	$("#registerbtn").click(function(){
			$("#register").show();
			$("#login").hide();
		//	$("#main").hide();
	});	
		$("#loginbtn").click(function(){
            if( $('#uname').val()=="" )
{

			alert('Insertion failed. Field is blank.');
			return false;
		}
		if( $('#upwd').val()=="" )
{

			alert('Insertion failed. Field is blank.');
			return false;
		}
		else
		{ 
	//	alert('hh');
        var uname = $('#uname').val();
     	var upwd = $('#upwd').val();

    	$.post('login.php',{'email_id':uname,'password':upwd},function(response){
		if(response.issuccess == '1')
		{   
       	       //    $("#register").hide();
	          	//           $("#login").hide();
           window.location="main.php";
		 //  alert(response.responsearray.id);
			 //  alert('inside');
        }
		else
		{
		alert('Register or enter the correct credentials');
		}


		});
		}
       
});

	    $("#register_btn").click(function(){
	//	alert('ss');
		var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		var phone_var = /[0-9 -()+]+$/;
		var pwd=$('#pwd').val();
		if($('#f_name').val()=="" )
		{

			alert('Insertion failed. Field is blank.');
			return false;
		}
			if($('#f_name').val().length>20 )
		{

			alert('Maxlength  can be 20');
			return false;
		}
		if( $('#l_name').val()=="" )
    	{

			alert('Insertion failed. Field is blank.');
			return false;
		}
			if( $('#l_name').val().length>20 )
    	{

		alert('Insertion failed. Field is blank.');
			return false;
		}
 
        if( $('#e_id').val()=="" )
        {

			alert('Insertion failed. Field is blank.');
			return false;
		}
		if(!filter.test($('#e_id').val()))
		{
		    alert('Email isnot valid');
			return false;
		}
		if( $('#p_num').val()==""||!phone_var.test($('#p_num').val() ))
        {
		
			alert('Enter a valid phone number');
			return false;
		}

        if( $('#pwd').val()=="")
        {

			alert('Insertion failed. Field is blank.');
			return false;
		}
        if( $('#pwd').val().length<6)
        {
            //	alert('no1');

			alert('Password should be more than 6 characters long');
			return false;
		}

		if(pwd.search(/[a-zA-Z]/)==-1)
		{
			alert('no2');
			alert('Password should consist of at least one letter');
		    return false;
		}
		if(pwd.search(/[\!\@\#\$\%\^\&\*\(\)\_\+]/) == -1)
		{
            alert('no3');
			alert('Password should consist of at least one special character');
		    return false;
		}
		if(pwd.search(/\d/)==-1)
		{
			alert('Password should consist of at least one number');
		    return false;
		}

        if( $('#c_pwd').val()=="")
        {

			alert('Insertion failed. Field is blank.');
			return false;
		}
        if($('#pwd').val()!=$('#c_pwd').val())
        {
            alert('Password and Confirm password should be same');
            return false;
        }
		else
		{
           	$.post('insert.php',{'first_name':$('#f_name').val(),'last_name':$('#l_name').val(),'email_id': $('#e_id').val(),'phone_number': $('#p_num').val(),
					'password':$('#pwd').val(),'confirm_password': $('#c_pwd').val()},function(){
				//	alert('ss');
					window.location="index.html";
					return true;
					exit;
					});
		}	
			
	});
    $('body').on('click','.bug_name',function(){

	var bugid=$(this).attr('data-id');
	//alert(bugid);
	openNav();
	$.post('fetch_img_description.php',{'bugid':bugid},function(response)
		{
		//	alert(response.responsearray.bug_description);
			console.log(response);
			$('#bug_description').html('');
			$('#bug_description').html(response.responsearray.bug_description);
			$('#bug_identification_time').html('');
			$('#bug_identification_time').html(response.responsearray.time_stamp);

			$('#bugimage').attr('src','');
			$('#bugimage').attr('src',response.responsearray.bug_image);
			$('#email_id').html('');
			$('#email_id').html(response.responsearray.email_id);
            
			$('#bug_resolvetime').html('');
			$('#bug_resolvetime').html(response.responsearray.bug_resolve_time);

			//$('.slider').show();
			
		});
});
   	
	 $("input[type=checkbox]").click(function(){
		//  alert('clicked');
         var thisCheck=$(this);
		 if(thisCheck.is(':checked'))
		 {
			 var bugid = $(this).attr('data-id');
			 $.post('checkbox.php',{'bugid':bugid},function(response){ 
				 });
		 }
         else
		 {
		  var bugid = $(this).attr('data-id');
		  	$(".window_overlay").show();
			 $.post('removebox.php',{'bugid':bugid},function(response){

	$(".window_overlay").hide();

				 });

		 }
		 });
});
function openNav(){
	$('#slider_id').addClass('show_slider').show();
	$(".overlay").show();
	//document.getElementById("slider_id").style.width = "250px";
}


$(".overlay").click(function(){
	hideslider();
});

function hideslider(){
	$("#slider_id").removeClass('show_slider');
	$(".overlay").hide();
}

$("body").on("click",".img_overlay", function(){
	$(".small").removeClass("zoom");
	$(this).hide();
})
		
		
/*{
	var uname = $('#uname').val();
	var upwd = $('#upwd').val();

	$.post('login.php',{'username':uname,'userpassword':upwd},function(response){
			
		alert(response.responsearray.id);
	console.log(response)
});
});*/
