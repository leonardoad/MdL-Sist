<?php /* Smarty version 2.6.26, created on 2013-03-13 23:59:29
         compiled from C:%5Cxampp%5Chtdocs%5Cmdlsist/MdL-Sist%5C%5Csite%5C%5CApplication%5Cviews%5CProduto/web_linha_capa.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'C:\\xampp\\htdocs\\mdlsist/MdL-Sist\\\\site\\\\Application\\views\\Produto/web_linha_capa.tpl', 14, false),)), $this); ?>
<tr>
    <td>
        <table onclick="document.location = '<?php echo $this->_tpl_vars['HTTP_REFERER']; ?>
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
                <td class="texto">
                    <?php echo ((is_array($_tmp=$this->_tpl_vars['descricao'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 200) : smarty_modifier_truncate($_tmp, 200)); ?>

                    
                </td>
            </tr>
        </table>   
    </td>

</tr>