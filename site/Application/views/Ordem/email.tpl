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
        *{
            font-family: Arial;
            font-size: 12px;

        }
        .tabela{
            border: 1px solid #ccc;
            border-collapse: collapse;
        }
        .tabela td{
            border: 1px solid #ccc;
            /*border-collapse: collapse;*/
        }

        #box-table-a
        {
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            font-size: 12px;
            margin: 20px;
            width: 480px;
            text-align: left;
            border-collapse: collapse;
        }
        #box-table-a th
        {
            font-size: 13px;
            font-weight: normal;
            padding: 8px;
            background: #b9c9fe;
            border-top: 4px solid #aabcfe;
            border-bottom: 1px solid #fff;
            color: #039;
        }
        #box-table-a td
        {
            padding: 8px;
            background: #e8edff; 
            border-bottom: 1px solid #fff;
            color: #669;
            border-top: 1px solid transparent;
        }
        #box-table-a tr:hover td
        {
            background: #d0dafd;
            color: #339;
        }
    </style>
{/literal}
<div class="fundoPaper">
    <div class="paper">
        <table class="tabela" width="100%" border="1">
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
                    <table  id="box-table-a" width="100%" border="1">
                        <tr  >
                            <th >Descricao</th>
                            <th >Quant.</th>
                            <th >Valor<br />Unitário</th>
                            <th >Valor<br />Total</th>
                        </tr>
                        {section name=i loop=$itemLst} 
                            <tr>
                                <td >{$itemLst[i].Titulo}</td>
                                <td align="center">{$itemLst[i].Quantidade}</td>
                                <td align="right">R$ {$itemLst[i].ValorVenda|number_format:2:',':''}</td>
                                <td align="right">R$ {$itemLst[i].ValorTotal|number_format:2:',':''}</td>
                            </tr>
                        {/section}
                    </table>
                </td>
            </tr>
            <tr>
                <td valign="top" colspan="3">
                    <h3>Forma de Pagamento:</h3>
                    <p>Entrada: R$ {$valorEntrada|number_format:2:',':''}</p>
                    <p>Mais {$numParcelas} vezes de R$ {$valorParcela|number_format:2:',':''}.</p>
                    <p>Total a pagar: R$ {$valorTotal|number_format:2:',':''}</p>
                </td>
            </tr>
            <tr>
                <td valign="top" align="center" colspan="3">
                    <p>Mural das Lembrancinhas agradece a sua prefer&ecirc;ncia.</p>
                </td>
            </tr>
        </table>
    </div> 
</div>