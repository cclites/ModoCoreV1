function buildCalculatorView()
{
	//this will need to eventually be passed an id.
	
	// manually handle which bot gets processed.
	var b = model.bots();
	var myB = b[0];
	var id = myB.id();
	var str = "";
	var temp = "";
	
	var configs = [];
	var ledger = [];
	
	
	temp = myB.configs.exchange_fee();
	//configs["exchange_fee"]  =  (parseFloat(temp/10) * 2);
	configs["exchange_fee"]  =  (parseFloat(temp) * 2);
	
	//remove commas from numbers so that math does not fail
	configs["spp"] = (myB.configs.spp()).replace(",","");
	configs["ppp"] = (myB.configs.ppp()).replace(",","");
	temp = myB.ledger.base();
	ledger["base"] = temp.replace(",","");
	
	
	sellSpread = parseFloat( configs["spp"] - ledger["base"]).toFixed(2);
	sellFee = parseFloat( configs["spp"] *  configs["exchange_fee"] ).toFixed(2);
	actualSell = parseFloat(sellSpread - sellFee).toFixed(2);
	
	buySpread = parseFloat( ledger["base"] - configs["ppp"] ).toFixed(2);
	buyFee = parseFloat( configs["ppp"] * configs["exchange_fee"] ).toFixed(2);
	actualBuy = parseFloat(buySpread - buyFee).toFixed(2);
	
	str = "";
	str += "    <div class='sectionHeader'>Calculator:</div>\n";
	str += "        <table class='calculatorTable'>\n"; 
	str += "            <tr>\n"; 
	str += "                <td class='calculatorLabel'>New SPP</td><td id='newSpp" + id +"'>$" + configs["spp"] +"</td>\n"; 
	
	str += "                <td class='calculatorLabel'>Sell Spread</td><td id='sellSpread" +  id + "'>$" + sellSpread + "</td>\n";
	str += "                <td class='calculatorLabel'>Sell Fee</td><td id='sellFee"+ id + "'>$" + sellFee  + "</td>\n"; 
	str += "                <td class='calculatorLabel'>Actual</td><td id='actualSellSpread"+ id + "'>$"  +  actualSell +  "</td>\n";
	str += "            </tr>\n"; 
	str += "            <tr>\n"; 
	str += "                <td class='calculatorLabel'>New PPP</td><td id='newPpp"+ id + "'>$" + configs["ppp"] +"</td>\n"; 
	str += "                <td class='calculatorLabel'>Buy Spread</td><td id='buySpread"+ id + "'>$" +  buySpread + "</td>\n"; 
	str += "                <td class='calculatorLabel'>Buy Fee</td><td id='buyFee"+ id + "'>$" + buyFee  + "</td>\n"; 
	str += "                <td class='calculatorLabel'>Actual</td><td id='actualBuySpread"+ id + "'>$" +  actualBuy + "</td>\n"; 
	str += "            </tr>\n"; 
	str += "            <tr  id='spacer'><td></td></tr>\n"; 
	str += "            <tr>\n"; 

	str += "            </tr>\n"; 
	str += "        </table>\n"; 
	
	return str;
}