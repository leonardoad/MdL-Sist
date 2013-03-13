<?php /* Smarty version 2.6.26, created on 2013-03-13 13:11:26
         compiled from /var/www/desenv/testes/TopChaves/Site//site//Application/views/Index/index.tpl */ ?>
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