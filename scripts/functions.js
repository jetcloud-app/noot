//Função de Mensagens
function diloag(modal, mensagem) {
	var dialogSelect = document.getElementById("dialog" + modal);
	
	if(dialogSelect.style.top == "-115px") {
		if(modal == "Mensagem") {
			document.getElementById("cMensagem").innerHTML = mensagem;
		} else {
			document.getElementById("cErro").innerHTML = mensagem;
		}
		
		//var displayBlock = document.getElementById("dialog" + modal).style.display = "block";
		var topBlock = document.getElementById("dialog" + modal).style.top = "10px";
		var count = setInterval(function(){ diloagNone(modal) }, 5000);
	}
	
	function diloagNone(mod) {
		
		var topBlock = document.getElementById("dialog" + modal).style.top = "-115px";
	
		clearInterval(count);
	}
}
