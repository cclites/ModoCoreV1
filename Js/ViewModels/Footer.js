function buildFooterView()
{
	//this will need to eventually be passed an id.
	
	// manually handle which bot gets processed.
	var b = model.bots();
	var myB = b[0];
	var id = myB.id();
	var str = "";
	
	str += "             <div class='actionControls'>";
	str += "               <input class='action' id='update' onclick='updateConfigs(" + id + ");' value='Update Configuration' type='button'>\n";
	str += "               <input class='action' id='resetBalance' onclick='resetBalance(" + id + ")' value='Reset Test Balance' type='button'>\n";
	str += "               <input class='action' id='resetHistory' onclick='resetHistory(" + id + ")' value='Reset Historic Data' type='button' />\n"; 
	str += "               <input class='action' id='getTransactions' onclick='getTransactions(" + id + ")' value='View Transactions' type='button' />\n"; 
	str += "             </div>";
	
	return str;
}