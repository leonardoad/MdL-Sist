<?php /* Smarty version 2.6.26, created on 2013-03-17 03:13:34
         compiled from C:%5Cxampp%5Chtdocs%5Cmdlsist/MdL-Sist%5C%5Csite%5C%5CApplication%5Cviews%5COrdem/addProduto.tpl */ ?>
<table>

    <tr>
        <td><label for="quantidade">Quantidade:</label></td>
        <td><?php echo $this->_tpl_vars['quantidade']; ?>
</td>
    </tr>
    <tr>
        <td><label for="produto">Produto:</label></td>
        <td ><?php echo $this->_tpl_vars['id_produto']; ?>
</td>
    </tr>
    <tr>
        <td><label for="valorcusto">Custo Unitário(R$):</label></td>
        <td><?php echo $this->_tpl_vars['valorcusto']; ?>
</td>
    </tr>
    <tr>
        <td><label for="valorvenda">Venda Unitário(R$):</label></td>
        <td><?php echo $this->_tpl_vars['valorvenda']; ?>
</td>
    </tr>  
    <tr>
        <td nowrap><label for="valortotal">Valor Total Venda(R$):</label></td>
        <td><?php echo $this->_tpl_vars['valortotal']; ?>
</td>
    </tr>  
    <tr>  
        <td  ><?php echo $this->_tpl_vars['btnSalvarProduto']; ?>
</td>
        <td width="277"><?php echo $this->_tpl_vars['btnCancelarProduto']; ?>
</td>
    </tr>

</table>