<?php

class RelatoriosController extends Zend_Controller_Action {

    public function init() {
//        Browser_Control::setScript('js', 'Mask', 'Mask/Mask.js');
//        Browser_Control::setScript('js', 'Easydrag', 'easydrag.js');
//
//        Browser_Control::setScript('js', 'Upload', 'Upload/Upload.js');
//        Browser_Control::setScript('js', 'SwfUpload', 'Upload/Swfobject.js');
//        Browser_Control::setScript('css', 'Upload', 'Upload/Upload.css');
    }

    public function indexAction() {
        
    }

    public function pedidosAction() {
        $view = Zend_Registry::get('view');

        $lOrdemLst = new Ordem();
        $lOrdemLst->where('dataentrega', date('Y-m-d'),'>=');
        $lOrdemLst->readLst();
//        print '<pre>';
//        die(print_r($lOrdemLst->countItens()));
        for ($i = 0; $i < $lOrdemLst->countItens(); $i++) {
            $lOrdem = $lOrdemLst->getItem($i);
            $lOrdem->read();
            $item['cliente'] = $lOrdem->getNomeCliente();
            $item['emailCliente'] = $lOrdem->getEmailCliente();
            $item['dataEntrega'] = $lOrdem->getDataEntrega();
            $OrdemProdutoLst = $lOrdem->getOrdemProdutoLst();
            for ($j = 0; $j < $OrdemProdutoLst->countItens(); $j++) {
                $Item = $OrdemProdutoLst->getItem($j);
                $itemProduto['Titulo'] = $Item->getTitulo();
                $itemProduto['Quantidade'] = $Item->getQuantidade();
                $itemProduto['ValorVenda'] = $Item->getValorVenda();
                $itemProduto['ValorTotal'] = $Item->getValorTotal();

                $item['produtos'][] = $itemProduto;
            }
            $itemLst[] = $item;
            $item = array();
        }

        $view->assign('itemLst', $itemLst);
        $view->assign('dataImpressao', date('d/m/Y H:i')); 
        $view->assign('usuario', Session_Control::getPropertyUserLogado('nomecompleto'));


        $html = $view->fetch('Relatorios/pedidos.tpl');
        $view->assign('scripts', Browser_Control::getScripts());
        $view->assign('body', $html);
        $view->output('index.tpl');
    }

}