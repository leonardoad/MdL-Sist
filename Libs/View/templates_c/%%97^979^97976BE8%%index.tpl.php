<?php /* Smarty version 2.6.26, created on 2013-03-14 22:47:06
         compiled from C:%5Cxampp%5Chtdocs%5Cmdlsist/MdL-Sist%5C%5Csite%5C%5CApplication%5Cviews%5CArquivos/index.tpl */ ?>
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