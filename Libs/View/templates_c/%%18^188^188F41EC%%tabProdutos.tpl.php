<?php /* Smarty version 2.6.26, created on 2013-03-17 23:13:28
         compiled from C:%5Cxampp%5Chtdocs%5Cmdlsist/MdL-Sist%5C%5Csite%5C%5CApplication%5Cviews%5COrdem/tabProdutos.tpl */ ?>
<table>
  
  <tr>
    <td><label for="percententrada">Entrada:</label></td>
    <td><?php echo $this->_tpl_vars['percententrada']; ?>
% ou R$<?php echo $this->_tpl_vars['valentrada']; ?>
</td>
  </tr>
  <tr>
    <td><label for="percentdesconto">Desconto:</label></td>
    <td><?php echo $this->_tpl_vars['percentdesconto']; ?>
% ou R$<?php echo $this->_tpl_vars['valdesconto']; ?>
</td>
  </tr>
  <tr>
    <td><label for="totalcusto">Total Custo(R$):</label></td>
    <td><?php echo $this->_tpl_vars['totalcusto']; ?>
</td>
  </tr>
  <tr>
    <td><label for="totalvenda">Total Venda(R$):</label></td>
    <td><?php echo $this->_tpl_vars['totalvenda']; ?>
</td>
  </tr>
</table>
  <?php echo $this->_tpl_vars['gridProdutos']; ?>