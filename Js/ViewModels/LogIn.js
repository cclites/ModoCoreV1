var buildLogInView = function()
{
	str = "";
	
	str += '<form data-bind="submit: validate">';
	str += '  <input id="banner_uname" data-bind="value: uName" type="text" placeholder="Username" autofocus required="required"/>';
	str += '  <input id="banner_upass" data-bind="value: uPass" type="password" placeholder="Password" required="required"/>';
	str += '  <button id="logIn" type="submit">&#8901;&nbsp;Log In</button>';
	str += '</form>'
	
	return str;
}
