<legend>Arquivos</legend>

<ul id="arquivosOrdem" name="arquivosOrdem" style="margin: 0;padding:0">
    {section name=i loop=$arquivos}
    <li id="{$arquivos[i].id}" style="border: 0px solid #000; float:left; margin: 5px; text-align:center; width:150px; height:130px; list-style:none; " alt="{$arquivos[i].descricao}" title="{$arquivos[i].descricao}">
<!--        {if $editar != 1}<a href="../arquivos/download/id/{$arquivos[i].id}" id="arquivos" name="download">{/if}-->
            
            <div style="height: 73px;width: 95px;overflow:hidden;text-align: center">
                <img  src="{$arquivos[i].imagem}"  />
            </div>
<!--       {if $editar} </a>{/if}-->
        <br><br>
        <div style="overflow:hidden;height:20px" title="{$arquivos[i].descricao}" alt="{$arquivos[i].descricao}"><b>{$arquivos[i].descricao}.</b></div>
        {if $editar }<input type="radio" name="../Arquivo/principal" id="principal" params="arquivo={$arquivos[i].id}" event="change" {if $arquivos[i].principal} checked="checked" {/if}>{/if}
        {if $editar}<img event="click" src="{$HTTP_REFERER}../Libs/Images/Buttons/Novo.png" id="editarArquivo" name="../Arquivo/editarArquivo" params="arquivo={$arquivos[i].id}"/>{/if}
        {if $excluir}<img event="click" src="{$HTTP_REFERER}../Libs/Images/Buttons/Cancelar.png" msg="Deseja excluir o item selecionado?" id="excluirarquivo" name="../Arquivo/excluirarquivo" params="arquivo={$arquivos[i].id}"/>{/if}
    </li>
    {/section}
</ul>
<!--{if $editar}
{literal}
<script type="text/javascript">
    $('#arquivosOrdem').sortable({
        update: function(){
            $(this).attr('params', 'ordem='+$('#arquivosOrdem').sortable('toArray'));
            ajaxRequest($(this), 'change');
        }
    })
</script>
{/literal}
{/if}-->