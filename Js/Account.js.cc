//Update account info
var updateAccount = function()  //show account modal
{
	var content = buildAccountView();
	
	$("#modals").dialog({
		modal: true,
		width: 800,
		height: 500,
		title: "Account Info"
		}).html(content);
	
	$(".ui-dialog-titlebar-close").text("X");
}

var showAccountConfig = function(div)
{
	$(".accountAction").hide();
	$("#" + div).show();
}

var saveNewPass = function()
{	
    var url = 'Api/Dispatcher.php',
	    uToken = model.token(),
	    uSession = model.session(),
	    keys = {token: uToken, session: uSession},
	    pass1 = document.getElementById("newPass1").value,
	    pass2 = document.getElementById("newPass2").value;
		
		
	if( pass1 == pass2)
	{
		$.ajax({
		    type: "POST",
		    url: url,
	        data: { func:"resetPassword", args: keys, id: id, pass1:pass1, pass2:pass2}
		}).success(function(data){
		    addMessage(data);
		    addMessage("Password has been reset. Logging out.");
			$("#modals").dialog("close");
			
			//setInterval("logOut()", 2000);
		});
	}
	else
	{
	    addMessage("Passwords do not match.");
	}	
}
  
var saveNewEmail = function()
{
    addMessage("Save new email.");

  	var url = 'Api/Dispatcher.php',
	    uToken = model.token(),
	    uSession = model.session(),
	    keys = {token: uToken, session: uSession},
		newMail = document.getElementById("newMail").value;
		
    $.ajax({
		type: "POST",
		url: url,
	    data: { func:"resetEmail", args: keys, id: id, newMail: newMail}
	}).success(function(data){
	    addMessage(data);
		addMessage("Email has been reset.");
		$("#modals").dialog("close");
	});
}
