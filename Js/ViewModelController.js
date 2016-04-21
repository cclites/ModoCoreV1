var tickerUrl = 'Api/Dispatcher.php?func=ticker',
observableModel,
addMessage = function(msg)
{
	var currentText = $("#statusLogContent").text();
	$("#statusLogContent").text(currentText + msg);
}
,
getBot = function(isUpdate)
{
	if( !model || model.token == "" )
	{
		//Do not uncomment unless debugging.
		//addMessage("Model not loaded");
	}
	else
	{
		var url = 'Api/Dispatcher.php',
		uToken = model.token(),
		uSession = model.session(),
		keys = {token: uToken, session: uSession};
		$.ajax({
			type: "GET",
			url: url,
		data: { func:"state", args: keys }
			}).success(function(data)
		{
		    //addMessage("Data is: " + data);
		
			if(data)
			{
				model = ko.mapping.fromJS($.parseJSON(data));
				model = ko.mapping.fromJSON(data);
				var currentdate = new Date(); 
				var datetime = currentdate.getDate() + "/"
				+ (currentdate.getMonth()+1)  + "/" 
				+ currentdate.getFullYear() + " @ "  
				+ currentdate.getHours() + ":"  
				+ currentdate.getMinutes() + ":" 
				+ currentdate.getSeconds();
				addMessage("Updated: " + datetime);
				if(isUpdate)
				{
					updateViews();
				}
			}
			});
	}
	},
initialize = function()
{
	//populate the banner
	$(".banner").html(buildBannerView(false));
	//display the status log
	$("#statusLogContainer").html(statusLogView());
	initListeners();
	setTimers();
}
,
setTimers = function()
{
	setInterval( function()
	{
		getBot(true);
	}
	, 60000);
}
,
updateViews = function()
{
	var ticker = buildTickerView();
	var ledger = buildLedgerView();
	var history = buildHistoryView();
	var b = model.bots();
	var myB = b[0];
	var id = myB.id();
	var temp;
	$("#tickerContainer").html(ticker);
	$("#ledgerContainer").html(ledger);
	$("#historyContainer").html(history);
	//$("#calculatorContainer").html(calculator);
	if( !$("#configsContainer input").is(":focus") )
	{
		var configs = buildConfigView();
		var calculator = buildCalculatorView();
		$("#configsContainer").html(configs);
		$("#calculatorContainer").html(calculator);
	}
	temp = myB.ledger.base();
	$("#base" + id).val(temp);
}
,
addBotViews = function()
{
	var ticker = buildTickerView();
	var ledger = buildLedgerView();
	var history = buildHistoryView();
	var configs = buildConfigView();
	var calculator = buildCalculatorView();
	var footer = buildFooterView();
	$("#tickerContainer").html(ticker);
	$("#ledgerContainer").html(ledger);
	if(history) $("#historyContainer").html(history);
	$("#configsContainer").html(configs);
	$("#calculatorContainer").html(calculator);
	$("#footerContainer").html(footer);
}
,
initListeners = function()
{
	$("#logClear").on("click", function(o){ $("#statusLogContent").text("");});
	$(".contact").one("click", function(o){});
}
;
initialize();