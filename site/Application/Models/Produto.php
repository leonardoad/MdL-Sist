<?php

/**
 * Modelo da classe Produto
 * @filesource
 * @author 		Leonardo Daneili
 * @copyright 	Ismael Sleifer Web Designer
 * @package		sistema
 * @subpackage	sistema.apllication.models
 * @version		1.0
 */
class Produto extends Db_Table {

    protected $_name = 'produto';
    public $_primary = 'id_produto';
    
//    protected $_classList = array(array('nome'=>'Permissao', 'campo'=>'id_usuario'));

    
    public $_log_ativo = true;

     

    public function setDataFromRequest($post) {
        $this->setTitulo($post->getUnescaped('titulo'));
        $this->setDescricao($post->getUnescaped('descricao'));
        $this->setDestaque($post->destaque);
        $this->setValorVenda($post->valorvenda);
        $this->setValorCusto($post->valorcusto);
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