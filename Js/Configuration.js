var updateConfigs = function(){
	
	
	var  url = "update",
		 
	     data = {
	     	session: model.session, 
	     	token: model.token, 
	     	id: model.id, 
	     	owner_id: model.owner_id,
	     	base: document.getElementById("base").value,
	        isActive : document.getElementById("isActive").checked, 
			testingMode : document.getElementById("isTesting").checked, 
			buying : document.getElementById("isBuying").checked, 
			selling : document.getElementById("isSelling").checked, 
			increase : document.getElementById("increase").value, 
			sellLimitBtc : document.getElementById("sellLimitBtc").value, 
			decrease : document.getElementById("decrease").value, 
			buyLimitBtc : document.getElementById("buyLimitBtc").value,
			fixed_sell : document.getElementById("fixed_sell").checked,
			fixed_buy : document.getElementById("fixed_buy").checked,
			fixed_sell_amount : document.getElementById("fixed_sell_amount").value,
			fixed_buy_amount : document.getElementById("fixed_buy_amount").value
		},
	    request = new mo.requestObject(url, "POST", ca.getHistorySuccess, ca.getHistoryFailure, data);
	
	    
	mo.asynch(request);
	
};
