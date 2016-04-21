var getTransactions = function(botId)
{
	$.ajax ({
		type: "GET",
		url: "Api/Dispatcher.php",
		data: { func: "transactions", id:botId}  
		}).success( function(msg)
			{
			    //alert(msg);
			
			    var json = JSON.parse(msg);
			    var t = buildTransactionView(json["transactions"]);
				
				//display the modal
				buildTransactionModal(t);
			});
}

var buildTransactionModal = function(transactions)
{
	$("#modals").dialog({
	               modal: true,
		           width: 1000,
				   height: 500,
				   title: "Transactions"
			   }).html(transactions);
			   
    $(".ui-dialog-titlebar-close").text("X");
}

