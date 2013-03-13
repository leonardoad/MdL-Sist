<?php /* Smarty version 2.6.26, created on 2012-07-08 17:19:35
         compiled from C:%5Cxampp%5Chtdocs%5CProjetos%5C%5CTopChaves%5C%5CApplication%5Cviews%5CProduto/web_celula_produto.tpl */ ?>
        <table style="width: 180px" onclick="document.location = '<?php echo $this->_tpl_vars['HTTP_REFERER']; ?>
web/produto/id/<?php echo $this->_tpl_vars['id_produto']; ?>
'">
            <tr >
                <td  colspan="1" style="text-align: center; vertical-align: middle;height: 110px">
                    <?php echo $this->_tpl_vars['foto']; ?>

                </td>

            </tr>
            <tr>
                <td class="tituloProduto" >
                    <div style="overflow: hidden;height: 18px;text-align: center"><?php echo $this->_tpl_vars['titulo']; ?>
</div>
                </td>
<!--                <td  align="center">
                    <a href="<?php echo $this->_tpl_vars['HTTP_REFERER']; ?>
web/produto/id/<?php echo $this->_tpl_vars['id_produto']; ?>
"><div class="caixaTexto" style="float: right;vertical-align: bottom">Detalhes</div></a>
                </td>-->

            </tr>
        </table>   