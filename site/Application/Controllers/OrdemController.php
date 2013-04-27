<?php

class OrdemController extends Zend_Controller_Action {

    public function init() {
        Browser_Control::setScript('js', 'Mask', 'Mask/Mask.js');

        Browser_Control::setScript('js', 'Easydrag', 'easydrag.js');

//        Browser_Control::setScript('js', 'Upload', 'Upload/Upload.js');
//        Browser_Control::setScript('js', 'SwfUpload', 'Upload/Swfobject.js');
//        Browser_Control::setScript('css', 'Upload', 'Upload/Upload.css');
    }

    public function indexAction() {
        $form = new Ui_Form();
        $form->setName('formOrdem');
        $form->setAction('Ordem');

        $grid = new Ui_Element_Grid('gridOrdens');
        $grid->setParams('Ordem', 'Ordem/listaordem');
        $grid->setOrder('DataPedido', 'DESC');

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

        $column = new Ui_Element_Grid_Column_Check('ID', 'id_ordem', '30', 'center');
        $grid->addColumn($column);

        $column = new Ui_Element_Grid_Column_Text('Cliente', 'nomecliente', '150');
        $grid->addColumn($column);

        $column = new Ui_Element_Grid_Column_Text('Email', 'emailcliente', '150');
        $grid->addColumn($column);
//
        $column = new Ui_Element_Grid_Column_Text('Pedido', 'datapedido', '70');
        $grid->addColumn($column);
//
        $column = new Ui_Element_Grid_Column_Text('Entrega', 'dataentrega', '70');
        $grid->addColumn($column);

        $column = new Ui_Element_Grid_Column_Text('Valor Custo', 'totalcusto', '100');
        $grid->addColumn($column);

        $column = new Ui_Element_Grid_Column_Text('Valor Venda', 'totalvenda', '100');
        $grid->addColumn($column);


        $column = new Ui_Element_Grid_Column_Image('Ativo', 'ativo', '30', 'center');
        $column->setCondicao('S', 'ativo');
        $column->setImages(PATH_IMAGES . 'Buttons/Ok.png', PATH_IMAGES . 'Buttons/Cancelar.png');
        $grid->addColumn($column);

        $form->addElement($grid);

        $view = Zend_Registry::get('view');

        $view->assign('scripts', Browser_Control::getScripts());
        $view->assign('body', $form->displayTpl($view, 'Ordem/index.tpl'));
        $view->output('index.tpl');
    }

    public function edit() {
        $post = Zend_Registry::get('post');

        $view = Zend_Registry::get('view');

        $form = new Ui_Form();
        $form->setAction('Ordem');
        $form->setName('formOrdemEdit');

        $element = new Ui_Element_Hidden('id_cliente');
        $form->addElement($element);


        $mainTab = new Ui_Element_TabMain('editOrdemTab');
//        $mainTab->se

        $tab = new Ui_Element_Tab('tabGeral');
        $tab->setTitle('Geral');
        $tab->setTemplate('Ordem/tabGeral.tpl');

        $element = new Ui_Element_Checkbox('ativo');
        $element->setCheckedValue(cTRUE);
        $element->setUncheckedValue(cFALSE);
        $tab->addElement($element);


        $element = new Ui_Element_Text('nomecliente');
        $element->setAttrib('obrig', 'obrig');
        $element->setAttrib('event', 'focus');
        $element->setReadOnly(TRUE);
        $element->setRequired();
        $element->setAttrib('size', '35');
        $tab->addElement($element);

        $element = new Ui_Element_Btn('btnCliente');
        $element->setDisplay('Clientes', PATH_IMAGES . 'Buttons/Clientes.png');
        $tab->addElement($element);


        $element = new Ui_Element_Date('datapedido');
        $element->setAttrib('obrig', 'obrig');
        $element->setRequired();
        $element->setValue(date('d/m/Y'));
        $element->setAttrib('size', '10');
        $tab->addElement($element);

        $element = new Ui_Element_Date('dataentrega');
        $element->setAttrib('obrig', 'obrig');
        $element->setRequired();
        $element->setAttrib('size', '10');
        $tab->addElement($element);


        $mainTab->addTab($tab);

        // ABA Produtos
        $tab = new Ui_Element_Tab('tabProdutos');
        $tab->setTitle('Produtos');
        $tab->setTemplate('Ordem/tabProdutos.tpl');


        $element = new Ui_Element_TextMask('percententrada');
        $element->setMask('991', true);
        $element->setAttrib('event', 'blur');
        $element->setRequired();
        $element->setAttrib('size', '2');
        $tab->addElement($element);

        $element = new Ui_Element_TextMask('valentrada');
        $element->setMask('99,99999', true);
        $element->setAttrib('event', 'blur');
        $element->setRequired();
        $element->setAttrib('size', '10');
        $tab->addElement($element);

        $element = new Ui_Element_TextMask('percentdesconto');
        $element->setMask('991', true);
        $element->setAttrib('event', 'blur');
        $element->setRequired();
        $element->setAttrib('size', '2');
        $tab->addElement($element);

        $element = new Ui_Element_TextMask('numvezes');
        $element->setMask('99', true);
        $element->setAttrib('event', 'blur');
        $element->setRequired();
        $element->setAttrib('size', '2');
        $tab->addElement($element);

        $element = new Ui_Element_TextMask('valorparcela');
        $element->setAttrib('size', '10');
        $element->setReadOnly(TRUE);
        $tab->addElement($element);

        $element = new Ui_Element_TextMask('valdesconto');
        $element->setMask('99,99999', true);
        $element->setAttrib('event', 'blur');
        $element->setRequired();
        $element->setAttrib('size', '10');
        $tab->addElement($element);


        $element = new Ui_Element_TextMask('totalcusto');
        $element->setMask('99,99999', true);
        $element->setAttrib('obrig', 'obrig');
        $element->setReadOnly(TRUE);
        $element->setRequired();
        $element->setAttrib('size', '10');
        $tab->addElement($element);

        $element = new Ui_Element_TextMask('totalvenda');
        $element->setMask('99,99999', true);
        $element->setAttrib('obrig', 'obrig');
        $element->setReadOnly(TRUE);
        $element->setRequired();
        $element->setAttrib('size', '10');
        $tab->addElement($element);

        $grid = new Ui_Element_Grid('gridProdutos');
        $grid->setParams('Produtos', 'Ordem/listaproduto');
        $grid->setController('Ordem');
        $grid->setDimension('645', '150');

        $button = new Ui_Element_Grid_Button('btnNovoProduto', 'Inserir');
        $button->setImg('Buttons/Novo.png');
        $button->setVisible('CAD_EMPRESA', 'inserir');
        $grid->addButton($button);

        $button = new Ui_Element_Grid_Button('btnExcluirProduto', 'Excluir');
        $button->setImg('Buttons/Cancelar.png');
        $button->setAttribs('msg = "Excluir o item selecionado ?"');
        $button->setVisible('CAD_EMPRESA', 'excluir');
        $button->setSendFormFields();
        $grid->addButton($button);

        $column = new Ui_Element_Grid_Column_Check('ID', 'id_ordemproduto', '30', 'center');
        $grid->addColumn($column);

        $column = new Ui_Element_Grid_Column_Text('Quantidade', 'quantidade', '30');
        $grid->addColumn($column);

        $column = new Ui_Element_Grid_Column_Text('Titulo', 'titulo', '150');
        $grid->addColumn($column);
//
        $column = new Ui_Element_Grid_Column_Text('Venda Unidade', 'valorvenda', '100');
        $grid->addColumn($column);

        $column = new Ui_Element_Grid_Column_Text('Custo Unidade', 'valorcusto', '100');
        $grid->addColumn($column);

        $column = new Ui_Element_Grid_Column_Text('Valor Total', 'valortotal', '100');
        $grid->addColumn($column);

        $tab->addElement($grid);

        $mainTab->addTab($tab);

        $form->addElement($mainTab);

        $obj = new Ordem();
        if (isset($post->id)) {
            $obj->read($post->id);
        }
        $obj->setInstance('ordemEdit');
        $form->setDataForm($obj);

        $element = new Ui_Element_Btn('btnSalvar');
        $element->setDisplay('Salvar', PATH_IMAGES . 'Buttons/Ok.png');
        if (isset($post->id)) {
            $element->setAttrib('params', 'id=' . $post->id);
        }
        $element->setAttrib('sendFormFields', '1');
        $element->setAttrib('validaObrig', '1');
        $form->addElement($element);

        $element = new Ui_Element_Btn('btnCancelar');
        $element->setDisplay('Cancelar', PATH_IMAGES . 'Buttons/Cancelar.png');
        $form->addElement($element);

        $element = new Ui_Element_Btn('btnVisualizarEmail');
        $element->setDisplay('Vizualizar Email', PATH_IMAGES . 'Buttons/Visualizar.png');
        $form->addElement($element);

        $form->setDataSession();



        $w = new Ui_Window('EditOrdem', 'Edição de Ordem de Serviço', $form->displayTpl($view, 'Ordem/edit.tpl'), true);
        $w->setDimension('800', '550');
        $w->setCloseOnEscape(true);
        $br = new Browser_Control();
        $br->newWindow($w);
        $br->send();
    }

    public function btnvisualizaremailclickAction() {
        $br = new Browser_Control();
        $br->setNewTab(HTTP_REFERER . 'Ordem/visualizaemail');
        $br->send();
    }

    public function visualizaemailAction() {
        $view = Zend_Registry::get('view');
        $lOrdem = Session_Control::getDataSession('ordemEdit');


        $view->assign('dataPedido', $lOrdem->getDataPedido());
        $view->assign('dataEntrega', $lOrdem->getDataEntrega());

        $view->assign('nomeCliente', $lOrdem->getNomeCliente());
        $view->assign('emailCliente', $lOrdem->getEmailCliente());
        $view->assign('telefoneCliente', $lOrdem->getTelefonesCliente());
        $OrdemProdutoLst = $lOrdem->getOrdemProdutoLst();
        for ($i = 0; $i < $OrdemProdutoLst->countItens(); $i++) {
            $Item = $OrdemProdutoLst->getItem($i);
            $item['Titulo'] = $Item->getTitulo();
            $item['Quantidade'] = $Item->getQuantidade();
            $item['ValorVenda'] = $Item->getValorVenda();
            $item['ValorTotal'] = $Item->getValorTotal();
            
            $itemLst[] = $item;
            
            $itemTotal['Quantidade'] += $Item->getQuantidade();
            $itemTotal['ValorVenda'] += $Item->getValorVenda();
            $itemTotal['ValorTotal'] += $Item->getValorTotal();
        }
        $itemTotal['Titulo'] = "<b>Total:</b>";
        $itemLst[] = $itemTotal;

        $view->assign('itemLst', $itemLst);
        
        // forma de pagamento
        $view->assign('valorTotal', $itemTotal['ValorTotal']);
        $view->assign('valorEntrada', $lOrdem->getValEntrada());
        $view->assign('numParcelas', $lOrdem->getNumVezes());
        $view->assign('valorParcela', $lOrdem->getValorParcela());


        $html = $view->fetch('Ordem/email.tpl');
        $view->assign('scripts', Browser_Control::getScripts());
        $view->assign('body', $html);
        $view->output('index.tpl');
    }

    public function btnnovoclickAction() {
        $this->edit();
    }

    public function btnclienteclickAction() {
        $this->redirect('Cliente/selcliente');
    }

    public function nomeclientefocusAction() {
        $this->redirect('Cliente/selcliente');
    }

    public function btnsalvarclickAction() {
        $form = Session_Control::getDataSession('formOrdemEdit');

        $valid = $form->processAjax($_POST);

        $br = new Browser_Control();
        if ($valid != 'true') {
            $br->validaForm($valid);
            $br->send();
            exit;
        }

        $post = Zend_Registry::get('post');

        $obj = Ordem::getInstance('ordemEdit');
//        $obj = new Ordem();
//        if (isset($post->id)) {
//            $obj->read($post->id);
//        }
        $obj->setDataFromRequest($post);
        $obj->save();

        $br->setRemoveWindow('EditOrdem');
        $br->setUpdateGrid('gridOrdens');
        $br->send();

        Session_Control::setDataSession('formOrdemEdit', '');
    }

    public function btnexcluirclickAction() {
        Grid_Control::deleteDataGrid('Ordem', '', 'gridOrdens');
    }

    public function btncancelarclickAction() {
        $br = new Browser_Control;
        $br->setRemoveWindow('EditOrdem');
        $br->send();
    }

    public function gridordensdblclickAction() {
        $this->edit();
    }

//    public function okselclienteAction() {
//        $post = Zend_Registry::get('post');
//        $br = new Browser_Control();
//        die(print_r($post ));
//        if ($post->id_produto > 0) {
//            $lProduto = new Produto();
//            $lProduto->read($post->id_produto);
//
//
//            $br->addFieldValue('valorvenda', $lProduto->getValorVenda());
//            $br->addFieldValue('valorcusto', $lProduto->getValorCusto());
//            $br->addFieldValue('valortotal', $lProduto->getValorVenda() * $post->quantidade);
//            $br->setDataForm('formOrdemProdutoEdit');
//        }
//        $br->send();
//    }

    public function listaordemAction() {
        $obj = new Ordem();
        Grid_Control::setDataGrid($obj);
    }

    /* ================== =========== ======================= */
    /* ================== Produtos da Ordem ======================= */

    public function listaprodutoAction() {
        $lOrdem = Ordem::getInstance('ordemEdit');


        $lOrdemProdutoLst = $lOrdem->getOrdemProdutoLst();
        if ($lOrdemProdutoLst->countItens() > 0) {
            Grid_Control::setDataGrid($lOrdemProdutoLst, false, FALSE);
        }
    }

    public function btnnovoprodutoclickAction() {
        $this->editProduto();
    }

    public function gridprodutosdblclickAction() {
        $this->editProduto();
    }

    public function editProduto() {
        $post = Zend_Registry::get('post');
        $br = new Browser_Control();


        $form = new Ui_Form();
        $form->setAction('Ordem');
        $form->setName('formOrdemProdutoEdit');


        $element = new Ui_Element_Text('quantidade');
        $element->setAttrib('obrig', 'obrig');
        $element->setAttrib('event', 'change');
        $element->setAttrib('sendFormFields', '1');
        $element->setAttrib('size', '2');
        $element->setValue('1');
        $element->setRequired();
        $form->addElement($element);

        $element = new Ui_Element_Select('id_produto');
        $element->addMultiOptions(Produto::getOptionList('id_produto', 'titulo', 'Produto', true));
        $element->setAttrib('event', 'change');
        $element->setAttrib('sendFormFields', '1');
        $element->setRequired();
        $form->addElement($element);

        $element = new Ui_Element_Text('valorcusto');
        $element->setReadOnly(true);
        $element->setAttrib('obrig', 'obrig');
        $element->setRequired();
        $element->setAttrib('size', '10');
        $form->addElement($element);

        $element = new Ui_Element_Text('valorvenda');
        $element->setReadOnly(true);
        $element->setAttrib('obrig', 'obrig');
        $element->setRequired();
        $element->setAttrib('size', '10');
        $form->addElement($element);

        $element = new Ui_Element_Text('valortotal');
        $element->setReadOnly(true);
        $element->setAttrib('obrig', 'obrig');
        $element->setRequired();
        $element->setAttrib('size', '10');
        $form->addElement($element);

        $btnSalvar = new Ui_Element_Btn('btnSalvarProduto');
        $btnSalvar->setDisplay('Salvar', PATH_IMAGES . 'Buttons/Ok.png');
        if (isset($post->id)) {
            $btnSalvar->setAttrib('params', 'id=' . $post->id);
        }
        $btnSalvar->setAttrib('sendFormFields', '1');
        $form->addElement($btnSalvar);

        $btnCancelar = new Ui_Element_Btn('btnCancelarProduto');
        $btnCancelar->setDisplay('Cancelar', PATH_IMAGES . 'Buttons/Cancelar.png');
        $form->addElement($btnCancelar);

        $obj = new Ordemproduto();
        $lOrdem = Ordem::getInstance('ordemEdit');
        $lOrdemProdutoLst = $lOrdem->getOrdemProdutoLst();
        if (isset($post->id)) {
            $obj = $lOrdemProdutoLst->getItem($post->id);
            $obj->setInstance('OrdemprodutoEdit');
        }
        $form->setDataForm($obj);

        $form->setDataSession();

        $view = Zend_Registry::get('view');

        $w = new Ui_Window('insertProduto', 'Produtos', $form->displayTpl($view, 'Ordem/addProduto.tpl'));
        $w->setDimension('450', '250');
        $br->newWindow($w);
        $br->send();
    }

    public function quantidadechangeAction() {
        $this->idprodutochangeAction();
    }

    public function idprodutochangeAction() {
        $post = Zend_Registry::get('post');
        $br = new Browser_Control();
        if ($post->id_produto > 0) {
            $lProduto = new Produto();
            $lProduto->read($post->id_produto);


            $br->addFieldValue('valorvenda', $lProduto->getValorVenda());
            $br->addFieldValue('valorcusto', $lProduto->getValorCusto());
            $br->addFieldValue('valortotal', $lProduto->getValorVenda() * $post->quantidade);
            $br->setDataForm('formOrdemProdutoEdit');
        }
        $br->send();
    }

    public function btnsalvarprodutoclickAction() {
        $post = Zend_Registry::get('post');
        $br = new Browser_Control();

        $form = Session_Control::getDataSession('formOrdemProdutoEdit');

        $valid = $form->processAjax($_POST);

        if ($valid != 'true') {
            $br->validaForm($valid);
            $br->send();
            exit;
        }
        if (isset($post->id)) {
            $lItem = Ordemproduto::getInstance('OrdemprodutoEdit');
        } else {
            $lItem = new Ordemproduto();
        }
        $lItem->setDataFromRequest($post);

        $lOrdem = Ordem::getInstance('ordemEdit');

        $lOrdemProdutoLst = $lOrdem->getOrdemProdutoLst();


        $lOrdemProdutoLst->addItem($lItem, $post->id);

        for ($i = 0; $i < $lOrdemProdutoLst->countItens(); $i++) {
            $Item = $lOrdemProdutoLst->getItem($i);
            if (!$Item->deleted()) {
                $valorTotal += $Item->getValorVenda() * $Item->getQuantidade();
                $valorTotalCusto += $Item->getValorCusto() * $Item->getQuantidade();
            }
        }

        $lOrdem->setTotalVenda($valorTotal);
        $lOrdem->setTotalCusto($valorTotalCusto);

        $lOrdem->setInstance('ordemEdit');

        $this->atualizaCamposTela($br);

        $br->setRemoveWindow('insertProduto');
        $br->setUpdateGrid('gridProdutos');
        $br->send();

        Session_Control::setDataSession('formOrdemProdutoEdit', '');
    }

    public function numvezesblurAction() {
        $post = Zend_Registry::get('post');
        $lOrdem = Ordem::getInstance('ordemEdit');
        $lOrdem->setNumVezes($post->controlValue);

        $lOrdem->setInstance('ordemEdit');
        $br = new Browser_Control();
        $this->atualizaCamposTela($br);
        $br->send();
    }

    public function percententradablurAction() {
        $post = Zend_Registry::get('post');

        $lOrdem = Ordem::getInstance('ordemEdit');

        $lOrdem->setPercentEntrada($post->controlValue);
        $lOrdem->setValEntrada(number_format(($lOrdem->getTotalVendaComDesconto() * ($post->controlValue / 100)), 2));

        $lOrdem->setInstance('ordemEdit');

        $br = new Browser_Control();
        $this->atualizaCamposTela($br);
        $br->send();
    }

    public function valentradablurAction() {
        $post = Zend_Registry::get('post');
        $lOrdem = Ordem::getInstance('ordemEdit');
        $lOrdem->setValEntrada($post->controlValue);
        $lOrdem->setPercentEntrada(number_format((100 * $post->controlValue / $lOrdem->getTotalVendaComDesconto())));

        $lOrdem->setInstance('ordemEdit');
        $br = new Browser_Control();
        $this->atualizaCamposTela($br);
        $br->send();
    }

    public function percentdescontoblurAction() {
        $post = Zend_Registry::get('post');
        $lOrdem = Ordem::getInstance('ordemEdit');
        $lOrdem->setPercentDesconto($post->controlValue);
        $lOrdem->setValDesconto(number_format(($lOrdem->getTotalVenda() * ($post->controlValue / 100)), 2));
        $lOrdem->setValEntrada(number_format(($lOrdem->getTotalVendaComDesconto() * ($lOrdem->getPercentEntrada() / 100)), 2));


        $lOrdem->setInstance('ordemEdit');
        $br = new Browser_Control();
        $this->atualizaCamposTela($br);
        $br->send();
    }

    public function valdescontoblurAction() {
        $post = Zend_Registry::get('post');
        $lOrdem = Ordem::getInstance('ordemEdit');
        $lOrdem->setValDesconto($post->controlValue);
        $lOrdem->setPercentDesconto(number_format((100 * $post->controlValue / $lOrdem->getTotalVenda())));
        $lOrdem->setValEntrada(number_format(($lOrdem->getTotalVendaComDesconto() * ($lOrdem->getPercentEntrada() / 100)), 2));
        $lOrdem->setInstance('ordemEdit');
        $br = new Browser_Control();
        $this->atualizaCamposTela($br);
        $br->send();
    }

    public function atualizaCamposTela(&$br) {
        $lOrdem = Ordem::getInstance('ordemEdit');
        $lOrdem->setValDesconto(number_format(($lOrdem->getTotalVenda() * ($lOrdem->getPercentDesconto() / 100)), 2));
        $lOrdem->setValEntrada(number_format(($lOrdem->getTotalVendaComDesconto() * ($lOrdem->getPercentEntrada() / 100)), 2));

        $br->addFieldValue('valorparcela', $lOrdem->getValorParcela());
        $br->addFieldValue('percententrada', $lOrdem->getPercentEntrada());
        $br->addFieldValue('valentrada', $lOrdem->getvalentrada());
        $br->addFieldValue('percentdesconto', $lOrdem->getPercentDesconto());
        $br->addFieldValue('valdesconto', $lOrdem->getvaldesconto());
        $br->addFieldValue('totalcusto', $lOrdem->getTotalCusto());
        $br->addFieldValue('totalvenda', $lOrdem->getTotalVendaComDesconto());
        $br->setDataForm('formOrdemEdit');
    }

    public function btnexcluirprodutoclickAction() {
        Grid_Control::deleteDataGrid('ordemEdit', 'OrdemProdutoLst');


        $lOrdem = Ordem::getInstance('ordemEdit');
        $lOrdemProdutoLst = &$lOrdem->getOrdemProdutoLst();
        for ($i = 0; $i < $lOrdemProdutoLst->countItens(); $i++) {
            $Item = $lOrdemProdutoLst->getItem($i);
            if (!$Item->deleted()) {
                $valorTotal += $Item->getValorVenda() * $Item->getQuantidade();
                $valorTotalCusto += $Item->getValorCusto() * $Item->getQuantidade();
            }
        }

        $lOrdem->setTotalVenda($valorTotal);
        $lOrdem->setTotalCusto($valorTotalCusto);

        $lOrdem->setInstance('ordemEdit');
        $br = new Browser_Control();
        $this->atualizaCamposTela($br);
        $br->setUpdateGrid('gridProdutos');
        $br->send();
    }

    public function btncancelarprodutoclickAction() {
        $br = new Browser_Control;
        $br->setRemoveWindow('insertProduto');
        $br->send();
    }

}