<?php

/**
 * Classe de controle do browser JavaScript/Ajax
 * @author ismael
 *
 */
class Browser_Control {

	private $actions;
	private $listaFieldValues;
	private $checkBoxValues;

	public function __construct() {
		$this->actions = array();
		$this->listaFieldValues = array();
		$this->checkboxValues = array();
	}

	private function addAction($array) {
		$this->actions[count($this->actions)] = $array;
	}

	/**
	 * Adiciona um campo numa de lista de campo/valor
	 * para ser usando junto com o SetDataForm para preenchimente
	 * de campos na tela.
	 *
	 * @param $idField
	 * @param $fieldValue
	 */
	public function addFieldValue($idField, $fieldValue, $type = '') {
		$this->listaFieldValues[count($this->listaFieldValues)] = array('idField' => $idField, 'fieldValue' => $fieldValue, 'type' => $type);
	}

	/**
	 * Executa um alert na tela do usuario
	 * com alguma mensagem.
	 *
	 * @param String $msg
	 */
	public function setAlert($title, $msg, $width = 140, $height = 140) {
		$this->addAction(array('action' => 'ALERT', 'title' => $title, 'msg' => $msg, 'width' => $width, 'height' => $height));
	}

	/**
	 * Executa qualquer comando JavaScript
	 *
	 * @param String $command
	 */
	public function setCommand($command) {
		$this->addAction(array('action' => 'COMMAND', 'command' => $command));
	}

	/**
	 * Mostra algum elemento que esteje como Hidden ou Display none
	 *
	 * @param String $id
	 * @param String $speed [Optional]
	 */
	public function setShow($id, $speed = '') {
		$this->addAction(array('action' => 'SHOW', 'id' => $id, 'speed' => $speed));
	}

	/**
	 * Esconde o elemente do ID passado.
	 *
	 * @param String $id
	 * @param String $speed [Optional]
	 */
	public function setHide($id, $speed = '') {
		$this->addAction(array('action' => 'HIDE', 'id' => $id, 'speed' => $speed));
	}

	/**
	 * Remove qualquer elemento da tela pelo id
	 *
	 * @param unknown_type $id
	 */
	public function setRemove($id) {
		$this->addAction(array('action' => 'REMOVE', 'id' => $id));
	}
	public function setRemoveWindow($id) {
		$this->addAction(array('action' => 'REMOVEWINDOW', 'id' => $id));
	}
	/**
	 * seta um campo como somente leitura
	 *
	 * @param String $id
	 */
	public function setReadOnly($id) {
		$this->addAction(array('action' => 'SETREADONLY', 'id' => $id));
	}
	/**
	 * remove um attributo de um elemento
	 *
	 * @param String $id, $attr
	 */
	public function setRemoveAttr($id, $attr) {
		$this->addAction(array('action' => 'REMOVEATTR', 'id' => $id, 'attr' => $attr));
	}

	/**
	 * Modifica as propriedas CSS do elemente.
	 *
	 * @param String $id    ex: nome.
	 * @param String $prop  ex: color.
	 * @param String $val   ex: red.
	 */
	public function setCss($id, $prop, $val) {
		$this->addAction(array('action' => 'CSS', 'id' => $id, 'prop' => $prop, 'val' => $val));
	}

	public function setAttrib($id, $attrib, $val) {
		$this->addAction(array('action' => 'SETATTRIB', 'id' => $id, 'attrib' => $attrib, 'val' => $val));
	}

	/**
	 * Insere dentro do ID passado conteudo html.
	 * @param String $id
	 * @param String $val
	 */
	public function setHtml($id, $val) {
		$this->addAction(array('action' => 'HTML', 'id' => $id, 'val' => $val));
	}
	/**
	 * Insere um label depois do campo com uma msg.
	 * @param String $id
	 * @param String $val
	 */
	public function setMsg($id, $val) {
		$this->addAction(array('action' => 'MSG', 'id' => $id, 'val' => $val));
	}

	/**
	 * Troca a URL do Browser.
	 *
	 * @param $val
	 */
	public function setBrowserUrl($val) {
		$this->addAction(array('action' => 'SETBROWSERURL', 'val' => $val));
	}

	/**
	 * Preenche na tela um campo com um determinado valor
	 * usado junto com o AddFieldValue
	 *
	 * @param $idForm [Optional]
	 */
	public function setDataForm($idForm = '') {
		$this->addAction(array('action' => 'SETDATAFORM', 'idForm' => $idForm, 'fieldValues' => $this->listaFieldValues));
		$this->listaFieldValues = array();
	}
	/**
	 * Faz o o grid fazer uma requisição ajax para atualizar suas linhas
	 *
	 * @param string $id
	 */
	public function setUpdateGrid($id) {
		$this->addAction(array('action' => 'UPDATEGRID', 'id' => $id));
	}

	/**
	 * Adiciona as novas linhas no grid sem precisar refazer uma requisição ajax
	 *
	 * @param string $id
	 * @param json $data
	 */
	public function setAddDataGrid($id,$data) {
		$this->addAction(array('action' => 'ADDDATAGRID', 'id' => $id, 'data' => $data));
	}

	public function setNewScript($script) {
		$this->addAction(array('action' => 'ADDSCRIPT', 'script' => '<script type="text/javascript" src="' . PATH_SCRIPTS . $script . '"></script>'));
	}

	/**
	 * Cria uma Janela
	 *
	 * @param $id
	 * @param $title
	 * @param $width
	 * @param $height
	 * @param $html [Optional]
	 * @param $src [Optional]
	 */
	/*public function newWindow($id, $title, $width, $height, $html ='', $dragdrop = true, $src = '', $speed = '') {
		$this->addAction(array('action' => 'NEWWINDOW', 'idWIndow' => $id, 'title' => $title, 'width' => $width,
            'height' => $height, 'html' => $html, 'src' => $src, 'dragdrop' => $dragdrop));
		$this->addAction(array('action' => 'SHOW', 'id' => $id, 'speed' => $speed));
	}*/

	public function newWindow($obj) {
		if(!is_object($obj)){
			throw new  Zend_Exception('O valor passado para a função não e um objeto');
		}
		$this->addAction(array('action' => 'NEWWINDOW', 'html' => $obj->render()));
	}

	/**
	 * faz e execução de uma nova requisição ajax
	 *
	 * @param string $id do elemento que será executada a request
	 * @param string $event evento que será executado ex: click, dblclick
	 */
	public function executeAjaxRequest($id, $event) {
		$this->addAction(array('action' => 'EXECUTEAJAXREQUEST', 'id' => $id, 'event' => $event));
	}

	public function validaForm($json){
		$this->addAction(array('action' => 'VALIDAFORM', 'json' => $json));
	}

	/**
	 * função usando junto com o array_walk ou array_walk_recursive.
	 * remove todos os espaços em branco em um array
	 *
	 * @param string $value
	 */
	public function trimForArray(&$value){
		$value = trim($value);
	}

	/**
	 * Seta um script Css Ou Js na memoria para quando reinderizada a pagina
	 * seje colocada os scripts la
	 * @param String $type tipos suportados "css" ou "js"
	 * @param String $name nome script pasta/nome ou apenas nome se o script esta na rais
	 * @param String $loc endereço de onde ele esta
	 */
	public static function setScript($type, $name, $loc) {
		$script = Zend_Registry::get($type);
		$script[$name] = PATH_SCRIPTS . $loc;
		Zend_Registry::set($type, $script);
	}

	/**
	 * Retorna os scripts css e js para ser incluido na tela
	 */
	public static function getScripts() {
		$scripts = '';
		$js = Zend_Registry::get('js');
		$css = Zend_Registry::get('css');
		foreach ($js as $val) {
			$scripts .= '<script type="text/javascript" src="' . $val . '"></script>';
		}
		foreach ($css as $val) {
			$scripts .= '<link rel="stylesheet" href="' . $val . '">';
		}
		return $scripts;
	}

	public function send() {
		echo json_encode(array('actions' => $this->actions));
		$this->actions = array();
		$this->listaFieldValues = array();
		$this->CheckboxValues = array();
	}

}