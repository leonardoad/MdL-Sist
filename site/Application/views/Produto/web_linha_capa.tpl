<tr>
    <td>
        <table onclick="document.location = '{$HTTP_REFERER}web/produto/id/{$id_produto}'">
            <tr >
                <td rowspan="2" style="width: 100px">
                    {$foto}
                </td>
                <td class="tituloProduto">
                    {$titulo}
                </td>
            </tr>
            <tr>
                <td class="texto">
                    {$descricao|truncate:200}
                    
                </td>
            </tr>
        </table>   
    </td>

</tr>