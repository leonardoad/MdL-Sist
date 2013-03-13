<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Casa Marques.</title>
		<script type="text/javascript" src="./../Libs/Scripts/jquery.js"></script>
		<script type="text/javascript" src="./../Libs/Browser/Control.js"></script>
		
		<link rel="stylesheet" href="./Public/Css/Albuns.css">
		
    </head>
    <body>
		<table align="center">
			<tr>
				<td><img src="./Public/Images/barra.jpg"></td>
			</tr>
			<tr>
				<td>
					<form action="albuns" name="albuns" id="albuns">
						<ul id="albunsOrdem" name="albunsOrdem">
						{section name=i loop=$albuns}
						
							<li class="albuns" id="{$albuns[i].oid}" alt="{$albuns[i].descricao}" title="{$albuns[i].descricao}">
								<a href="#none" event="click" params="album={$albuns[i].oid}" id="mostrarArquivos" name="mostrarArquivos">
									<img class="imgProduto" src="{$albuns[i].imagem}" />
									<br>
									<div class="tituloAlbuns" title="{$albuns[i].titulo}" alt="{$albuns[i].titulo}">{$albuns[i].titulo}</div>
								</a>	
							</li>
							
						{/section}
						</ul>
					</form>
				</td>
			</tr>
			<tr>
				<td><img src="./Public/Images/barra.jpg"></td>
			</tr>
		</table>
    </body>
</html>
