var validMail = function(addr)
{
	var reg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/
	if (reg.test(addr))
	{
	    return true; 
	}
	
	return false;
}