<?php
/**
 * Controller que cria e trata as requests da tela de login
 * 
 * @author 	Ismael Sleifer
 * @copyright 	Ismael Sleifer Web Designer
 * @package     sistema
 * @subpackage	sistema.apllication.controllers
 * @version		1.0
 */
class LoginController extends Zend_Controller_Action{
	public function init(){
		Browser_Control::setScript('css', 'Login', 'Login/Login.css');
		Browser_Control::setScript('js', 'md5', 'md5.js');
	}
	public function indexAction(){

		$form = new Ui_Form();
		$form->setName('formLogin');
		$form->setAction('Login');
		
		$element = new Ui_Element_Text('user');
		$element->setAttrib('maxlenght', '30');
		$element->setAttrib('size', '21');
		$element->setAttrib('obrig', 'obrig');
		$element->setRequired();
		$element->setAttrib('hotkeys', 'enter, btnLogin, click');
		$form->addElement($element);

		$element = new Ui_Element_Password('senha');
		$element->setAttrib('maxlenght', '30');
		$element->setAttrib('size', '21');
		$element->setAttrib('obrig', 'obrig');
		$element->setAttrib('cript', '1');
		$element->setRequired();
		$element->setAttrib('hotkeys', 'enter, btnLogin, click');
		$form->addElement($element);

		$button = new Ui_Element_Btn('btnLogin');
		$button->setDisplay('OK', PATH_IMAGES.'Buttons/Ok.png');
		$button->setAttrib('sendFormFields', '1');
		$form->addElement($button);

		$form->setDataSession('formLogin');

		$view = Zend_Registry::get('view');
		$w = new Ui_Window('login', 'Login', $form->displayTpl($view, 'Login/index.tpl'));
		$w->setDimension('390', '240');
		$w->setCloseOnEscape('false');
		$w->setNotDraggable();

		$view->assign('scripts', Browser_Control::getScripts());
		$view->assign('body', $w->render());
		$view->output('index.tpl');
	}
	public function btnloginclickAction(){
		$form = Session_Control::getDataSession('formLogin');

		$limpaSession = false;
		
		$valid = $form->processAjax($_POST);

		$br = new Browser_Control();
		if($valid != 'true'){
			$br->validaForm($valid);
			$br->send();
			exit;
		}

		$post = Zend_Registry::get('post');
		$users = new Usuario();
		$users->where('loginuser', $post->user );
		$users->where('senha', Format_Crypt::encryptPass($post->senha) );
		$users->where('ativo', 'S' );
		$user = $users->readLst()->getItem(0);
		if ($user){
			$tempo = Format_Date::comparaData($user->getDataSenha());

                        
			$config = new Config();
			$config->read(1);
			if($config->getTrocaSenhaTempo() == cTRUE  && $config->getTempoTrocaSenha() <= $tempo){
				$url = './login/trocasenha/id/' . $user->getID();
			}else{
				$url = './index';
				$session = Zend_Registry::get('session');
				$session->usuario = $user;
				Zend_Registry::set('session', $session);
				Log::createLogFile('O usuário ' . $user->getNomeCompleto() . ' acessou o sistema');
			}

			$br->setBrowserUrl($url);
			$limpaSession = true;

		}else{
			$br->addFieldValue('senha', '');
			$br->addFieldValue('user', '');
			$br->setDataForm('formLogin');
			$br->setHtml('warning','Usúario ou senha incorretos!');
		}
		$br->send();
		if($limpaSession){
			Session_Control::setDataSession('formLogin', '');
		}
	}

	public function trocasenhaAction(){

		$post = Zend_Registry::get('post');
		$session = Zend_Registry::get('session');
		$userId = Session_Control::getPropertyUserLogado('id');

		if($userId != ''){
			$id = $userId;
		}else{
			$id = $post->id;
		}


		$form = new Ui_Form();
		$form->setName('formTrocaSenha');
		$form->setAction('Login');

		$element = new Ui_Element_Hidden('idUser');
		$element->setValue($id);
		$form->addElement($element);

		$element = new Ui_Element_Password('senhaAtual');
		$element->setAttrib('maxlenght', '30');
		$element->setAttrib('size', '21');
		$element->setAttrib('obrig', 'obrig');
		$element->setAttrib('cript', '1');
		$element->setRequired();
		$element->setAttrib('hotkeys', 'enter, btnTrocaSenha, click');
		$form->addElement($element);

		$element = new Ui_Element_Password('senhaNova');
		$element->setAttrib('maxlenght', '30');
		$element->setAttrib('size', '21');
		$element->setAttrib('obrig', 'obrig');
		$element->setAttrib('cript', '1');
		$element->setRequired();
		$element->setAttrib('hotkeys', 'enter, btnTrocaSenha, click');
		$form->addElement($element);

		$button = new Ui_Element_Btn('btnTrocaSenha');
		$button->setDisplay('OK', PATH_IMAGES.'Buttons/Ok.png');
		$button->setAttrib('sendFormFields', '1');
		$form->addElement($button);

		$form->setDataSession('formLogin');

		$view = Zend_Registry::get('view');
		$w = new Ui_Window('trocaSenha', 'Alterar senha', $form->displayTpl($view, 'Login/trocasenha.tpl'));
		$w->setDimension('300', '140');
		$w->setCloseOnEscape('false');
		$w->setNotDraggable();

		$view->assign('scripts', Browser_Control::getScripts());

		$view->assign('body', $w->render());
		$view->output('index.tpl');
	}
	public function btntrocasenhaclickAction(){
		$form = Session_Control::getDataSession('formLogin');

		$br = new Browser_Control();
		$post = Zend_Registry::get('post');

		$valid = $form->processAjax($_POST);

		if($valid != 'true'){
			$br->validaForm($valid);
			$br->send();
			exit;
		}

		$user = new Usuario();
		$user->read($post->idUser);

		if(Format_Crypt::encryptPass($post->senhaAtual) != $user->getSenha()){
			$br->setAlert('Senha Incorreta', 'Há senha informada não confere com a do sistema. <br/>Tente novamente.', 300);
			$br->send();
			exit;
		}else{
			$user->setSenha(Format_Crypt::encryptPass($post->senhaNova));
			$user->setDataSenha(date('Y-m-d'));

			$session = Zend_Registry::get('session');
			$session->usuario = $user;
			Zend_Registry::set('session', $session);

			$user->save();

			Zend_Session::destroy();
		}
		$br->setBrowserUrl(BASE_URL.'index');
		$br->send();
	}


	public function logoutAction()
	{
		Log::createLogFile('O usúario ' . Session_Control::getPropertyUserLogado('nomecompleto') . ' saiu do sistema');
		Zend_Registry::set('session', array());
		Zend_Session::destroy();
		$this->_redirect('./login');
	}
}