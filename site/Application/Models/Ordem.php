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
        $this->a_ativo = cTRUE;
        $this->a_percentdesconto = 0;
        $this->a_valdesconto = 0;
        $this->a_percententrada= 0;
        $this->a_valentrada= 0;
        $this->a_datapedido = date('d/m/Y');
        
        $this->OrdemProdutoLst = new Ordemproduto();
    }
    
    public function getOrdemProdutoLst(){
        return $this->OrdemProdutoLst;
    }
    public function getTotalVendaComDesconto(){
        return $this->a_totalvenda - $this->a_valdesconto;
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

    
}