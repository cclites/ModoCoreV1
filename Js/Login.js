/*******************************************
*  knockout bindings for the login form.
*******************************************/
var loginForm = {
	uName: new ko.observable(''),
	uPass: new ko.observable(''),
	
	validate: function(formElement)
	{
		var formData = ko.mapping.toJSON(this);
		submitLogIn(formData); 
	},
	clearCredentials: function()
	{
	    this.uPass('');
		this.uName('');
	}
}

ko.applyBindings(loginForm);

/*******************************************/

var submitLogIn = function(formData)
{
    //addMessage("Submitting credentials.");
	var url = 'Api/Dispatcher.php';
	
	var formData = {
	  uName: document.getElementById("banner_uname").value,
	  uPass: document.getElementById("banner_upass").value
	}

	$.ajax({
      type: "POST",
      url: url,
	  data: {func:"validate", args: formData}
    }).success(function(data){

      //addMessage(data);

	  try{
	        if(data)
			{
			    model = ko.mapping.fromJSON(data);
				$(".banner").html(buildBannerView(true));
				$("#splash, #botContainer form, #features, #docs, hr, #privacy, article").remove();
				$("#botContainer").css("width", "750px");
				$("#statusLogContainer, #logClear").css("display", "block");
				$("#banner_background").css("height", "100%");
				
				addBotViews();
				addMessage("Account has been authorized.");		
			}
			else
			{
			    addMessage("Parse error:\n" + data);
				logInError();
				return;
			}
		}
		catch (e) 
		{
		    addMessage("Log in error: " + e);
			logInError();
			return;
		}
	}).error(function(msg, response, error){
	   addMessage(error);
	});
}

var recoverPassword = function()
{
	var userMail = $("#newUserEmail").val(),
	    url = 'Api/Dispatcher.php';
		
	if (userMail == "" || !validMail(userMail))
	{
		addMessage("Please enter a valid email address.");
		return;
	}
	
	//addMessage("Resetting password. Email validation is pending.");
	//addMessage("Posting password reset. Validating email: " + userMail);
	
		
	$.ajax({
        type: "POST",
		url: url,
	    data: { func:"resetPassword", userMail: userMail }
	}).success(function(data){
		
		addMessage(data);

	}).error(function(data, error, message){
	     addMessage(error + "   :   " + message);
	     addMessage("Unable to send password recovery. Contact support: support@modobot.com");
	});	
}

var logInError = function()
{
    addMessage("Unable to validate account.");
    $("#banner_uname").val("").trigger('change');
    $("#banner_upass").val("").trigger('change');	
}

var logOut = function()
{
	location.href = "index.php";
}



