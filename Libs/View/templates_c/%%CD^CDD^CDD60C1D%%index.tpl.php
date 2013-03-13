<?php /* Smarty version 2.6.26, created on 2013-03-13 14:25:12
         compiled from /var/www/desenv/testes/TopChaves/Site//site//Application/views/Login/index.tpl */ ?>
﻿<div id="conteudoWindow">

	<div id="formLogin">
		<table id="tableLogin" align="center">
			<tr>
				<td rowspan="4"><img src="../Libs/Images/Login.png" /></td>
				<td colspan="2"><div id="logoEmpresa"><img alt="" src=""></div></td>
			</tr>
			<tr>
				<td><label for="user">Usúario:</label></td>
				<td><?php echo $this->_tpl_vars['user']; ?>
</td>
			</tr>
			<tr>
				<td><label for="senha">Senha:</label></td>
				<td><?php echo $this->_tpl_vars['senha']; ?>
</td>
			</tr>
			<tr>
				<td></td>
				<td align="right" colspan="2"><?php echo $this->_tpl_vars['btnLogin']; ?>
</td>
			</tr>
		</table>
		<p class="warning" id="warning" align="center"></p>
	</div>
</div>