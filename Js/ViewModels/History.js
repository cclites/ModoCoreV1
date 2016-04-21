function buildHistoryView()
{
	//this will need to eventually be passed an id.
	
	// manually handle which bot gets processed.
	var b = model.bots();
	var myB = b[0];
	var id = myB.id();
	var str = "";
	
	
	history["currency"] = "BTC";
	
	str += "    <div class='sectionHeader'>Historic Data:</div>\n";
	str += "               <table class='historyTable'>\n"; 
	str += "                   <tr>\n"; 
	str += "                       <th class='historylabel'>HIGH</th>\n"; 
	str += "                       <th class='historylabel'>LOW</th>\n";
	str += "                       <th class='historylabel'>DATE HIGH</th>\n";
	str += "                       <th class='historylabel'>DATE LOW</th>\n";
	str += "                       <th class='historylabel'>START USD</th>\n";
	str += "                       <th class='historylabel'>START BTC</th>\n";
	str += "                       <th class='historylabel'>CURRENCY</th>\n";
	str += "                  </tr>\n"; 
	str += "                <tr>\n";
	
	//var h = parseFloat(myB.historic.high());
	//var l = parseFloat(myB.historic.low());
	
	str += "                    <td>$"+ parseFloat(myB.historic.high()).toFixed(2) +"</td>\n"; 
	str += "                    <td>$"+ parseFloat(myB.historic.low()).toFixed(2) +"</td>\n"; 
	str += "                    <td>"+ (myB.historic.date_high()) +"</td>\n"; 
	str += "                    <td>"+ (myB.historic.date_low()) +"</td>\n"; 
	str += "                    <td>$"+ parseFloat(myB.historic.start_usd()).toFixed(2) +"</td>\n"; 
	str += "                    <td>"+ (myB.historic.start_btc()) +"</td>\n";
	str += "                    <td>"+ history["currency"] +"</td>\n";
	
	str += "                </tr>\n";
	str += "             </table>\n"; 
	
	return str;
	
}