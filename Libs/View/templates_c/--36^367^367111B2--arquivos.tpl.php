<?php /* Smarty version 2.6.26, created on 2012-07-08 22:50:44
         compiled from C:%5Cxampp%5Chtdocs%5CProjetos%5C%5CTopChaves%5C%5CApplication%5Cviews%5CArquivos/arquivos.tpl */ ?>
<legend>Arquivos</legend>

<ul id="arquivosOrdem" name="arquivosOrdem" style="margin: 0;padding:0">
    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['arquivos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <li id="<?php echo $this->_tpl_vars['arquivos'][$this->_sections['i']['index']]['id']; ?>
" style="border: 0px solid #000; float:left; margin: 5px; text-align:center; width:150px; height:130px; list-style:none; " alt="<?php echo $this->_tpl_vars['arquivos'][$this->_sections['i']['index']]['descricao']; ?>
" title="<?php echo $this->_tpl_vars['arquivos'][$this->_sections['i']['index']]['descricao']; ?>
">
<!--        <a href="../arquivos/download/id/<?php echo $this->_tpl_vars['arquivos'][$this->_sections['i']['index']]['id']; ?>
" id="arquivos" name="download">-->
            
            <div style="height: 70px;width: 95px;overflow:hidden">
                <img  src="<?php echo $this->_tpl_vars['arquivos'][$this->_sections['i']['index']]['imagem']; ?>
"  />
            </div>
<!--        </a>-->
        <br><br>
        <div style="overflow:hidden;height:20px" title="<?php echo $this->_tpl_vars['arquivos'][$this->_sections['i']['index']]['descricao']; ?>
" alt="<?php echo $this->_tpl_vars['arquivos'][$this->_sections['i']['index']]['descricao']; ?>
"><b><?php echo $this->_tpl_vars['arquivos'][$this->_sections['i']['index']]['descricao']; ?>
.</b></div>
        <?php if (1 != 1): ?><input type="radio" name="principal" id="principal" params="arquivo=<?php echo $this->_tpl_vars['arquivos'][$this->_sections['i']['index']]['id']; ?>
" event="change" <?php if ($this->_tpl_vars['arquivos'][$this->_sections['i']['index']]['principal']): ?> checked="checked" <?php endif; ?>><?php endif; ?>
                          <?php if ($this->_tpl_vars['editar']): ?><img event="click" src="<?php echo $this->_tpl_vars['HTTP_REFERER']; ?>
../Libs/Images/Buttons/Novo.png" id="editarArquivo" name="../Arquivo/editarArquivo" params="arquivo=<?php echo $this->_tpl_vars['arquivos'][$this->_sections['i']['index']]['id']; ?>
"/><?php endif; ?>
        <?php if ($this->_tpl_vars['excluir']): ?><img event="click" src="<?php echo $this->_tpl_vars['HTTP_REFERER']; ?>
../Libs/Images/Buttons/Cancelar.png" msg="Deseja excluir o item selecionado?" id="excluirarquivo" name="../Arquivo/excluirarquivo" params="arquivo=<?php echo $this->_tpl_vars['arquivos'][$this->_sections['i']['index']]['id']; ?>
"/><?php endif; ?>
    </li>
    <?php endfor; endif; ?>
</ul>
<!--<?php if ($this->_tpl_vars['editar']): ?>
<?php echo '
<script type="text/javascript">
    $(\'#arquivosOrdem\').sortable({
        update: function(){
            $(this).attr(\'params\', \'ordem=\'+$(\'#arquivosOrdem\').sortable(\'toArray\'));
            ajaxRequest($(this), \'change\');
        }
    })
</script>
'; ?>

<?php endif; ?>-->