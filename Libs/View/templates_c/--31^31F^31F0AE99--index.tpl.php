<?php /* Smarty version 2.6.26, created on 2012-05-05 07:38:57
         compiled from /var/www/Projetos//Opertur//Application/views/Index/index.tpl */ ?>
<?php echo '
<script type="text/javascript">
//setInterval(session,100000);
//setInterval(session,10000);
//function session(){
	// $.ajax({
	  // type: "POST",
	   //url: "index/session",
	   //data: "ajax=true&session=true",
	   //dataType: \'json\',
	   //success: function(msg){
		//if(msg != \'\'){
	     //returnRequest(msg);
		//}
	   //}
	 //});
//}
</script>
'; ?>

<div id="containerPrincipal">
	<div id="containerMenu"><?php echo $this->_tpl_vars['menu']; ?>
 </div>
	<div id="usuarioLogado">Usuario Logado: <?php echo $this->_tpl_vars['usuarioLogado']; ?>
 </div>
	<div id="conteudo">
		<iframe name="iframePrincipal" frameborder="0" id="iframePrincipal" src=""></iframe>
	</div>
</div>
<div id="rodape"></div>