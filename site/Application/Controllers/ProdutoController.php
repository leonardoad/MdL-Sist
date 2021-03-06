<?php

class ProdutoController extends Zend_Controller_Action {

    public function init() {
        Browser_Control::setScript('js', 'Mask', 'Mask/Mask.js');

        Browser_Control::setScript('js', 'Easydrag', 'easydrag.js');

        Browser_Control::setScript('js', 'Upload', 'Upload/Upload.js');
        Browser_Control::setScript('js', 'SwfUpload', 'Upload/Swfobject.js');
        Browser_Control::setScript('css', 'Upload', 'Upload/Upload.css');
    }

    public function indexAction() {
        $form = new Ui_Form();
        $form->setName('formProduto');
        $form->setAction('Produto');

        $grid = new Ui_Element_Grid('gridProdutos');
        $grid->setParams('Produto', 'Produto/listaproduto');
//		$grid->setOrder('Nome');

        $button = new Ui_Element_Grid_Button('btnNovo', 'Inserir');
        $button->setImg('Buttons/Novo.png');
        $button->setVisible('CAD_EMPRESA', 'inserir');
        $grid->addButton($button);

        $button = new Ui_Element_Grid_Button('btnExcluir', 'Excluir');
        $button->setImg('Buttons/Cancelar.png');
        $button->setAttribs('msg = "Excluir o item selecionado ?"');
        $button->setVisible('CAD_EMPRESA', 'excluir');
        $button->setSendFormFields();
        $grid->addButton($button);

        $column = new Ui_Element_Grid_Column_Check('ID', 'id_produto', '30', 'center');
        $grid->addColumn($column);

        $column = new Ui_Element_Grid_Column_Text('Titulo', 'titulo', '150');
        $grid->addColumn($column);
//
        $column = new Ui_Element_Grid_Column_Text('Descricao', 'descricao', '400');
        $grid->addColumn($column);
        
        $column = new Ui_Element_Grid_Column_Text('Valor Venda', 'valorvenda', '100');
        $grid->addColumn($column);
        
        $column = new Ui_Element_Grid_Column_Text('Valor Custo', 'valorcusto', '100');
        $grid->addColumn($column);


        $column = new Ui_Element_Grid_Column_Image('Destaque', 'destaque', '30', 'center');
        $column->setCondicao('S', 'destaque');
        $column->setImages(PATH_IMAGES . 'Buttons/Ok.png', PATH_IMAGES . 'Buttons/Cancelar.png');
        $grid->addColumn($column);

        $form->addElement($grid);

        $view = Zend_Registry::get('view');

        $view->assign('scripts', Browser_Control::getScripts());
        $view->assign('body', $form->displayTpl($view, 'Produto/index.tpl'));
        $view->output('index.tpl');
    }

    public function edit() {
        $post = Zend_Registry::get('post');

        $view = Zend_Registry::get('view');

        $form = new Ui_Form();
        $form->setAction('Produto');
        $form->setName('formProdutoEdit');

        $mainTab = new Ui_Element_TabMain('editProdutoTab');

        $tab = new Ui_Element_Tab('tabGeral');
        $tab->setTitle('Geral');
        $tab->setTemplate('Produto/tabGeral.tpl');

        $element = new Ui_Element_Checkbox('destaque');
        $element->setCheckedValue(cTRUE);
        $element->setUncheckedValue(cFALSE);
        $tab->addElement($element);

        $element = new Ui_Element_Text('titulo');
        $element->setAttrib('obrig', 'obrig');
        $element->setRequired();
        $element->setAttrib('size', '50');
        $tab->addElement($element);

        
        $element = new Ui_Element_TextMask('valorcusto');
        $element->setMask('99,99999', true);
        $element->setAttrib('obrig', 'obrig');
        $element->setRequired();
        $element->setAttrib('size', '10');
        $tab->addElement($element);
        
        $element = new Ui_Element_TextMask('valorvenda');
        $element->setMask('99,99999', true);
        $element->setAttrib('obrig', 'obrig');
        $element->setRequired();
        $element->setAttrib('size', '10');
        $tab->addElement($element);

        $element = new Ui_Element_Textarea('descricao');
//        $element->setAttrib('obrig', 'obrig');
//        $element->setRequired();
        $element->setAttrib('rows', '5');
        $element->setAttrib('cols', '50');
        $tab->addElement($element);

        $mainTab->addTab($tab);

        // Logs
        $tab = new Ui_Element_Tab('tabImagens');
        $tab->setTitle('Imagens');
        $tab->setTemplate('Produto/tabImagens.tpl');

        
         $element = new Ui_Element_Upload('upload');
        $element->setParams('Enviar Arquivo',HTTP_REFERER. 'Arquivo/upload', true);
        $element->setOndeMostraFila('filaEnvio');
        $element->dataSend('album', $post->id);
        $element->setVisible('PROC_CAD_ARQUIVOS', 'inserir');
        $tab->addElement($element);
        
        $view->assign('arquivos', $this->listaarquivosAction('', $post->id,false,true));

        $mainTab->addTab($tab);

        $form->addElement($mainTab);

        Session_Control::setDataSession('album', $post->id);
        $obj = new Produto();
        if (isset($post->id)) {
            $obj->read($post->id);
            $obj->setInstance('produtoEdit');
            Session_Control::setDataSession('albumEdit',$post->id );
        }
        $form->setDataForm($obj);

        $salvar = new Ui_Element_Btn('btnSalvar');
        $salvar->setDisplay('Salvar', PATH_IMAGES . 'Buttons/Ok.png');
        if (isset($post->id)) {
            $salvar->setAttrib('params', 'id=' . $post->id);
        }
        $salvar->setAttrib('sendFormFields', '1');
        $salvar->setAttrib('validaObrig', '1');
        $form->addElement($salvar);

        $cancelar = new Ui_Element_Btn('btnCancelar');
        $cancelar->setDisplay('Cancelar', PATH_IMAGES . 'Buttons/Cancelar.png');
        $form->addElement($cancelar);

        $form->setDataSession();



        $w = new Ui_Window('EditProduto', 'Edição de produto', $form->displayTpl($view, 'Produto/edit.tpl'), true);
        $w->setDimension('700', '400');
        $w->setCloseOnEscape(true);
        $br = new Browser_Control();
        $br->newWindow($w);
        $br->send();
    }

    public function listaarquivosAction($todos = '', $album = '', $returnArray = false, $upload = false) {

        $view = Zend_Registry::get('view');


        $ret = '';

        if ($album == '') {
            $album = Session_Control::getDataSession('albumEdit');
        }

        $arquivos = new Arquivo();
        $arquivos->where('id_owner', $album);
        if ($todos == '') {
            $arquivos->where('ativo', 'S');
        }

        Session_Control::setDataSession('mostraTodosArquivos', $todos);

        $arquivos->sortOrder('ordem');
        $arquivos->readLst();

        for ($i = 0; $i < $arquivos->countItens(); $i++) {
            $item = $arquivos->getItem($i);


            $type = array('jpg', 'png', 'gif');

            if (in_array(strtolower($item->getExt()), $type)) {
                $ret[$i]['id'] = $item->getid();
                $ret[$i]['descricao'] = $item->getDescricao();
                $ret[$i]['imagem'] = PATH_PUBLIC . 'Arquivos/' . $item->getid() . '_mini.' . $item->getExt();
                $ret[$i]['imagemG'] = PATH_PUBLIC . 'Arquivos/' . $item->getid() . '.' . $item->getExt();
                $ret[$i]['editar'] = Usuario::verificaAcesso('PROC_CAD_ARQUIVOS', 'editar');
                $ret[$i]['excluir'] = Usuario::verificaAcesso('PROC_CAD_ARQUIVOS', 'excluir');
                if ($item->getPrincipal() == 'S') {
                    $ret[$i]['principal'] = true;
                } else {
                    $ret[$i]['principal'] = false;
                }
            } else {
                $ret[$i]['id'] = $item->getid();
                $ret[$i]['descricao'] = $item->getDescricao();
                $ret[$i]['imagem'] = PATH_PUBLIC . 'Arquivos/' . $item->getExt() . '.png';
                $ret[$i]['imagemG'] = PATH_PUBLIC . 'Arquivos/' . $item->getExt() . '.' . $item->getExt();
            }
        }

        $view->assign('arquivos', $ret);

        if (!$upload) {
            $editar = Usuario::verificaAcesso('PROC_CAD_ARQUIVOS', 'editar');
            $excluir = Usuario::verificaAcesso('PROC_CAD_ARQUIVOS', 'excluir');
        } else {
            $editar = '1';
            $excluir = '1';
        }
        $view->assign('editar', $editar);
        $view->assign('excluir', $excluir);
        if (!$returnArray) {
            return $view->fetch('Arquivos/arquivos.tpl');
        } else {
            return $ret;
        }
    }

    public function btnnovoclickAction() {
        $this->edit();
    }

    public function btnsalvarclickAction() {
        $form = Session_Control::getDataSession('formProdutoEdit');

        $valid = $form->processAjax($_POST);

        $br = new Browser_Control();
        if ($valid != 'true') {
            $br->validaForm($valid);
            $br->send();
            exit;
        }

        $post = Zend_Registry::get('post');
        $obj = new Produto();
        if (isset($post->id)) {
            $obj->read($post->id);
        }
        $obj->setDataFromRequest($post);
        $obj->save();

        $br->setRemoveWindow('EditProduto');
        $br->setUpdateGrid('gridProdutos');
        $br->send();

        Session_Control::setDataSession('formProdutoEdit', '');
    }

    public function btnexcluirclickAction() {
        Grid_Control::deleteDataGrid('Produto', '', 'gridProduto');
    }

    public function btncancelarclickAction() {
        $br = new Browser_Control;
        $br->setRemoveWindow('EditProduto');
        $br->send();
    }

    public function gridprodutosdblclickAction() {
        $this->edit();
    }

    public function listaimagensAction() {
        $Produto = Session_Control::getDataSession('produtoEdit');
        $arquivos = new Arquivo();
        $arquivos->where('id_owner', $Produto->getID());

        Grid_Control::setDataGrid($arquivos);
    }

    public function listaprodutoAction() {
        $obj = new Produto();
        Grid_Control::setDataGrid($obj);
    }

}