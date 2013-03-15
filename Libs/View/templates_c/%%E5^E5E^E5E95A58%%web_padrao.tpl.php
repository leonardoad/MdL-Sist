<?php /* Smarty version 2.6.26, created on 2013-03-13 23:59:34
         compiled from C:%5Cxampp%5Chtdocs%5Cmdlsist/MdL-Sist%5C%5Csite%5C%5CApplication%5Cviews%5CProduto/web_padrao.tpl */ ?>
 
<table border="0" style="width: 100%">

    <tbody>
        <tr >
            <td style="vertical-align: top;width:200px"  >
                <p class="titulo">Menu</p>
                <div class="divMenuProdutos">
                    <ul class="menuProdutos">
                        <?php echo $this->_tpl_vars['menu_produtos']; ?>

                    </ul>
                </div>
            </td>
            <td style="vertical-align: top;">
                <?php if ($this->_tpl_vars['textoBusca'] != ''): ?><p class="texto">Resultados da busca por "<?php echo $this->_tpl_vars['textoBusca']; ?>
"</p><?php endif; ?>
                <?php echo $this->_tpl_vars['produto_destaque']; ?>


            </td>
        </tr>

    </tbody>
</table>