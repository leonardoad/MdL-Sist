<?php /* Smarty version 2.6.26, created on 2012-07-01 19:06:56
         compiled from C:%5Cxampp%5Chtdocs%5CProjetos%5C%5COpertur%5C%5CApplication%5Cviews%5CArquivos/edit.tpl */ ?>
<fieldset>
	<legend>Edição de Album</legend>
	<table><?php if (1 != 1): ?>
	  <tr>
	    <td><label for="ativo">Ativo ?</label><?php echo $this->_tpl_vars['ativo']; ?>
</td>
	    <td></td>
	  </tr>
	  <?php endif; ?>
	  <tr>
	    <td><label for="descricao">Descricao</label></td>
	    <td><?php echo $this->_tpl_vars['descricao']; ?>
</td>
	  </tr>
	  <tr>
	    <td><label for="descricao">Link</label></td>
            <td style="font-size: 11px"><?php echo $this->_tpl_vars['link']; ?>
<br>
            link para um produto ou para outro site. <br>Ex.: http://topchaves.com.br/web/produto/id/1</td>
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