<?php /* Smarty version 2.6.26, created on 2012-05-28 12:15:13
         compiled from C:%5Cxampp%5Chtdocs%5CProjetos%5C%5COpertur%5C%5CApplication%5Cviews%5CIndex/index.tpl */ ?>
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