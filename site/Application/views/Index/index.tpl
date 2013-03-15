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
    $( 'document').ready(function(){
        
        alturaJanela = $(window).height();
        $('#iframePrincipal').css('height',alturaJanela - 130);
        $('#conteudo').css('height',alturaJanela - 130);
    });
</script>
{/literal}
<div id="containerPrincipal">
    <div class="header" >
        <div id="tituloPagina"> Mural das Lembrancinhas - Sistema de Vendas</div> <div id="usuarioLogado">Usuario Logado: {$usuarioLogado} </div>
    </div>
    <div id="containerMenu">{$menu} </div>
    <div id="conteudo">
        <iframe name="iframePrincipal" frameborder="0" id="iframePrincipal" style="height: 400px"></iframe>
    </div>
</div>
<div id="rodape"></div>