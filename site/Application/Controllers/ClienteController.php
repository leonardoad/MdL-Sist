<?php

class ClienteController extends Zend_Controller_Action {

    public function init() {
        Browser_Control::setScript('js', 'Mask', 'Mask/Mask.js');
    }

    public function indexAction() {
        $form = new Ui_Form();
        $form->setName('formCliente');
        $form->setAction('Cliente');

        $grid = new Ui_Element_Grid('gridCliente');
        $grid->setParams('Cliente', 'Cliente/listaCliente');
        $grid->setOrder('nome');

        $button = new Ui_Element_Grid_Button('btnNovo', 'Inserir');
        $button->setImg('Buttons/Novo.png');
        $button->setVisible('CAD_CLIENTE', 'inserir');
        $grid->addButton($button);

        $button = new Ui_Element_Grid_Button('btnExcluir', 'Excluir');
        $button->setImg('Buttons/Cancelar.png');
        $button->setAttribs('msg = "Excluir o item selecionado ?"');
        $button->setVisible('CAD_CLIENTE', 'excluir');
        $button->setSendFormFields();
        $grid->addButton($button);

        $column = new Ui_Element_Grid_Column_Check('ID', 'id_cliente', '30', 'center');
        $grid->addColumn($column);

        $column = new Ui_Element_Grid_Column_Text('Nome', 'nome', '150');
        $grid->addColumn($column);

        $column = new Ui_Element_Grid_Column_Text('Email', 'email', '150');
        $grid->addColumn($column);

        $column = new Ui_Element_Grid_Column_Text('Tel', 'fone', '150');
        $grid->addColumn($column);

        $column = new Ui_Element_Grid_Column_Text('Tel2', 'fone2', '150');
        $grid->addColumn($column);

        $column = new Ui_Element_Grid_Column_Text('Tel3', 'fone3', '150');
        $grid->addColumn($column);

        $form->addElement($grid);

        $view = Zend_Registry::get('view');

        $view->assign('scripts', Browser_Control::getScripts());
        $view->assign('body', $form->displayTpl($view, 'Cliente/index.tpl'));
        $view->output('index.tpl');
    }

    public function edit() {
        $post = Zend_Registry::get('post');

        $form = new Ui_Form();
        $form->setAction('Cliente');
        $form->setName('formClienteEdit');

        $mainTab = new Ui_Element_TabMain('editClienteTab');

        $tabGeral = new Ui_Element_Tab('tabGeral');
        $tabGeral->setTitle('Geral');
        $tabGeral->setTemplate('Cliente/tabGeral.tpl');

        $element = new Ui_Element_Checkbox('ativo');
        $element->setCheckedValue(cTRUE);
        $element->setUncheckedValue(cFALSE);
        $tabGeral->addElement($element);

        $element = new Ui_Element_Text('nome');
        $element->setAttrib('obrig', 'obrig');
        $element->setRequired();
        $element->setAttrib('size', '40');
        $tabGeral->addElement($element);

        $element = new Ui_Element_Text('email');
        $element->setAttrib('obrig', 'obrig');
        $element->setAttrib('size', '40');
        $tabGeral->addElement($element);

        $element = new Ui_Element_TextMask('fone');
        $element->setMask('(99) 9999-9999');
        $tabGeral->addElement($element);

        $element = new Ui_Element_TextMask('fone2');
        $element->setMask('(99) 9999-9999');
        $tabGeral->addElement($element);

        $element = new Ui_Element_TextMask('fone3');
        $element->setMask('(99) 9999-9999');
        $tabGeral->addElement($element);

        $element = new Ui_Element_Text('logradouro');
        $element->setAttrib('obrig', 'obrig');
        $element->setRequired();
        $element->setAttrib('size', '20');
        $tabGeral->addElement($element);

        $element = new Ui_Element_Text('cidade');
        $element->setAttrib('obrig', 'obrig');
        $element->setRequired();
        $element->setAttrib('size', '20');
        $tabGeral->addElement($element);

        $element = new Ui_Element_Text('numero');
        $element->setAttrib('size', '15');
        $tabGeral->addElement($element);

        $element = new Ui_Element_Text('complemento');
        $element->setAttrib('size', '15');
        $tabGeral->addElement($element);

        $element = new Ui_Element_Text('bairro');
        $element->setAttrib('size', '15');
        $tabGeral->addElement($element);

        $element = new Ui_Element_Text('uf');
        $element->setAttrib('size', '1');
        $tabGeral->addElement($element);

        $element = new Ui_Element_TextMask('cep');
        $element->setMask('99.999.999');
        $element->setAttrib('size', '7');
        $tabGeral->addElement($element);



        $mainTab->addTab($tabGeral);

        // Logs
        $tabLogs = new Ui_Element_Tab('tabLogs');
        $tabLogs->setTitle('Logs');
        $tabLogs->addElement(Log::gridLogs($post->id, 'Cliente'));

        $mainTab->addTab($tabLogs);

        $form->addElement($mainTab);

        $obj = new Cliente();
        if (isset($post->id)) {
            $obj->read($post->id);
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

        $view = Zend_Registry::get('view');

        $w = new Ui_Window('EditCliente', 'Edição de Cliente', $form->displayTpl($view, 'Cliente/edit.tpl'), true);
        $w->setDimension('600', '580');
        $br = new Browser_Control();
        $br->newWindow($w);
        $br->send();
    }

    public function btnnovoclickAction() {
        $this->edit();
    }

    public function btnsalvarclickAction() {
        $form = Session_Control::getDataSession('formClienteEdit');

        $valid = $form->processAjax($_POST);

        $br = new Browser_Control();
        if ($valid != 'true') {
            $br->validaForm($valid);
            $br->send();
            exit;
        }

        $post = Zend_Registry::get('post');

        $obj = new Cliente();
        if (isset($post->id)) {
            $obj->read($post->id);
        }
        $obj->setDataFromRequest($post);
        $obj->save();

        $br->setRemoveWindow('EditCliente');
        $br->setUpdateGrid('gridCliente');
        $br->send();

        Session_Control::setDataSession('formClienteEdit', '');
    }

    public function btnexcluirclickAction() {
        Grid_Control::deleteDataGrid('Cliente', '', 'gridCliente');
    }

    public function btncancelarclickAction() {
        $br = new Browser_Control;
        $br->setRemoveWindow('EditCliente');
        $br->send();
    }

    public function gridclientedblclickAction() {
        $this->edit();
    }

    public function listaclienteAction() {
        $post = Zend_Registry::get('post');
        $obj = new Cliente();

        $obj->where('ativo', $post->ativoFiltro);
        if ($post->nomeFiltro != '') {
            $obj->where('nome', $post->nomeFiltro, 'like');
        }
        if ($post->emailFiltro != '') {
            $obj->where('email', $post->emailFiltro, 'like');
        }
//        die(print_r($obj ));
        Grid_Control::setDataGrid($obj);
        $obj->setInstance('listaClientes');
    }

    public function btnlimparfiltrosclickAction() {
        $br = new Browser_Control();
        $br->addFieldValue('ativoFiltro', 'S');
        $br->addFieldValue('nomeFiltro', '');
        $br->addFieldValue('emailFiltro', '');
        $br->setDataForm();
        $br->setUpdateGrid('gridCliente');
        $br->send();
    }

    /* -====== = = = = = = = = = = =    */
    /* -====== = = = = = = = = = = =    */

    public function btnselecionarclickAction() {
        $post = Zend_Registry::get('post');
        $br = new Browser_Control();
        $list = Cliente::getInstance('listaClientes');
        for ($i = 0; $i < $post->rp; $i++) {
            $chk = 'gridChk_' . $i;
            if ($post->$chk != '') {
                $item = $list->getItemById($post->$chk);
                $br->addFieldValue('nomecliente', $item->getnome());
                $br->addFieldValue('id_cliente', $item->getID_Cliente());
                $br->setDataForm('formOrdemEdit');
            }
        }
        
        $br->setRemoveWindow('SelCliente');
        $br->send();
    }

    public function selclienteAction() {
        $post = Zend_Registry::get('post');

        $form = new Ui_Form();
        $form->setName('formCliente');
        $form->setAction('Cliente');

        $accordion = new Ui_Element_Accordion('filtros');

        $section = new Ui_Element_Section('section1');
        $section->setTitle('Filtros');
        $section->setTemplate('Cliente/filtros.tpl');

        $idGrid = 'gridCliente';
        $element = new Ui_Element_Checkbox('ativoFiltro');
        $element->setAttrib('grid', $idGrid);
        $element->setChecked(cTRUE);
        $element->setCheckedValue(cTRUE);
        $element->setUncheckedValue(cFALSE);
        $section->addElement($element);

        $element = new Ui_Element_Text('nomeFiltro');
        $element->setAttrib('grid', $idGrid);
        $section->addElement($element);

        $element = new Ui_Element_Text('emailFiltro');
        $element->setAttrib('grid', $idGrid);
        $section->addElement($element);

        $element = new Ui_Element_Btn('btnFiltrar');
        $element->setDisplay('Filtrar', PATH_IMAGES . 'Buttons/Find.png');
        $element->setAttrib('event', '');
        $element->setAttrib('updateGrid', $idGrid);
        $section->addElement($element);

        $element = new Ui_Element_Btn('btnLimparFiltros');
        $element->setDisplay('Limpar', PATH_IMAGES . 'Buttons/Clear.png');
        $section->addElement($element);
        $accordion->addSection($section);

        $form->addElement($accordion);

        $grid = new Ui_Element_Grid('gridCliente');
        $grid->setParams('Cliente', 'Cliente/listaCliente');
        $grid->setOrder('nome');



        $column = new Ui_Element_Grid_Column_Check('ID', 'id_cliente', '30', 'center');
        $grid->addColumn($column);

        $column = new Ui_Element_Grid_Column_Text('Nome', 'nome', '150');
        $grid->addColumn($column);

        $column = new Ui_Element_Grid_Column_Text('Email', 'email', '150');
        $grid->addColumn($column);

        $column = new Ui_Element_Grid_Column_Text('Tel', 'fone', '150');
        $grid->addColumn($column);


        $form->addElement($grid);

        $element = new Ui_Element_Btn('btnSelecionar');
        $element->setDisplay('Selecionar', PATH_IMAGES . 'Buttons/Ok.png');
        $element->setAttrib('sendFormFields', '1');
        $form->addElement($element);

        $form->setDataSession();

        $view = Zend_Registry::get('view');

        $w = new Ui_Window('SelCliente', 'Selecione o Cliente', $form->displayTpl($view, 'Cliente/index.tpl'), true);
        $w->setDimension('600', '580');
        $br = new Browser_Control();
        $br->newWindow($w);
        $br->send();
    }

}