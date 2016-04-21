var resetBalance = function(id)
{
	var url = 'Api/Dispatcher.php/',
	uToken = model.token(),
	uSession = "",
	keys = {token: uToken, session: uSession};
	
	$.ajax({
		type: "GET",
		url: url,
	data: { func:"resetBalance", args: keys, id: id }
		}).success(function(data){

            //addMessage(data);
			addMessage("Test balance has been updated. Updating bot info.");
			getBot(true);
		});
}