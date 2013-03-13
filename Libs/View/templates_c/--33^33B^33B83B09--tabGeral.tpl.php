<?php /* Smarty version 2.6.26, created on 2012-05-28 20:52:33
         compiled from C:%5Cxampp%5Chtdocs%5CProjetos%5C%5COpertur%5C%5CApplication%5Cviews%5CUsuario/tabGeral.tpl */ ?>
<table>
  <tr>
    <td><label for="ativo">Ativo ?</label></td>
    <td><?php echo $this->_tpl_vars['ativo']; ?>
</td>
  </tr>
  <tr>
    <td><label for="loginUser"><?php echo $this->_tpl_vars['labelLogin']; ?>
:</label></td>
    <td><?php echo $this->_tpl_vars['loginUser']; ?>
</td>
  </tr>
  <tr>
    <td><label for="nomeCompleto"><?php echo $this->_tpl_vars['descricao']; ?>
:</label></td>
    <td><?php echo $this->_tpl_vars['nomeCompleto']; ?>
</td>
  </tr>
  <?php if ($this->_tpl_vars['grupo']): ?>
  <tr>
    <td><label for="senha">Senha:</label></td>
    <td><?php echo $this->_tpl_vars['senha']; ?>
</td>
  </tr>
  <tr>
    <td><label for="grupo">Grupo de acesso:</label></td>
    <td><?php echo $this->_tpl_vars['grupo']; ?>
</td>
  </tr>
  <tr>
    <td><label for="email">E-mail:</label></td>
    <td><?php echo $this->_tpl_vars['email']; ?>
</td>
  </tr>
  <tr>
    <td><label for="senhaEmail">Senha do e-mail:</label></td>
    <td><?php echo $this->_tpl_vars['senhaEmail']; ?>
</td>
  </tr>
  <tr>
    <td><label for="smtp">Servidor SMTP:</label></td>
    <td><?php echo $this->_tpl_vars['smtp']; ?>
</td>
  </tr>
  <tr>
    <td><label for="porta">Porta:</label></td>
    <td><?php echo $this->_tpl_vars['porta']; ?>
</td>
  </tr>
  <?php endif; ?>
  <tr>
    <td><label for="id_empresa">Empresa:</label></td>
    <td><?php echo $this->_tpl_vars['id_empresa']; ?>
</td>
  </tr>
</table>