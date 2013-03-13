<?php /* Smarty version 2.6.26, created on 2012-07-05 11:15:09
         compiled from C:%5Cxampp%5Chtdocs%5CProjetos%5C%5COpertur%5C%5CApplication%5Cviews%5CAlbuns/albuns.tpl */ ?>
<!--<legend>Pastas</legend>-->
<ul id="albunsOrdem" name="albunsOrdem" style="margin: 0;padding:0">
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
    <li id="<?php echo $this->_tpl_vars['albuns'][$this->_sections['i']['index']]['id']; ?>
" style="  float:left; margin: 5px; text-align:center; width:140px; height:100px; list-style:none; text-align: center;vertical-align: middle">
        <a href="<?php echo $this->_tpl_vars['albuns'][$this->_sections['i']['index']]['imagemG']; ?>
" rel="prettyPhoto"    id="arquivos" name="arquivos">
<!--            <div style="height: 95px;width: 95px;overflow:hidden;text-align: center">-->
                <img  src="<?php echo $this->_tpl_vars['albuns'][$this->_sections['i']['index']]['imagem']; ?>
" alt="<?php echo $this->_tpl_vars['albuns'][$this->_sections['i']['index']]['titulo']; ?>
" title="<?php echo $this->_tpl_vars['albuns'][$this->_sections['i']['index']]['titulo']; ?>
"/>
<!--            </div>-->
        </a>	
        <div style="border:0px solid #fff; height: 19px; overflow: hidden;" title="<?php echo $this->_tpl_vars['albuns'][$this->_sections['i']['index']]['titulo']; ?>
" alt="<?php echo $this->_tpl_vars['albuns'][$this->_sections['i']['index']]['titulo']; ?>
"><b><?php echo $this->_tpl_vars['albuns'][$this->_sections['i']['index']]['titulo']; ?>
</b></div>
        <!--			<?php if ($this->_tpl_vars['editar']): ?><img event="click" src="./../../Libs/Images/Buttons/Novo.png" id="editarAlbum" name="editarAlbum" params="album=<?php echo $this->_tpl_vars['albuns'][$this->_sections['i']['index']]['id']; ?>
"/><?php endif; ?>
                                <?php if ($this->_tpl_vars['excluir']): ?><img event="click" src="./../../Libs/Images/Buttons/Cancelar.png" msg="Deseja excluir o item selecionado?" id="exluirAlbum" name="exluirAlbum" params="album=<?php echo $this->_tpl_vars['albuns'][$this->_sections['i']['index']]['id']; ?>
"/><?php endif; ?>-->
    </li>
    <?php endfor; endif; ?>
</ul>
<!--<?php if ($this->_tpl_vars['editar']): ?>
        <?php echo '
        <script type="text/javascript">
                $(\'#albunsOrdem\').sortable({
                        update: function(){
                                $(this).attr(\'params\', \'ordem=\'+$(\'#albunsOrdem\').sortable(\'toArray\'));
                                ajaxRequest($(this), \'change\');
                        }	
                })
        </script>
        '; ?>

<?php endif; ?>-->