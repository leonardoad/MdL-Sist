{if $upload != ''}
<table>
	<tr>
		<td>{$upload}</td>
		<td><div id="filaEnvio" style="overflow-y:hidden; height:60px"></div></td>
	</tr>
</table>
{/if}
<fieldset id="listaArquivos">
	{$arquivos}
</fieldset>