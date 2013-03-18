<?php /* Smarty version 2.6.26, created on 2013-03-18 00:23:43
         compiled from C:%5Cxampp%5Chtdocs%5Cmdlsist/MdL-Sist%5C%5Csite%5C%5CApplication%5Cviews%5CCliente/filtros.tpl */ ?>
<table>
  <tr>
    <td></td>
    <td><?php echo $this->_tpl_vars['ativoFiltro']; ?>
<label for="ativoFiltro">Ativo?:</label></td>
  </tr>
  <tr>
    <td><label for="nomeFiltro">Nome:</label></td>
    <td><?php echo $this->_tpl_vars['nomeFiltro']; ?>
</td>
  </tr>
  <tr>
    <td><label for="emailFiltro">Email:</label></td>
    <td><?php echo $this->_tpl_vars['emailFiltro']; ?>
</td>
  </tr>
  <tr>
  	<td><?php echo $this->_tpl_vars['btnFiltrar']; ?>
</td>
  	<td><?php echo $this->_tpl_vars['btnLimparFiltros']; ?>
</td>
  </tr>
</table>