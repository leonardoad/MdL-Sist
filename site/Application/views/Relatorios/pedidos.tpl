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
            width: 90%;
            text-align: left;
            border-collapse: collapse;
        }
        #box-table-a th
        {
            font-size: 12px;
            font-weight: normal;
            padding: 2px;
            background: #b9c9fe;
            border-top: 4px solid #aabcfe;
            border-bottom: 1px solid #fff;
            color: #039;
        }
        #box-table-a td
        {
            padding: 2px;
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
                <td valign="top"><h3>Relatório de Pedidos</h3></td>
                <td valign="top">
                    <h4>Impressão: {$dataImpressao}</h4>
                    <h4>Impresso por: {$usuario}</h4>
                </td>
            </tr>
            <tr>
                <td valign="top" colspan="3">
                    <table  id="box-table-a" width="100%" border="1">
                        {section name=i loop=$itemLst} 
                            <tr  >
                                <th colspan="1"><h3>{$itemLst[i].dataEntrega}</h3></th>
                                <th colspan="1"> {$itemLst[i].cliente} ({$itemLst[i].emailCliente})</th>
                            </tr>
                            {*<tr  >
                                <td>
                                    <table  id="box-table-a" width="100%" border="1">
                                        <tr  >
                                            <th >Quant.</th>
                                            <th >Descricao</th>
                                            <th >Valor Unitário</th>
                                            <th >Valor Total</th>
                                        </tr> *}
                                        {section name=j loop=$itemLst[i].produtos} 
                                            <tr>
                                                <td align="center">{$itemLst[i].produtos[j].Quantidade}</td>
                                                <td >{$itemLst[i].produtos[j].Titulo}</td>
                                                {*
                                                <td align="right">R$ {$itemLst[i].produtos[j].ValorVenda|number_format:2:',':''}</td>
                                                <td align="right">R$ {$itemLst[i].produtos[j].ValorTotal|number_format:2:',':''}</td>
                                                *}
                                            </tr>
                                        {/section}
                              {*      </table>
                                </td>
                            </tr>*}
                        {/section}
                </td>
            </tr>
        </table>
    </div> 
</div>