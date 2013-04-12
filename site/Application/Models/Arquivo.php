<?php

/**
 * Modelo da classe Usuario
 * @filesource
 * @author 		Ismael Sleifer
 * @copyright 	Ismael Sleifer Web Designer
 * @package		sistema
 * @subpackage	sistema.apllication.models
 * @version		1.0
 */
class Arquivo extends Db_Table {

    protected $_name = 'arquivo';
    public $_primary = 'id_arquivo';
    public $_log_ativo = true;

    public function setDataFromRequest($post) {
        $this->setDescricao($post->descricao);
        $this->setLink($post->link);
//		$this->setAtivo($post->ativo);
    }

    static function getImagens($id_Owner, $todas = false) {
        $view = Zend_Registry::get('view');
        $arquivoLst = new Arquivo();
        $arquivoLst->where('id_owner', $id_Owner);
        if ($todas == false)
            $arquivoLst->where('principal', 'S');
        $arquivoLst->readLst();

        if ($arquivoLst->countItens() != 0) {
            for ($i = 0; $i < $arquivoLst->countItens(); $i++) {
                $Item = $arquivoLst->getItem($i);

                $album[$i]['id'] = $Item->getid();
                $album[$i]['titulo'] = $Item->getTitulo();
                $album[$i]['descricao'] = $Item->getDescricao();
                $album[$i]['imagem'] = PATH_PUBLIC . 'Arquivos/' . $Item->getid() . '_mini.' . $Item->getExt();
                $album[$i]['imagemG'] = PATH_PUBLIC . 'Arquivos/' . $Item->getid() . '.' . $Item->getExt();
            }
        } else {
            $album[0]['imagem'] = PATH_PUBLIC . 'Arquivos/Default.png';
        }

        $view->assign('editar', Usuario::verificaAcesso('PROC_CAD_ARQUIVOS', 'editar'));
        $view->assign('excluir', Usuario::verificaAcesso('PROC_CAD_ARQUIVOS', 'excluir'));
        $view->assign('albuns', $album);
        if ($arquivoLst->countItens() == 1) {
            return $view->fetch('Albuns/umaFoto.tpl');
        }else if ($arquivoLst->countItens() > 1) 
            return $view->fetch('Albuns/albuns.tpl');
        else
            return '';
    }

    public function excluir() {

        $this->setDeleted();
        $this->save();

        if (file_exists($_SERVER['DOCUMENT_ROOT'] . PATH_PUBLIC . 'Arquivos/' . $this->getid() . '.' . $this->getExt())) {
            unlink($_SERVER['DOCUMENT_ROOT'] . PATH_PUBLIC . 'Arquivos/' . $this->getid() . '.' . $this->getExt());
        }
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . PATH_PUBLIC . 'Arquivos/' . $this->getid() . '_mini.' . $this->getExt())) {
            unlink($_SERVER['DOCUMENT_ROOT'] . PATH_PUBLIC . 'Arquivos/' . $this->getid() . '_mini.' . $this->getExt());
        }
    }

    public function getExt() {
        return trim($this->a_ext);
    }

    static function getBanner1() {
//        $view = Zend_Registry::get('view');



        $lImagens = new Arquivo();
        $lImagens->where('id_owner', '99991');
        $lImagens->readLst();

        for ($i = 0; $i < $lImagens->countItens(); $i++) {
            $Item = $lImagens->getItem($i);

            $ret .= $sep . '["' . HTTP_REFERER . 'Public/Arquivos/' . $Item->getid() . '.' . $Item->getExt() . '", "' . $Item->getLink() . '", "", "' . $Item->getDescricao() . '"]';
            $sep = ',';
        }

//         ["http://i29.tinypic.com/xp3hns.jpg", "http://en.wikipedia.org/wiki/Cave", "_new", "Some day I'd like to explore these caves!"],

        return $ret;
    }

    static function getBanner2() {
//        $view = Zend_Registry::get('view');



        $lImagens = new Arquivo();
        $lImagens->where('id_owner', '99992');
        $lImagens->readLst();

        for ($i = 0; $i < $lImagens->countItens(); $i++) {
            $Item = $lImagens->getItem($i);

            $ret .= $sep . '["' . HTTP_REFERER . 'Public/Arquivos/' . $Item->getid() . '.' . $Item->getExt() . '", "' . $Item->getLink() . '", "", "' . $Item->getDescricao() . '"]';
            $sep = ',' . "\n";
        }

//         ["http://i29.tinypic.com/xp3hns.jpg", "http://en.wikipedia.org/wiki/Cave", "_new", "Some day I'd like to explore these caves!"],

        return $ret;
    }

}