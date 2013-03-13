        <table style="width: 180px" onclick="document.location = '{$HTTP_REFERER}web/produto/id/{$id_produto}'">
            <tr >
                <td  colspan="1" style="text-align: center; vertical-align: middle;height: 110px">
                    {$foto}
                </td>

            </tr>
            <tr>
                <td class="tituloProduto" >
                    <div style="overflow: hidden;height: 18px;text-align: center">{$titulo}</div>
                </td>
<!--                <td  align="center">
                    <a href="{$HTTP_REFERER}web/produto/id/{$id_produto}"><div class="caixaTexto" style="float: right;vertical-align: bottom">Detalhes</div></a>
                </td>-->

            </tr>
        </table>   
