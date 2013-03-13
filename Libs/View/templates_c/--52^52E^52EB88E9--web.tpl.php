<?php /* Smarty version 2.6.26, created on 2012-05-30 23:54:01
         compiled from C:%5Cxampp%5Chtdocs%5CProjetos%5C%5COpertur%5C%5CApplication%5Cviews%5CAlbuns/web.tpl */ ?>
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
						<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['albuns']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
						
							<li class="albuns" id="<?php echo $this->_tpl_vars['albuns'][$this->_sections['i']['index']]['oid']; ?>
" alt="<?php echo $this->_tpl_vars['albuns'][$this->_sections['i']['index']]['descricao']; ?>
" title="<?php echo $this->_tpl_vars['albuns'][$this->_sections['i']['index']]['descricao']; ?>
">
								<a href="#none" event="click" params="album=<?php echo $this->_tpl_vars['albuns'][$this->_sections['i']['index']]['oid']; ?>
" id="mostrarArquivos" name="mostrarArquivos">
									<img class="imgProduto" src="<?php echo $this->_tpl_vars['albuns'][$this->_sections['i']['index']]['imagem']; ?>
" />
									<br>
									<div class="tituloAlbuns" title="<?php echo $this->_tpl_vars['albuns'][$this->_sections['i']['index']]['titulo']; ?>
" alt="<?php echo $this->_tpl_vars['albuns'][$this->_sections['i']['index']]['titulo']; ?>
"><?php echo $this->_tpl_vars['albuns'][$this->_sections['i']['index']]['titulo']; ?>
</div>
								</a>	
							</li>
							
						<?php endfor; endif; ?>
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