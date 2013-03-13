<?php

class IndexController extends Zend_Controller_Action {

    public function indexAction() {
        $view = Zend_Registry::get('view');
        
        $lProdutos = new Produto();
        $lHtml = $lProdutos->getListaProdutos($view);
        
        $view->assign('imagensBanner1', Arquivo::getBanner1());
        $view->assign('imagensBanner2',  Arquivo::getBanner2());
        $view->assign('produtos_destaque',$lHtml);
        $view->assign('tituloPagina','Home');
        $view->assign('conteudo', $view->fetch('Web/centro_home.tpl'));
        $view->output('Web/index.tpl');
    }

    public function aboutAction() {
        
    }

}