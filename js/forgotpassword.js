
$('body').on('click', '#buttonid', function () {
                   var email_id=$('#email_id').val();
             $.post('forgotpassword.php',{'email_id':email_id},function(response){

                //  alert('456');
				 alert(response.responsearray.varmsg);
				 window.location="index.php";

             });

			});
		
