
//esconde formulario ADD
$(document).ready(function(e) {
    $("#form_div1, #form_div2").hide();
   
	
	$("#join1").click(function(){
		$("#form_div1").toggle( "slow" );
		});
	$("#join2").click(function(){
		$("#form_div2").toggle( "slow" );
		});
});