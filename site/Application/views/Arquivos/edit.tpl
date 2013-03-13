<fieldset>
	<legend>Edição de Album</legend>
	<table>{if 1 != 1}
	  <tr>
	    <td><label for="ativo">Ativo ?</label>{$ativo}</td>
	    <td></td>
	  </tr>
	  {/if}
	  <tr>
	    <td><label for="descricao">Descricao</label></td>
	    <td>{$descricao}</td>
	  </tr>
	  <tr>
	    <td><label for="descricao">Link</label></td>
            <td style="font-size: 11px">{$link}<br>
            link para um produto ou para outro site. <br>Ex.: http://topchaves.com.br/web/produto/id/1</td>
	  </tr>
	   
	  <tr>
      	<td colspan="2">
            <table>
                <tr>
                     <td>{$btnSalvar}</td>
                     <td>{$btnCancelar}</td>
                </tr>
            </table>
        </td>
	  </tr>
	</table>
</fieldset>