var resetHistory = function(id)
{
	var url = 'ModoCore/Api/Dispatcher.php',
	uToken = model.token(),
	uSession = "",
	keys = {token: uToken, session: uSession};
	
	$.ajax({
		type: "GET",
		url: url,
	data: { func:"resetHistoric", args: keys, id: id }
		}).success(function(data){
		    addMessage("Historical data has been reset. Updating bot state.");
			getBot(true);
		});
}