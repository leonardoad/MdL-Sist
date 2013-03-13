<?php /* Smarty version 2.6.26, created on 2012-06-26 10:37:00
         compiled from C:%5Cxampp%5Chtdocs%5CProjetos%5C%5COpertur%5C%5CApplication%5Cviews%5CProduto/linha_capa.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'C:\\xampp\\htdocs\\Projetos\\\\Opertur\\\\Application\\views\\Produto/linha_capa.tpl', 14, false),)), $this); ?>
<tr>
    <td>
        <table onclick="document.location = '<?php echo $this->_tpl_vars['ENDERECO_WEB']; ?>
web/produto/id/<?php echo $this->_tpl_vars['id_produto']; ?>
'">
            <tr >
                <td rowspan="2" style="width: 100px">
                    <?php echo $this->_tpl_vars['foto']; ?>

                </td>
                <td class="tituloProduto">
                    <?php echo $this->_tpl_vars['titulo']; ?>

                </td>
            </tr>
            <tr>
                <td class="descricaoProduto">
                    <?php echo ((is_array($_tmp=$this->_tpl_vars['descricao'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 200) : smarty_modifier_truncate($_tmp, 200)); ?>

                    
                </td>
            </tr>
        </table>   
    </td>

</tr>