<?php

class WebController extends Zend_Controller_Action {

    public function produtoAction() {
        $post = Zend_Registry::get('post');

        $view = Zend_Registry::get('view');

        $lItem = new Produto();
        $lItem->read($post->id);

        $view->assign('id_produto', $lItem->getID());
        $view->assign('foto', Arquivo::getImagens($lItem->getID(),true));
        $view->assign('titulo', $lItem->getNome());
        $view->assign('descricao', $lItem->getDescricao());

        $lHtmlProduto = $view->fetch('Produto/web_detalhes.tpl');

        $htmlMenu = $this->getMenuProdutos();

        $view->assign('produto_destaque', $lHtmlProduto);
        $view->assign('menu_produtos', $htmlMenu);
        $lHtml = $view->fetch('Produto/web_padrao.tpl');

       

        $view->assign('imagensBanner1', Arquivo::getBanner1());
        $view->assign('imagensBanner2', Arquivo::getBanner2());
        $view->assign('tituloPagina','Produtos');
//        $view->assign('scripts', Browser_Control::getScripts());
        $view->assign('conteudo', $lHtml);
        $view->output('Web/index.tpl');
    }

//    public function btnbuscaclickAction() {
//        $post = Zend_Registry::get('post');
//
//        $br = new Browser_Control();
//        $br->setBrowserUrl(HTTP_REFERER.'web/tabelaprodutos/busca/'.$post->busca);
//        $br->send();
//    }
    public function tabelaprodutosAction() {
        $post = Zend_Registry::get('post');

        $view = Zend_Registry::get('view');

        $lItem = new Produto();
        if ($post->idtipo != '')
            $lItem->where('id_tipoproduto', $post->idtipo);
        if ($post->busca!= ''){
            $lItem->where('descricao', $post->busca,'ilike');
            $lItem->where('nome', $post->busca,'ilike', 'or');
            
            $view->assign('textoBusca', $post->busca);
        }

        $lHtmlProdutos = $lItem->getTabelaProdutos($view);

        $htmlMenu = $this->getMenuProdutos();

        $view->assign('produto_destaque', $lHtmlProdutos);
        $view->assign('menu_produtos', $htmlMenu);
        $lHtml = $view->fetch('Produto/web_padrao.tpl');
        
 


        $view->assign('imagensBanner1', Arquivo::getBanner1());
        $view->assign('imagensBanner2', Arquivo::getBanner2());
        $view->assign('tituloPagina','Produtos');
//        $view->assign('scripts', Browser_Control::getScripts());
        $view->assign('conteudo', $lHtml);
        $view->output('Web/index.tpl');
    }

    public function getMenuProdutos() {
        $MenuProdutos = new Tipoproduto();
        $MenuProdutos->readLst();

        for ($i = 0; $i < $MenuProdutos->countItens(); $i++) {
            $ItemMenu = $MenuProdutos->getItem($i);
            $htmlMenu .= '<li><a href="' . HTTP_REFERER . 'web/tabelaprodutos/idtipo/' . $ItemMenu->getID() . '">' . $ItemMenu->getDescricao() . '</a></li>';
        }
        return $htmlMenu;
    }

    public function servicosAction() {
        $view = Zend_Registry::get('view');

        $lHtml = $view->fetch('Web/servicos.tpl');

        $view->assign('imagensBanner1', Arquivo::getBanner1());
        $view->assign('imagensBanner2', Arquivo::getBanner2());
        $view->assign('tituloPagina','Servi&ccedil;os');
//        $view->assign('scripts', Browser_Control::getScripts());
        $view->assign('conteudo', $lHtml);
        $view->output('Web/index.tpl');
    }

    

    public function contatoAction() {
        $view = Zend_Registry::get('view');

        $form = new Ui_Form();
        $form->setAction('Web');
        $form->setName('formContato');

        $element = new Ui_Element_Text('nome');
        $element->setAttrib('obrig', 'obrig');
        $element->setRequired();
        $element->setAttrib('size', '50');
        $form->addElement($element);

        $element = new Ui_Element_Text('email');
        $element->setAttrib('obrig', 'obrig');
        $element->setRequired();
        $element->setAttrib('size', '50');
        $form->addElement($element);

        $element = new Ui_Element_Text('assunto');
        $element->setAttrib('obrig', 'obrig');
        $element->setRequired();
        $element->setAttrib('size', '50');
        $form->addElement($element);

        $element = new Ui_Element_Textarea('mensagem');
        $element->setAttrib('obrig', 'obrig');
        $element->setRequired();
        $element->setAttrib('cols', '45');
        $element->setAttrib('rows', '4');
        $form->addElement($element);


        $element = new Ui_Element_Btn('btnEnviar');
        $element->setDisplay('Enviar');
        $element->setAttrib('sendFormFields', '1');
        $element->setAttrib('validaObrig', '1');
        $form->addElement($element);


        $form->setDataSession();

        $lHtmlContato = $form->displayTpl($view, 'Web/form_contato.tpl');
        $view->assign('formContato', $lHtmlContato);
        $lHtml = $view->fetch('Web/contato.tpl');
        
        
         



        $view->assign('imagensBanner1', Arquivo::getBanner1());
        $view->assign('imagensBanner2', Arquivo::getBanner2());
        $view->assign('tituloPagina','Contato');
        $view->assign('scripts', Browser_Control::getScripts());
        $view->assign('conteudo', $lHtml);
        $view->output('Web/index.tpl');
    }
    
    
    public function btnenviarclickAction() {
        $view = Zend_Registry::get('view');

        $post = Zend_Registry::get('post');

        $authDetails = array(
            'ssl' => 'tls',
            'port' => 587, //or 465 
            'auth' => 'login',
            'username' => 'leonardo.danieli@gmail.com',
            'password' => 'le0karoca'
        );
        $transport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $authDetails);
        Zend_Mail::setDefaultTransport($transport);


        $email .= '<p> Nome:' . $post->nome . '</p>';
        $email .= '<p> Email: ' . $post->email . '</p>';
        $email .= '<p> Assunto: ' . $post->assunto . '</p>';
        $email .= '<p> Mensagem: ' . $post->mensagem . '</p>';

        $mail = new Zend_Mail();
        $mail->setBodyHtml($email);
        $mail->setFrom($post->email, $post->nome);
        $mail->addTo('leonardodanieli@gmail.com', 'Leo');
        $mail->setSubject('Contato via site');

        try {
// your code here  
            $mail->send();
        } catch (Zend_Exception $e) {
            echo $e->getMessage();
            exit;
        }


        $br = new Browser_Control();
        $br->addFieldValue('nome', '');
        $br->addFieldValue('email', '');
        $br->addFieldValue('assunto', '');
        $br->addFieldValue('mensagem', '');
        $br->setHtml('msg', 'Mensagem enviada com sucesso!');
        $br->send();
    }

}