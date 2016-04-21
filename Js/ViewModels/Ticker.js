function buildTickerView()
{

    var b = model.bots(),
	    myB = b[0],
	    id = myB.id();
	
	str = "";
	str += "              <table class='tickerTable'>\n";
	str += "                <tr>\n";
	str += "                  <th rowspan='2' id='exchangeTh" + id + "' class='tickerDescription'>Bitstamp</th>\n";
	str += "                  <th class='tickerHeader'>Last</th>\n";
	str += "                  <th class='tickerHeader'>Previous</th>\n";
	str += "                  <th class='tickerHeader'>Volume</th>\n";
	str += "                  <th class='tickerHeader'>High</th>\n";
	str += "                  <th class='tickerHeader'>Low</th>\n";
	str += "                  <th class='tickerHeader'>Bid</th>\n";
	str += "                  <th class='tickerHeader'>Ask</th>\n";
	str += "                  <th class='tickerHeader'>Trend</th>\n";
	str += "                </tr>\n";
	str += "                <tr>\n";
	str += "                  <td>$" + myB.ticker.last() + "</td>\n";
	str += "                  <td>$" + myB.ticker.previous() + "</td>\n";
	str += "                  <td>" + myB.ticker.volume() + "</td>\n";
	str += "                  <td>$" + myB.ticker.high() + "</td>\n";
	str += "                  <td>$" + myB.ticker.low() + "</td>\n";
	str += "                  <td>$" + myB.ticker.bid() + "</td>\n";
	str += "                  <td>$" + myB.ticker.ask() + "</td>\n";
	
	var trend = "Rising";
	if(myB.ticker.direction() < 0) trend = "Falling";
	
	str += "                  <td>" + trend + "</td>\n";
	str += "                </tr>\n";
	str += "              </table>\n";
	
	return str;
}