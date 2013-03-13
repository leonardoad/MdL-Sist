<?php /* Smarty version 2.6.26, created on 2012-05-06 02:41:26
         compiled from /var/www/Projetos//Opertur//Application/views/Login/trocasenha.tpl */ ?>
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