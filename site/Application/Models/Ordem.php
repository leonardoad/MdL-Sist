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

    function __construct() {
        parent::__construct();

        $this->setDataPedido(date('d/m/Y'));
        $this->a_ativo = cTRUE;
        $this->a_percentdesconto = 0;
        $this->a_valdesconto = 0;
        $this->a_percententrada = 30;
        $this->a_valentrada = 0;
        $this->a_numvezes = 1;
    }

    public function getCliente() {
        if (!$this->Cliente) {
            $this->Cliente = new Cliente();
            if ($this->getID_Cliente()!='') {
                return $this->Cliente->read($this->getID_Cliente());
            }
        }
        return $this->Cliente;
    }

    public function getNomeCliente() {
        return $this->getCliente()->getNome();
    }

    public function getEmailCliente() {
        return $this->getCliente()->getEmail();
    }

    public function getOrdemProdutoLst() {
        if (!$this->OrdemProdutoLst) {
            $this->OrdemProdutoLst = new Ordemproduto();
        }
        return $this->OrdemProdutoLst;
    }
    public function setOrdemProdutoLst($val) {
        $this->OrdemProdutoLst = $val;
    }

    public function getTotalVendaComDesconto() {
        return $this->a_totalvenda - $this->a_valdesconto;
    }
    public function getValorParcela() {
        return ($this->getTotalVendaComDesconto()-$this->getValEntrada())/$this->getNumVezes();
    }

    public function setDataFromRequest($post) {
        $this->setAtivo($post->ativo);
        $this->setID_Cliente($post->id_cliente);
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

    public function read($id = null, $modo = 'obj') {
        parent::read($id, $modo);
        
        $item = new Ordemproduto;
        $item->where('id_ordem', $this->getID());
        $item->readLst();
        $this->setOrdemProdutoLst($item);
    }

    public function save() {

        //print_r($this);die('<br><br>\n\n' . ' Linha: ' . __LINE__ . ' Arquivo: ' . __FILE__);

        switch ($this->getState()) {

            case cDELETE:

                $item = new Ordemproduto;
                $item->where('id_ordem', $this->getID());
                $item->readLst();
                $item->setDeleted();
                $item->save();

                parent::save();
                break;

            case cCREATE:
            case cUPDATE:

//                	print_r($this);die('<br><br>\n\n' . ' Linha: ' . __LINE__ . ' Arquivo: ' . __FILE__);

                parent::save();
                $lOrdemprodutoLst = $this->getOrdemProdutoLst();


                for ($i = 0; $i < $lOrdemprodutoLst->countItens(); $i++) {
                    $Item = $lOrdemprodutoLst->getItem($i);
                    $Item->setID_Ordem($this->getID());
                    $Item->save();
                }


                break;
        }
    }

}