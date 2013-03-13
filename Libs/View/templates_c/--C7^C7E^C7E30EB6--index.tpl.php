<?php /* Smarty version 2.6.26, created on 2012-05-31 00:38:15
         compiled from C:%5Cxampp%5Chtdocs%5CProjetos%5C%5COpertur%5C%5CApplication%5Cviews%5CArquivos/index.tpl */ ?>
<?php if ($this->_tpl_vars['upload'] != ''): ?>
<table>
	<tr>
		<td><?php echo $this->_tpl_vars['upload']; ?>
</td>
		<td><div id="filaEnvio" style="overflow-y:hidden; height:60px"></div></td>
	</tr>
</table>
<?php endif; ?>
<fieldset id="listaArquivos">
	<?php echo $this->_tpl_vars['arquivos']; ?>

</fieldset>