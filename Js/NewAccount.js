var newAccount = function()
{
    $("#splash, #features, #docs, article").remove();
	
	//Do not add this container if the content is already displayed.
	if( !document.getElementById("accountMessage"))
	{
		$("#botContainer").append(buildNewAccountView());
	}
}

var addNewMember = function()
{
	var newUserName = $("#newUserName").val(),
	    newUserPass = $("#newUserPass").val(),
		newUserMail = $("#newUserEmail").val(),
		url = 'Api/Dispatcher.php';
			
	$.ajax({
        type: "POST",
		url: url,
	    data: { func:"addMember", newUserName:newUserName, newUserPass: newUserPass, newUserEmail: newUserMail }
	}).success(function(data){
		
		//alert("Thank you for registering. Check your email for validation details.");
		alert(data);
		//addMessage(data);
		    /*
		    var json = $.parseJSON(data);
			addMessage(json.message);
			*/
	}).error(function(data){
	     alert("Error");
	});
}


var resendValidation = function()
{
	var userMail = $("#newUserEmail").val(),
	    url = 'Api/Dispatcher.php';
		
	if (userMail == "" || !validMail(userMail))
	{
		addMessage("Please enter a valid email address.");
		return;
	}
	
	addMessage("Looking up email.");
	
	$.ajax({
        type: "POST",
		url: url,
	    data: { func:"resendValidate", userMail: userMail }
	}).success(function(data){
		
		alert(data);

	}).error(function(data){
	     alert(data);
	     alert("Unable to resend validation email. Contact support: support@modobot.com");
	});	
}