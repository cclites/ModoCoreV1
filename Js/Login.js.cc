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

	  try{
	        if(data)
			{
			    model = ko.mapping.fromJSON(data);
				$(".banner").html(buildBannerView(true));
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
		    addMessage("Log in error");
			logInError();
			return;
		}
	}).error(function(msg, response, error){
	   addMessage(error);
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



