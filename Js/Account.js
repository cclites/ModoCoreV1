//Update account info
var updateAccount = function()  //show account modal
{
	var content = buildAccountView();
	
	$("#modals").html(content);
	
	$("#modals").dialog();
	/*
	$("#modals").dialog({
		modal: true,
		width: 800,
		height: 500,
		title: "Account Info"
		});
		*/
	
	//$(".accountAction").hide();
	$(".ui-dialog-titlebar-close").text("X");
};

var showAccountConfig = function(div)
{
	$(".accountAction").hide();
	$("#" + div).show(300);
};

var saveNewPass = function()
{	
    var url = 'Api/Dispatcher.php',
	    uToken = model.token(),
	    uSession = "",
	    keys = {token: uToken, session: uSession},
	    pass1 = document.getElementById("newPass1").value,
	    pass2 = document.getElementById("newPass2").value;
		
		
	if( pass1 == pass2)
	{
		$.ajax({
		    type: "POST",
		    url:  url,
	        data: { func:"resetPassword", args: keys, pass1:pass1, pass2:pass2}
		}).success(function(data){
		    //addMessage(data);
		    addMessage("Password has been reset. Logging out.");
			$("#modals").dialog("close");
			
			setInterval("logOut()", 2000);
		}).error(function(data, msg, error){
		   addMessage("Password failed to update.\n" + data + "\n" + msg + "\n" + error);
		});
	}
	else
	{
	    addMessage("Passwords do not match.");
	}	
};
  
var saveNewEmail = function()
{

  	var url = 'Api/Dispatcher.php',
	    uToken = model.token(),
	    uSession = "",
	    keys = {token: uToken, session: uSession},
		newMail = document.getElementById("newMail").value;
		
    $.ajax({
		type: "POST",
		url: url,
	    data: { func:"resetEmail", args: keys, newMail: newMail}
	}).success(function(data){
	    addMessage(data);
		addMessage("Email has been reset.");
		$("#modals").dialog("close");
	}).error(function(data, msg, error){
		   addMessage("Email failed to update.\n" + data + "\n" + msg + "\n" + error);
		});
};

var updateBitstampConfigs = function()
{
	var url = 'Api/Dispatcher.php',
	    id = $("#acctId").val(),
	    key = $("#key").val(),
		secret = $("#secret").val(),
		uToken = model.token(),
		address = model.address(),
	    uSession = model.session(),
		bots = model.bots(),
	    botId = bots[0].id,
		keys = {token: uToken, session: uSession};
			
	$.ajax({
		type: "POST",
		url: url,
	    data: { func:"bitstampCfgs", args: keys, id:id, key:key, secret:secret, botId:botId, address:address }
	}).success(function(msg){
	    addMessage(msg);
		//addMessage("Bitstamp credentials have been updated.");
		$("#modals").dialog("close");
	}).error(function(data, msg, error){
	       $("#modals").dialog("close");
		   addMessage("Configs failed to update.\n" + data + "\n" + msg + "\n" + error);
		});	
};

var activate = function(address)
{
	var url = 'Api/Dispatcher.php',
	    address = model.address(),
		bots = model.bots(),
	    botId = bots[0].id;
	
	$.ajax({
		type: "POST",
		url: url,
	    data: { func:"activate", address:address, id:id }
	}).success(function(msg){
	    addMessage(msg);
		addMessage("Activation pending.");
		$("#modals").dialog("close");
	}).error(function(data, msg, error){
	    $("#modals").dialog("close");
		addMessage("Failed to activate.\n" + data + "\n" + msg + "\n" + error);
    });
};
