<!--<legend>Pastas</legend>-->
<ul id="albunsOrdem" name="albunsOrdem" style="margin: 0;padding:0">
    {section name=i loop=$albuns}
    <li id="{$albuns[i].id}" style="  float:left; margin: 5px; text-align:center; width:140px; height:100px; list-style:none; text-align: center;vertical-align: middle">
        {if $editar}
        <a href="#none"   event="click" id="arquivos" name="../Arquivo/arquivos" params="album={$albuns[i].id}">
        {else}
        <a href="{$albuns[i].imagemG}" rel="prettyPhoto"    id="arquivos" name="arquivos">
            {/if}
            <div style="height: 95px;width: 95px;overflow:hidden;text-align: center">
                <img  src="{$albuns[i].imagem}" alt="{$albuns[i].titulo}" title="{$albuns[i].titulo}"/>
            </div>
        </a>	
        <div style="border:0px solid #fff; height: 19px; overflow: hidden;" title="{$albuns[i].titulo}" alt="{$albuns[i].titulo}"><b>{$albuns[i].titulo}</b></div>
        <!--			{if $editar}<img event="click" src="./../../Libs/Images/Buttons/Novo.png" id="editarAlbum" name="editarAlbum" params="album={$albuns[i].id}"/>{/if}
                                {if $excluir}<img event="click" src="./../../Libs/Images/Buttons/Cancelar.png" msg="Deseja excluir o item selecionado?" id="exluirAlbum" name="exluirAlbum" params="album={$albuns[i].id}"/>{/if}-->
    </li>
    {/section}
</ul>
<!--{if $editar}
        {literal}
        <script type="text/javascript">
                $('#albunsOrdem').sortable({
                        update: function(){
                                $(this).attr('params', 'ordem='+$('#albunsOrdem').sortable('toArray'));
                                ajaxRequest($(this), 'change');
                        }	
                })
        </script>
        {/literal}
{/if}-->