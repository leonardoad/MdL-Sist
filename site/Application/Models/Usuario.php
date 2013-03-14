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
class Usuario extends Db_Table {
	protected $_name = 'usuario';
	public $_primary = 'id_usuario';

	protected $_classList = array(array('nome'=>'Permissao', 'campo'=>'id_usuario'));

	protected $_log_text = 'Usuário';
	protected $_log_info = 'a_nomecompleto';

	public function setDataFromRequest($post) {
		$this->setNomeCompleto($post->nomeCompleto);
		$this->setLoginUser($post->loginUser);
		$this->setTipo($post->tipo);
		$this->setGrupo($post->grupo);
		$this->setEmail($post->email);
		$this->setSmtp($post->smtp);
		$this->setPorta($post->porta);
		$this->setAssinaturaEmail($post->assinaturaEmail);
		$this->setAtivo($post->ativo);
		$this->setExcluivel(cTRUE);
		$this->setEditavel(cTRUE);
		if ($post->senha != ''){
			$this->setSenha(Format_Crypt::encryptPass($post->senha));
			$this->setDataSenha(date('Y-m-d'));
		}
		if($post->senhaEmail != ''){
			$this->setSenhaEmail($post->senhaEmail);
		}
		$this->setId_Empresa($post->id_empresa);
	}

	public function getNomeGrupo(){
		if($this->getGrupo() != 0 && $this->getGrupo() != ''){
			$user = new Usuario();
			$user->read($this->getGrupo());
			return $user->getNomeCompleto();
		}
	}

	public function readLst($modo='obj') {
		if($modo == 'obj'){
			parent::readLst($modo);
			for ($i = 0; $i < $this->countItens(); $i++) {
				$item = $this->getItem($i);
				$item->read();
			}
			return $this;
		}else{
			return parent::readLst($modo);
		}
	}

	public function classList(){

		$perGrupo = array();
		$perUser = array();

		if($this->getID() != ''){
			$item = new Permissao();
			$item->join('processo', 'permissao.id_processo = processo.id_processo', 'id_processo, nome, descricao, controladores');
			$item->where('id_usuario', $this->getID());
			$item->readLst();
			$perUser = $item->getItens() != '' ? $item->getItens() : array();
		}

		if($this->getGrupo() != 0){
			$item = new Permissao();
			$item->join('processo', 'permissao.id_processo = processo.id_processo', 'id_processo, nome, descricao, controladores');
			$item->where('id_usuario', $this->getGrupo());
			$item->readLst();
			$perGrupo = $item->getItens() != '' ? $item->getItens() : array();
		}

		foreach($perGrupo as $key){
			$key->setTipo('permissao');
			$key->setOwner($idUser);
			$key->setGrupo('S');
			$key->setState('');
			$permissoes[$key->getNome()] = $key;

			$keyClone = clone $key;

			$controllers = explode(', ', $key->getControladores());
			foreach($controllers as $value){
				if($value != ''){
					$keyClone->setTipo('controlador');
					$permissoes[$value] = $keyClone;
				}
			}
		}

		foreach($perUser as $key){
			$key->setTipo('permissao');
			$key->setOwner($idUser);
			$key->setGrupo('N');
			$key->setState('');
			$permissoes[$key->getNome()] = $key;

			$keyClone = clone $key;

			$controllers = explode(', ', $key->getControladores());
			foreach($controllers as $value){
				if($value != ''){
					$keyClone->setTipo('controlador');
					$permissoes[$value] = $keyClone;
				}
			}
		}

		$this->permissoesLst = $permissoes;
	}



	/**
	 * Verifica se o usuario pode acessar uma determinada area do sistema ou executar uma determinada ação.
	 *
	 * @param $controlador or $processo
	 * @param $acao
	 * @return boolean
	 */
	public static function verificaAcesso($controlador, $acao = 'ver'){

		if(is_bool($controlador)){
			return $controlador;
		}

		$session = Zend_Registry::get('session');
		$usuario = $session->usuario;

		$permissoes = $usuario->permissoesLst;

		if($permissoes != ''){
			if(array_key_exists('ALL', $permissoes)){
				return true;
			}
		}

		if($permissoes[$controlador][$acao] == cTRUE){
			return true;
		}else{
			return false;
		}
	}

	public static function getListaProcessos(){
		$processo = new Processo();
		$processos = $processo->readLst('array');

		unset($processos['totalItens']);

		$user = Usuario::getInstance('userEdit');

		$permissoesUser = $user->permissoesLst;

		if($permissoesUser == ''){
			$permissoesUser = array();
		}

		$return = '';

		$primary = $processo->getPrimaryName();
		foreach($processos as $item){
			$flag = false;
			foreach($permissoesUser as $permissaoUser){
				if($item['nome'] == $permissaoUser->getNome() && $permissaoUser->getState() != cDELETE && $permissaoUser->getGrupo() == 'N'){
					$flag = true;
				}
			}
			if(!$flag){
				$return[] = array('key' => $item[$primary],'value' => $item['descricao']);
			}
		}
		return $return;
	}

	public function save(){

		//print_r($this);die('<br><br>\n\n' . ' Linha: ' . __LINE__ . ' Arquivo: ' . __FILE__);
		
		switch ($this->getState()) {

			case cDELETE:

				$permissoes = new Permissao;
				$permissoes->where('id_usuario', $this->getID());
				$permissoes->readLst();
				$permissoes->setDeleted();
				$permissoes->save();

				parent::save();
				break;

			case cCREATE:
			case cUPDATE:

			//	print_r($this);die('<br><br>\n\n' . ' Linha: ' . __LINE__ . ' Arquivo: ' . __FILE__);
				
				parent::save();
				$permissoesLst = $this->permissoesLst;


				if($permissoesLst == ''){
					$permissoesLst = array();
				}

				foreach($permissoesLst as $permissao){
					if($permissao->getTipo() == 'permissao' && $permissao->getGrupo() == 'N'){
						$permissoes = new Permissao;
						$permissoes->setID($permissao->getId_permissao());
						$permissoes->setID_Usuario($this->getID());
						$permissoes->setID_Processo($permissao->getId_Processo());
						$permissoes->setOwner($this->getID());
						$permissoes->setState($permissao->getState());
						$permissoes->setVer($permissao->getVer());
						$permissoes->setInserir($permissao->getInserir());
						$permissoes->setExcluir($permissao->getExcluir());
						$permissoes->setEditar($permissao->getEditar());
						$permissoes->save();
					}
				}
				break;
		}

	}
}