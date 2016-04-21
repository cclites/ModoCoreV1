function buildConfigView()
{
	// manually handle which bot gets processed.
	var b = model.bots();
	var myB = b[0];
	var id = myB.id();
	var str = "";
	var temp = "";
	var live = myB.configs.live();
	
	//(myB.configs.exchange_fee())
	
	str += "    <div class='sectionHeader'>Configuration:</div>\n";
	str += "    <table id='configSummary" + id + "' class='configSummary'>\n"; 
	str += "            <tr>\n";
	
	temp = myB.configs.exchange_fee();

    // I don't think this is needed any more
	//str += "                <input id='botFee" + id + "' value='" + temp + "' type='hidden'>\n";
	str += "                     <td class='configLabel'>Is Active</td>\n"; 
	
	temp = myB.configs.is_active();
	
	if ( temp == 1)
	{
		str += "                     <td><input id='isActive" + id + "' checked='checked' type='checkbox'></td>\n";  
	}
	else
	{
		str += "                     <td><input id='isActive" + id + "' type='checkbox'></td>\n";
	}
	
	str += "                     <td>&nbsp;</td>\n"; 
	str += "                     <td>&nbsp;</td>\n"; 
	str += "                     <td colspan='4'>&nbsp;</td>\n";
	str += "                 </tr>\n"; 
	
	str += "                 <tr>\n"; 
	str += "                     <td class='configLabel'>Testing Mode</td>\n"; 
	
	temp = myB.configs.testing_mode();
	
	if ( temp == 1 || live == 0 )
	{
		str += "                     <td><input id='isTesting" + id +"' checked='checked' type='checkbox'></td>\n";
	}
	else
	{
		str += "                     <td><input id='isTesting" + id +"' type='checkbox'></td>\n";
	}
	
	str += "                     <td class='configLabel'>Base $</td>\n"; 
	
	temp = myB.ledger.base();
	
	str += "                     <td><input id='base" + id + "' value='" + temp +"' size='8' onchange='calculateSpread(" + id + ")' type='text'></td>\n";
	str += "                     <td colspan='2'>&nbsp;</td>\n"; 
	str += "                 </tr>\n"; 
	str += "                <tr>\n";
	str += "                     <td class='configLabel'>Auto Buy</td>\n"; 
	
	temp = myB.configs.can_buy();
	
	if ( temp == 1)
	{
		str += "                     <td><input id='isBuying" + id + "' checked='checked' type='checkbox'></td>\n"; 
	}
	else
	{
		str += "                     <td><input id='isBuying" + id + "' type='checkbox'></td>\n";
	}
	str += "                     <td class='configLabel'>% Increase</td>\n"; 
	
	temp = myB.configs.increase();
	
	str += "                     <td><input id='increase" + id + "' size='8' value='" + parseFloat(temp*10) + "' onchange='calculateSpread(" + id + ")' type='text'></td>\n";
	str += "                     <td>&nbsp;</td>\n"; 
	str += "                     <td id='sellLimitUsd" + id +"'>&nbsp;</td>\n"; 
	str += "                     <td>&nbsp;</td>\n"; 
	str += "                      <td id='buyLimitUsd" + id +"'>&nbsp;</td>\n";
	str += "                 </tr>\n"; 
	str += "                 <tr>\n";
	str += "                     <td class='configLabel'>Auto Sell</td>\n"; 
	
	temp = myB.configs.can_sell();
	if ( temp == 1)
	{
		str += "                     <td><input id='isSelling" + id + "' checked='checked' type='checkbox'></td>\n"; 
	}
	else
	{
		str += "                     <td><input id='isSelling" + id + "' type='checkbox'></td>\n"; 
	}
	
	str += "                     <td class='configLabel'>% Decrease</td>\n";
	
	temp = myB.configs.decrease();
	str += "                     <td><input id='decrease" + id + "' size='8' value='" + parseFloat(temp*10) + "' onchange='calculateSpread(" + id+ ")' type='text'></td>\n"; 
	str += "                     <td class='configLabel'>Sell Limit Btc</td>\n";
	
	temp = myB.configs.sell_limit_btc();
	str += "                     <td><input id='sellLimitBtc" + id  +"' size='6' value='" +  parseFloat(temp).toFixed(2) + "' type='text'></td>\n"; 
	str += "                     <td class='configLabel'>Buy Limit Btc</td>\n";
	
	temp = myB.configs.buy_limit_btc();
	str += "                     <td><input id='buyLimitBtc" + id  +"' size='6' value='" +  parseFloat(temp).toFixed(2) + "' type='text'></td>\n";
	str += "                 </tr>\n";
	
	
	
	
	str += "                 <tr>\n";
	str += "                     <td class='configLabel'>Fixed Sell</td>\n";
	
	temp = myB.configs.fixed_sell();
	
	if ( temp == 1)
	{
	    str += "                     <td><input id='fixed_sell" + id + "' type='checkbox' checked='checked'></td>\n";
	}
	else
	{
		str += "                     <td><input id='fixed_sell" + id + "' type='checkbox'></td>\n";
	}
	
	temp = myB.configs.fixed_sell_amount();
	str += "                     <td class='configLabel'>Sell Price $</td><td><input id='fixed_sell_amount" + id  +"' size='8' value='" +  parseFloat(temp).toFixed(2) + "' type='text'></td>\n";
	str += "                 </tr>\n";
	
	str += "                 <tr>\n";
	str += "                     <td class='configLabel'>Fixed Buy</td>\n";
	
	
	temp = myB.configs.fixed_buy();
	if ( temp == 1)
	{
	     str += "                     <td><input id='fixed_buy" + id + "' type='checkbox' checked='checked'></td>\n";
	}
	else
	{
	     str += "                     <td><input id='fixed_buy" + id + "' type='checkbox'></td>\n"; 	
	}
	temp = myB.configs.fixed_buy_amount();
	str += "                     <td class='configLabel'>Buy Price $</td><td><input id='fixed_buy_amount" + id  +"' size='8' value='" +  parseFloat(temp).toFixed(2) + "' type='text'></td>\n";
	str += "                 </tr>\n";
	 
	
	str += "                 <tr  id='spacer'><td></td></tr>\n"; 
	str += "             </tbody>\n";			
	str += "        </table>\n";  //end of configSummary table
	
	return str;
}