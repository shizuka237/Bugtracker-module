$('#register').load(2.html)
{
	var uname = $('#uname').val();
	var upwd = $('#upwd').val();

	$.post('login.php',{'username':uname,'userpassword':upwd},function(response){
		alert(response.responsearray.id);
		console.log(response)
	});
});

