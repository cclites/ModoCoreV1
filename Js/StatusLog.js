var addMessage = function(message)
{   
    var text = $("#statusLogContent").text();
    
	text += message + "\n";
	$("#statusLogContent").text(text);
}

var clearMessage = function(){
	$("#statusLogContent").text("");
}
