

// Fun��o de cri��o da tabela de listagem de clientes
function createGrid(descricao)
{
    if(descricao == null)
        descricao = "";
	

    var url = 'tarefas.php';
    var parametros = 'descricao='+descricao;
    var myAjax = new Ajax.Request( url, {
        method: 'post',
        parameters: parametros,
        onLoading: carregando,
        onComplete: escreve
    });
}
// Fun��o de pesquisa
function pesquisar() {
    // Passando como par�metro o valor do campo pesq_descricao do formul�rio de pesquisa
    createGrid( $("pesq_descricao").value );
}
// Fun��o de exibi��o de imagem de processamento
function carregando()
{
    $("loader").style.display="block";
//    $("loader").innerHTML="<img src='./ajax-loader.gif'>";
}
function cadastrar(){

    descricao = $("pesq_descricao").value;
    tempo = $("pesq_tempo").value;
    if(descricao!= '' && tempo!=''){
        $("pesq_descricao").value = '';
        $("pesq_tempo").value = '';

        var url = 'tarefas.php';
        var parametros = 'descricao='+descricao+'&tempo='+tempo+'&cadastra=S';
        var myAjax = new Ajax.Request( url, {
            method: 'post',
            parameters: parametros,
            onLoading: carregando,
            onComplete: escreve
        });
    }else{
        alert('os dois campos devem estar preenchidos');
        $("pesq_descricao").focus();
    }


}
function desativa(id){


    var url = 'tarefas.php';
    var parametros = 'id='+id+'&desativa=S';
    var myAjax = new Ajax.Request( url, {
        method: 'post',
        parameters: parametros,
        onLoading: carregando,
        onComplete: escreve
    });

}
function completo(id){


    var url = 'tarefas.php';
    var parametros = 'id='+id+'&completo=S';
    var myAjax = new Ajax.Request( url, {
        method: 'post',
        parameters: parametros,
        onLoading: carregando,
        onComplete: escreve
    });

}
function iniciar(id){


    var url = 'tarefas.php';
    var parametros = 'id='+id+'&iniciar=S';
    var myAjax = new Ajax.Request( url, {
        method: 'post',
        parameters: parametros,
        onLoading: carregando,
        onComplete: escreve
    });

}
function mostrarTodos(){


    var url = 'tarefas.php';
    var parametros = '&mostrarTodos=S';
    var myAjax = new Ajax.Request( url, {
        method: 'post',
        parameters: parametros,
        onLoading: carregando,
        onComplete: escreve
    });

}
// Escreve a tabela de listagem de clientes
function escreve(request)
{
    $("loader").style.display="none";

    var xmldoc=request.responseXML;
    var tabela = "<table class='tarefas' >";
    tabela += "            <tr class='tabHead'>";
    tabela += "                <th>Desativar</th>";
    tabela += "                <th>Completo</th>";
    tabela += "                <th>Iniciar</th>";
    tabela += "                <th>Descri&ccedil;&atilde;o</th>";
    tabela += "                <th>Tempo Termino</th>";
    tabela += "                <th>Data Inicio</th>";
    tabela += "                <th>Data Fim</th>";
     tabela += "           </tr>";
    //    var cabecalho = xmldoc.getElementsByTagName('cabecalho')[0];
    //
    //    if(cabecalho!=null) {
    //
    //        var coluna = cabecalho.getElementsByTagName('coluna');
    //        var tabela="<table width='100%' style='font-family: arial;font-size: 12px' border='0'><tr bgcolor='#666666'>"
    //
    //        //cabecalho da tabela
    //        for(i=0;i<coluna.length;i++){
    //            tabela+="<td><b><font color='#FFFFFF'>"+coluna[i].firstChild.data+"</font></b></td>";
    //        }
    //        
    //        tabela+="</tr>"
    //corpo da tabela
        
    var registros = xmldoc.getElementsByTagName('registro');
    
    if(registros!=null) {
        
        for(i=0;i<registros.length;i++){
            var itens = registros[i].getElementsByTagName('item');
            //
            if(itens[1].firstChild.data=="S"){
                //                tabela+="<tr id=linha"+i+" bgcolor='#F0FFF0'>";
                tabela+="<tr id=linha"+i+" class='linha completa'>";
            }else{
                //                tabela+="<tr id=linha"+i+" bgcolor='#DDDDDD'>";
                tabela += "<tr id=linha"+i+" class='linha'>";
            }
            id = itens[0].firstChild.data;
            tabela+="<td width='5%' align='center'  style='cursor:pointer;' onclick='desativa("+id+")'> X </td>";

            if(itens[1].firstChild.data != "S"){
                tabela+="<td width='5%' style='cursor:pointer;' align='center'  onclick='completo("+id+")'> Completar </td>";
                tabela+="<td width='5%' style='cursor:pointer;' align='center'  onclick='iniciar("+id+")'> Iniciar </td>";
            }else{
                tabela+="<td width='5%' align='center'  > OK! </td>";
                tabela+="<td width='5%' align='center'  > &nbsp;</td>";
            }
            for(j=2;j<itens.length;j++){
                
                widht = 10;
                if(j == 2)
                    widht = 40;

               
                if(itens[j].firstChild==null){
                    tabela+="<td width='"+widht+"%'>&nbsp;</td>";
                }else{
                    if(j == 2)
                        tabela+='<td width="'+widht+'%" nowrap ><span id="desc'+ id + '" onclick="editDesc('+ id + ')" >'+ itens[j].firstChild.data + '</span><input class="txbDesc" onblur="endEditDesc('+ id + ')" id="txbDesc'+ id + '" value="'+ itens[j].firstChild.data + '"/></td>';
                    else
                        tabela+="<td width='"+widht+"%' nowrap >" + itens[j].firstChild.data + "</td>";
                }
            }
            tabela+="</tr>";
        }
        tabela+="</table>";
        $("listagem").innerHTML=tabela;
        tabela=null;
    }else{
        $("listagem").innerHTML="<div align='center'>Nao ha registros...</div>";
    }
}

 function editDesc(id){
     
     $("desc"+id).style.display = "none";
     $("txbDesc"+id).style.display = "block";
     
     
 }
 function endEditDesc(id){
     
//     $("txbDesc"+id).style.display = "none";
//     $("desc"+id).style.display = "block";
//     
     descricao = $("txbDesc"+id).value;
     
      var url = 'tarefas.php';
        var parametros = 'descricao='+descricao +'&editDesc=S&id='+id;
        var myAjax = new Ajax.Request( url, {
            method: 'post',
            parameters: parametros,
            onLoading: carregando,
            onComplete: escreve
        });
 }