<?php /* Smarty version 2.6.26, created on 2013-03-15 01:04:24
         compiled from C:%5Cxampp%5Chtdocs%5Cmdlsist/MdL-Sist%5C%5Csite%5C%5CApplication%5Cviews%5CIndex/index.tpl */ ?>
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
    $( \'document\').ready(function(){
        
        alturaJanela = $(window).height();
        $(\'#iframePrincipal\').css(\'height\',alturaJanela - 130);
        $(\'#conteudo\').css(\'height\',alturaJanela - 130);
    });
</script>
'; ?>

<div id="containerPrincipal">
    <div class="header" >
        <div id="tituloPagina"> Mural das Lembrancinhas - Sistema de Vendas</div> <div id="usuarioLogado">Usuario Logado: <?php echo $this->_tpl_vars['usuarioLogado']; ?>
 </div>
    </div>
    <div id="containerMenu"><?php echo $this->_tpl_vars['menu']; ?>
 </div>
    <div id="conteudo">
        <iframe name="iframePrincipal" frameborder="0" id="iframePrincipal" style="height: 400px"></iframe>
    </div>
</div>
<div id="rodape"></div>