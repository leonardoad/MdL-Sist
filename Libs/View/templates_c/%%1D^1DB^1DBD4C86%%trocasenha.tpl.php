<?php /* Smarty version 2.6.26, created on 2013-03-13 14:27:53
         compiled from /var/www/desenv/testes/TopChaves/Site//site//Application/views/Login/trocasenha.tpl */ ?>
<table id="tableLogin" align="center">
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><label for="senhaAtual">Senha atual:</label></td>
		<td><?php echo $this->_tpl_vars['senhaAtual']; ?>
</td>
	</tr>
	<tr>
		<td><label for="senhaNova">Nova Senha:</label></td>
		<td><?php echo $this->_tpl_vars['senhaNova']; ?>
</td>
	</tr>
	<tr>
		<td></td>
		<td align="right" colspan="2"><?php echo $this->_tpl_vars['btnTrocaSenha']; ?>
</td>
	</tr>
</table>