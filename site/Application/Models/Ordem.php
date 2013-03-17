<?php

/**
 * Modelo da classe Ordem de Serviço
 * @filesource
 * @author 		Leonardo Daneili <leonardo.danieli@gmail.com>
 * @copyright 	4Coffee.com.br
 * @package		sistema
 * @subpackage	sistema.apllication.models
 * @version		1.0 16/03/2013
 */
class Ordem extends Db_Table {

    protected $_name = 'ordem';
    public $_primary = 'id_ordem';
    public $_log_ativo = true;

    function Ordem() {
        $this->ativo = cTRUE;
    }

    public function setDataFromRequest($post) {
        $this->setAtivo($post->ativo);
        $this->setID_Cliente($post->getUnescaped('idcliente'));
        $this->setDataPedido($post->getUnescaped('datapedido'));
        $this->setDataEntrega($post->getUnescaped('dataentrega'));
        $this->setPercentEntrada($post->percententrada);
        $this->setValEntrada($post->valentrada);
        $this->setNumVezes($post->numvezes);
        $this->setTotalCusto($post->totalcusto);
        $this->setTotalVenda($post->totalvenda);
        $this->setPercentDesconto($post->percentdesconto);
        $this->setValDesconto($post->valdesconto);
    }

    public function getImagemPrincipal() {

        $lArquivo = new Arquivo();
        return $lArquivo->getImagens($this->getID());
    }
    public function getImagens() {

        $lArquivo = new Arquivo();
        return $lArquivo->getImagens($this->getID());
    }

    public function getListaProdutos($pView, $limit = 3) {


        $this->limit(1, $limit);
        $this->where('destaque','S');
        $this->readLst();
        $lHtml = '<table class="listaProdutos">';
        for ($i = 0; $i < $this->countItens(); $i++) {
            $lItem = $this->getItem($i);
            if ($lItem != null) {

                $pView->assign('id_produto', $lItem->getID());
                $pView->assign('foto',  Arquivo::getImagens($lItem->getID()));
                $pView->assign('titulo', $lItem->getNome());
                $pView->assign('descricao', $lItem->getDescricao());

                $lHtml .= $pView->fetch('Produto/web_linha_capa.tpl');
            }
        }

        $lHtml .= '</table>';
        return $lHtml;
    }

    public function getTabelaProdutos($pView) {


        $this->readLst();   
        $lHtml .='<div class="tabelaProdutos">';
        for ($i = 0; $i < $this->countItens(); $i++) {
            $lItem = $this->getItem($i);

            $pView->assign('id_produto', $lItem->getID());
            $pView->assign('foto', Arquivo::getImagens($lItem->getID()));
            $pView->assign('titulo', $lItem->getNome());
            $pView->assign('descricao', $lItem->getDescricao());

            $lHtml .='<div id="divItem">';
            $lHtml .= $pView->fetch('Produto/web_celula_produto.tpl');
            $lHtml .='</div>';
        }
        $lHtml .='</div>';

        return $lHtml;
    }

}