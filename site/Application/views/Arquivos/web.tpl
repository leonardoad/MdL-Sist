<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Casa Marques.</title>
		<script type="text/javascript" src="./../../Libs/Scripts/jquery.js"></script>
		<script type="text/javascript" src="./../../Libs/Browser/Control.js"></script>
		<script type="text/javascript" src="./../Public/Js/PrettyPhoto.js"></script>
		{literal}
		<script type="text/javascript">
			$(document).ready(function(){
				$('a[rel^="galeria"]').prettyPhoto({allow_resize: false, overlay_gallery: false})
			})
		</script>
		{/literal}
		<link rel="stylesheet" href="./../Public/Css/PrettyPhoto.css">
		<link rel="stylesheet" href="./../Public/Css/Arquivos.css">
		
    </head>
    <body>
		<table align="center">
			<tr>
				<td id="descricaoAlbum">
					<h3>{$tituloAlbum}</h3>
					<pre>{$descricaoAlbum}</pre>
				</td>
			</tr>
			<tr>
				<td  align="center"><img src="./../Public/Images/barra.jpg"></td>
			</tr>
			<tr>
				<td>
					<form action="arquivos" name="arquivos" id="arquivos">
						<ul id="arquivosOrdem" name="arquivosOrdem">
						{section name=i loop=$arquivos}
							<li class="arquivos" id="{$arquivos[i].oid}" alt="{$arquivos[i].descricao}" title="{$arquivos[i].descricao}">
								<a href="{$arquivos[i].imagemG}" id="mostrarArquivos" name="mostrarArquivos" rel="galeria[galeria1]">
									<img class="imgArquivos" src="{$arquivos[i].imagem}" alt="{$arquivos[i].descricao}"/>
									<br>
									<div class="tituloAlbuns" title="{$arquivos[i].descricao}" alt="{$arquivos[i].descricao}">{$arquivos[i].descricao	}</div>
								</a>	
							</li>
							
						{/section}
						</ul>
					</form>
				</td>
			</tr>
			<tr>
				<td  align="center"><br><img src="./../Public/Images/barra.jpg"></td>
			</tr>
		</table>
    </body>
</html>
