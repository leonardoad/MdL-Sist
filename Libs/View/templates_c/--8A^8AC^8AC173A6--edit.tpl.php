<?php /* Smarty version 2.6.26, created on 2012-05-31 00:04:45
         compiled from C:%5Cxampp%5Chtdocs%5CProjetos%5C%5COpertur%5C%5CApplication%5Cviews%5CAlbuns/edit.tpl */ ?>
<fieldset>
	<legend>Edição de Album</legend>
	<table>
	  <tr>
	    <td><label for="titulo">Titulo</label></td>
	    <td></td>
	  </tr>
	  <tr>
	  	<td colspan="2"><?php echo $this->_tpl_vars['titulo']; ?>
</td>
	  </tr>
	  <tr>
	  	<td><?php echo $this->_tpl_vars['upload']; ?>
</td>
		<td></td>
	  </tr>
	  <tr>
      	<td colspan="2">
            <table>
                <tr>
                     <td><?php echo $this->_tpl_vars['btnSalvar']; ?>
</td>
                     <td><?php echo $this->_tpl_vars['btnCancelar']; ?>
</td>
                </tr>
            </table>
        </td>
	  </tr>
	</table>
</fieldset>