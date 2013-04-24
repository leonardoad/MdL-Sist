{literal}
    <style>

        .fundoPaper {
            background-color: #BBBBBB;
            padding: 20px;
            width: 100%;
        }

        .paper {
            background-color: #FFFFFF;
            box-shadow: 3px 3px 5px 6px #555555;
            height: auto !important;
            margin: 10px auto;
            min-height: 1100px;
            padding: 15px;
            width: 750px;
        }
        .tabelaValores{

        }
    </style> 
{/literal}
<div class="fundoPaper">
    <div class="paper">
        <table  width="100%" border="1">
            <tr>
                <td valign="top">
                    <p>Mural das Lembrancinhas</p>
                    <p>muraldaslembrancinhas.blogspot.com</p>
                </td>
                <td valign="top"><h3>Pedido</h3></td>
                <td valign="top">
                    <h4>Num Pedido: {$codigoOS}OS004</h4>
                    <p>Pedido: {$dataPedido}<br />
                        Entrega: <span class="dataEntrega">{$dataEntrega}</span></p>
                </td>
            </tr>
            <tr>
                <td valign="top" colspan="3">Cliente:{$nomeCliente}<br>Email:{$emailCliente}<br>Telefones:{$telefoneCliente}</td>
            </tr>
            <tr>
                <td valign="top" colspan="3">
                    <table  width="100%" border="1">
                        <tr>
                            <th >Descricao</th>
                            <th >Quant.</th>
                            <th >Valor<br />Unitário</th>
                            <th >Valor<br />Total</th>
                        </tr>
                        {section name=i loop=$itemLst} 
                            <tr>
                                <td >{$itemLst[i].descricao}</td>
                                <td >{$itemLst[i].quant}</td>
                                <td >{$itemLst[i].valUnitario}</td>
                                <td >{$itemLst[i].valTotal}</td>
                            </tr>
                        {/section}
                    </table>
                </td>
            </tr>
        </table>
    </div> 
</div>