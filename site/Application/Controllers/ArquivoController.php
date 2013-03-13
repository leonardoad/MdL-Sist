<?php

class ArquivoController extends Zend_Controller_Action {

    public function init() {

        Browser_Control::setScript('js', 'Easydrag', 'easydrag.js');
        Browser_Control::setScript('css', 'Window', 'Window/Window.css');

        Browser_Control::setScript('js', 'Button', 'Button/Button.js');
        Browser_Control::setScript('css', 'Button', 'Button/Button.css');

        Browser_Control::setScript('js', 'Upload', 'Upload/Upload.js');
        Browser_Control::setScript('js', 'SwfUpload', 'Upload/Swfobject.js');
        Browser_Control::setScript('css', 'Upload', 'Upload/Upload.css');
    }

    public function mostrararquivosAction() {
        $album = Session_Control::getDataSession('album');

        $item = new Album();
        $item->read($album);

        $view = Zend_Registry::get('view');
        $view->assign('tituloAlbum', $item->getTitulo());
        $view->assign('descricaoAlbum', $item->getDescricao());
        if ($this->listaarquivosAction('', $album, true) != '') {
            $view->assign('arquivos', $this->listaarquivosAction('', $album, true));
        } else {
            $view->assign('descricaoAlbum', 'Nenhum arquivo encontrado para esta pasta');
        }
        $view->output('Arquivos/web.tpl');
    }

    public function arquivosclickAction() {

        $post = Zend_Registry::get('post');

        $form = new Ui_Form();
        $form->setName('formArquivos');
        $form->setAttrib('id', 'formArquivos');
        $form->setAction('./Arquivo');

//		$element = new Ui_Element_Checkbox('mostraTodos');
//		$element->setAttrib('event', 'click');
//		$element->setAttrib('sendFormFields', '1');
//		$element->setCheckedValue('S');
//		$element->setUncheckedValue('N');
//		$form->addElement($element);


        $element = new Ui_Element_Upload('upload');
        $element->setParams('Enviar Arquivo', HTTP_REFERER. 'Arquivo/upload', true);
        $element->setOndeMostraFila('filaEnvio');
        $element->dataSend('album', $post->album);
        $element->setVisible('PROC_CAD_ARQUIVOS', 'inserir');
        $form->addElement($element);


        Session_Control::setDataSession('albumEdit', $post->album);

        $view = Zend_Registry::get('view');
        $view->assign('arquivos', $this->listaarquivosAction(Session_Control::getDataSession('mostraTodosArquivos'), $post->album));
        $br = new Browser_Control();

        $w = new Ui_Window('ArquivosAlbum', 'Arquivos', $form->displayTpl($view, 'Arquivos/index.tpl'));
        $w->setDimension('700', '');
        $w->setCloseOnEscape('true');

        $br->newWindow($w);
//		$br->newWindow('ArquivosAlbum', 'Arquivos', '', '', $form->displayTpl($view, 'Arquivos/index.tpl'));
        $br->send();
    }

    public function editararquivoclickAction() {
        $post = Zend_Registry::get('post');

        $form = new Ui_Form();
        $form->setName('arquivoEdit');
        $form->setAttrib('id', 'arquivoEdit');
        $form->setAction('./Arquivo');

        $element = new Ui_Element_Checkbox('ativo');
        $element->setCheckedValue('S');
        $element->setUncheckedValue('N');
        $form->addElement($element);

        $element = new Ui_Element_Text('descricao');
        $element->setAttrib('maxlength', '100');
        $form->addElement($element);

        $element = new Ui_Element_Text('link');
        $element->setAttrib('maxlength', '400');
        $element->setAttrib('style', 'width:300px');
        $form->addElement($element);

        $element = new Ui_Element_Btn('btnSalvar');
        $element->setDisplay('Salvar', PATH_IMAGES . 'Buttons/Ok.png');
        $element->setAttrib('sendFormFields', '1');
        $element->setAttrib('params', 'arquivo=' . $post->arquivo);
        $form->addElement($element);

        $item = new Arquivo;
        $item->a_ativo = 'S';
        if ($post->arquivo != '') {
            $item->read($post->arquivo);
        }

        $form->setDataForm($item);

        $view = Zend_Registry::get('view');
        $html = $form->displayTpl($view, 'Arquivos/edit.tpl');
        $br = new Browser_Control();

        $w = new Ui_Window('EditArquivos', 'Edição', $html);
        $w->setDimension('460', '245');
        $w->setCloseOnEscape('true');

        $br->newWindow($w);
        $br->send();
    }

    public function uploadAction() {

        $br = new Browser_Control();
//        print'<pre>';
//        die(print_r($_SERVER['DOCUMENT_ROOT'] . PATH_PUBLIC . 'Arquivos/'));
        $post = Zend_Registry::get('post');
        $ponto = strripos($_FILES['Filedata']['name'], '.');
//		$album = Session_Control::getDataSession('albumEdit');
        $item = new Arquivo();
        $item->setDescricao(substr($_FILES['Filedata']['name'], 0, $ponto));
        $item->setid_owner($post->album);


        $item->a_ext = strtolower(substr($_FILES['Filedata']['name'], $ponto + 1));
        try {
            $item->save();
        } catch (Zend_Exception $e) {
            echo $e->getMessage();
            exit;
        }


        $up = new File_Upload($_FILES['Filedata']['tmp_name']);

        $type = array('jpg', 'png', 'gif');

        if (in_array(strtolower($item->a_ext), $type)) {
            if ($up->uploaded) {
                $up->file_new_name_body = $item->getid() . '_mini';
                $up->file_new_name_ext = $item->a_ext;
                $up->image_resize = true;
                $up->image_x = 100;
                $up->image_y = 100;
                $up->image_ratio = true;
                $up->process($_SERVER['DOCUMENT_ROOT'] . PATH_PUBLIC . 'Arquivos/');
                if (!$up->processed) {
                    $arquivo = new Arquivo();
                    $arquivo->read($item->getid());
                    $arquivo->excluir();

                    $br = new Browser_Control();
                    $br->setAlert($up->error);
                    $br->send();
                    exit;
                }
            } else {
                $arquivo = new Arquivo();
                $arquivo->read($item->getid());
                $arquivo->excluir();
            }
        } else {
            $arquivo = new Arquivo();
            $arquivo->read($item->getid());
            $arquivo->excluir();
        }
        $up = new File_Upload($_FILES['Filedata']['tmp_name']);
        if ($up->uploaded) {
            $up->file_new_name_body = $item->getid();
            //				$up->image_resize = true;
            $up->file_new_name_ext = $item->a_ext;
//            $up->image_x      = 700;
            $up->image_y      = 700;
 				$up->image_ratio  = true;
            $up->process($_SERVER['DOCUMENT_ROOT'] . PATH_PUBLIC . 'Arquivos/');
            if (!$up->processed) {
                $arquivo = new Arquivo();
                $arquivo->read($item->getid());
                $arquivo->excluir();

                $br = new Browser_Control();
                $br->setAlert($up->error);
                $br->send();
                exit;
            }
        } else {
            $arquivo = new Arquivo();
            $arquivo->read($item->getid());
            $arquivo->excluir();
        }
        $br = new Browser_Control();
        $br->setHtml('listaArquivos', $this->listaarquivosAction(Session_Control::getDataSession('mostraTodosArquivos'), $post->album, false, true));
        //		$br->setAlert($this->listaarquivosAction(Session_Control::getDataSession('mostraTodosArquivos'), $post->album));
        $br->send();
    }

    public function excluirarquivoclickAction() {

        $post = Zend_Registry::get('post');
        $idArquivo = $post->arquivo;

        $arquivo = new Arquivo();
        $arquivo->read($idArquivo);
        $arquivo->excluir();

        $br = new Browser_Control();
        $br->setHtml('listaArquivos', $this->listaarquivosAction(Session_Control::getDataSession('mostraTodosArquivos')));
        $br->send();
    }

    public function btnsalvarclickAction() {

        $post = Zend_Registry::get('post');

        $item = new Arquivo();
        $item->read($post->arquivo);

        $item->setDataFromRequest($post);

        $item->save();

        $br = new Browser_Control();
        $br->setRemove('EditArquivos');
        $br->setHtml('listaArquivos', $this->listaarquivosAction(Session_Control::getDataSession('mostraTodosArquivos')));
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

    public function principalchangeAction() {

        $post = Zend_Registry::get('post');

        $arquivo = new Arquivo();
        $arquivo->where('id_owner', Session_Control::getDataSession('albumEdit'));
        $arquivo->where('principal', 'S');
        $arquivo->readLst();

        if ($arquivo->countItens() > 0) {
            $item = $arquivo->getItem(0);
            $item->a_principal = 'N';
            $item->save();
        }

        $arquivo = new Arquivo();
        $arquivo->read($post->arquivo);
        $arquivo->a_principal = 'S';
        $arquivo->save();

        $br = new Browser_Control();
//        $br->setHtml('listaAlbuns', Albuns::montaAlbum(Session_Control::getDataSession('mostraTodosAlbuns')));
        $br->setHtml('listaArquivos', $this->listaarquivosAction(Session_Control::getDataSession('mostraTodosArquivos', Session_Control::getDataSession('albumEdit'))));
        $br->send();
    }

    public function arquivosordemchangeAction() {
        $post = Zend_Registry::get('post');

        $array = explode(',', $post->ordem);
        for ($i = 1; $i <= count($array); $i++) {
            $arquivo = new Arquivo();
            $arquivo->read($array[$i - 1]);
            $arquivo->a_ordem = $i;
            $arquivo->setState(cUPDATE);
            $arquivo->save();
        }
    }

    public function mostratodosclickAction() {
        $post = Zend_Registry::get('post');

        if ($post->mostraTodos == 'S') {
            $arquivos = $this->listaarquivosAction($post->mostraTodos, Session_Control::getDataSession('albumEdit'));
        } else {
            $arquivos = $this->listaarquivosAction('', Session_Control::getDataSession('albumEdit'));
        }

        $br = new Browser_Control();
        $br->setHtml('listaArquivos', $arquivos);
        $br->send();
    }

    public function downloadAction() {
        $post = Zend_Registry::get('post');

        $item = new Arquivo;
        $item->read($post->id);

        $filename = '/var/www' . PATH_PUBLIC . 'Arquivos/' . $item->getid() . '.' . $item->getExt();

        header("Content-Type: application/save");
        header("Content-Length:" . filesize($filename));
        header('Content-Disposition: attachment; filename="' . $item->getDescricao() . '.' . $item->getExt() . '"');
        header("Content-Transfer-Encoding: binary");
        header('Expires: 0');
        header('Pragma: no-cache');

        readfile($filename);
    }

}