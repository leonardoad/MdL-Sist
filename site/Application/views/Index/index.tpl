{literal}
<script type="text/javascript">
//setInterval(session,100000);
//setInterval(session,10000);
//function session(){
	// $.ajax({
	  // type: "POST",
	   //url: "index/session",
	   //data: "ajax=true&session=true",
	   //dataType: 'json',
	   //success: function(msg){
		//if(msg != ''){
	     //returnRequest(msg);
		//}
	   //}
	 //});
//}
</script>
{/literal}
<div id="containerPrincipal">
	<div id="containerMenu">{$menu} </div>
	<div id="usuarioLogado">Usuario Logado: {$usuarioLogado} </div>
	<div id="conteudo">
		<iframe name="iframePrincipal" frameborder="0" id="iframePrincipal" src=""></iframe>
	</div>
</div>
<div id="rodape"></div>