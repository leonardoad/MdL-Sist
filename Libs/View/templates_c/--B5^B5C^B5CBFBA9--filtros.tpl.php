<?php /* Smarty version 2.6.26, created on 2012-05-28 20:52:10
         compiled from C:%5Cxampp%5Chtdocs%5CProjetos%5C%5COpertur%5C%5CApplication%5Cviews%5CUsuario/filtros.tpl */ ?>
<table>
  <tr>
    <td><label for="ativoFiltro">Ativo?:</label></td>
    <td><?php echo $this->_tpl_vars['ativoFiltro']; ?>
</td>
  </tr>
  <tr>
    <td><label for="loginUserFiltro">Login:</label></td>
    <td><?php echo $this->_tpl_vars['loginUserFiltro']; ?>
</td>
  </tr>
  <tr>
    <td><label for="nomeCompletoFiltro">Nome:</label></td>
    <td><?php echo $this->_tpl_vars['nomeCompletoFiltro']; ?>
</td>
  </tr>
  <tr>
  	<td><?php echo $this->_tpl_vars['btnFiltrar']; ?>
</td>
  	<td><?php echo $this->_tpl_vars['btnLimparFiltros']; ?>
</td>
  </tr>
</table>