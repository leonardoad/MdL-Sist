 
<table border="0" style="width: 100%">

    <tbody>
        <tr >
            <td style="vertical-align: top;width:200px"  >
                <p class="titulo">Menu</p>
                <div class="divMenuProdutos">
                    <ul class="menuProdutos">
                        {$menu_produtos}
                    </ul>
                </div>
            </td>
            <td style="vertical-align: top;">
                {if $textoBusca!= ''}<p class="texto">Resultados da busca por "{$textoBusca}"</p>{/if}
                {$produto_destaque}

            </td>
        </tr>

    </tbody>
</table>
