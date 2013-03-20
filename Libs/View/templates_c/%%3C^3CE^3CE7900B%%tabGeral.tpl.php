<?php /* Smarty version 2.6.26, created on 2013-03-19 23:52:31
         compiled from C:%5Cxampp%5Chtdocs%5Cmdlsist/MdL-Sist%5C%5Csite%5C%5CApplication%5Cviews%5COrdem/tabGeral.tpl */ ?>
<table>

    <tr>
        <td>&nbsp;</td>
        <td> <?php echo $this->_tpl_vars['ativo']; ?>
<label for="cliente">OS Ativa</label></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td><label for="cliente">Cliente:</label></td>
        <td><?php echo $this->_tpl_vars['nomecliente']; ?>
</td>
        <td> <?php echo $this->_tpl_vars['btnCliente']; ?>
</td>
    </tr>
    <tr>
        <td><label for="datapedido">Data do Pedido:</label></td>
        <td colspan="2"><?php echo $this->_tpl_vars['datapedido']; ?>
</td>
    </tr>
    <tr>
        <td><label for="dataentrega">Data da Entrega</label></td>
        <td colspan="2"><?php echo $this->_tpl_vars['dataentrega']; ?>
</td>
    </tr> 



</table>