<?php
/**
 *  Classe de criação e controle da tela inicial do sistema
 * 
 * @author Leonardo Danieli <leonardo.danieli@gmail.com>
 * @version 1.0
 * 
 */
class IndexController extends Zend_Controller_Action{

	public function indexAction()
	{

		$mainMenu = new Ui_Element_MainMenu('menuPrincipal');
		$mainMenu->setParams('200');

		// =========== Menu Cadastros ==========
		// Menu Cadastros
		$menuItem = new Ui_Element_MenuItem('cadastros', 'Cadastros');

		$mainMenu->addMenuItem($menuItem);

		// Cadastro de usuario
//		$menu = new Ui_Element_MenuItem('cadFornecedor', 'Fornecedores', 'Fornecedor', 'iframePrincipal');
//		$menu->setVisible('PROC_CAD_FORNECEDOR', 'ver');
//		$menuItem->addSubMenu($menu);

		// Cadastro de Empresas
//		$menu = new Ui_Element_MenuItem('cadEmpresa', 'Empresas', 'Empresa', 'iframePrincipal');
//		$menu->setVisible('PROC_CAD_EMPRESA', 'ver');
//		$menuItem->addSubMenu($menu);
//		// Cadastro de usuario
//		
//		$menu = new Ui_Element_MenuItem('cadUf', 'Estados', 'Uf', 'iframePrincipal');
//		$menu->setVisible('PROC_CAD_UF', 'ver');
//		$menuItem->addSubMenu($menu);
		
//		// Cadastro de pais
//		$menu = new Ui_Element_MenuItem('cadPais', 'Paises', 'Pais', 'iframePrincipal');
//		$menu->setVisible('PROC_CAD_PAIS', 'ver');
//		$menuItem->addSubMenu($menu);
//		
//		// Cadastro de cidades
//		$menu = new Ui_Element_MenuItem('cadcidade', 'Cidades', 'Cidade', 'iframePrincipal');
//		$menu->setVisible('PROC_CAD_CIDADE', 'ver');
//		$menuItem->addSubMenu($menu);
//
		// Cadastro de cidades
		$menu = new Ui_Element_MenuItem('cadTipoProduto', 'Classificação de Produtos', 'Tipoproduto', 'iframePrincipal');
		$menu->setVisible('PROC_CAD_PRODUTO', 'ver');
		$menuItem->addSubMenu($menu);
		// Cadastro de cidades
		$menu = new Ui_Element_MenuItem('cadProduto', 'Produtos', 'Produto', 'iframePrincipal');
		$menu->setVisible('PROC_CAD_PRODUTO', 'ver');
		$menuItem->addSubMenu($menu);
//		
		// Cadastro de bairro
		$menu = new Ui_Element_MenuItem('cadBanner', 'Banners', 'Album/albuns', 'iframePrincipal');
		$menu->setVisible('PROC_CAD_BANNER', 'ver');
		$menuItem->addSubMenu($menu);
                
                $menuItem = new Ui_Element_MenuItem('seguranca', 'Segurança');

		$mainMenu->addMenuItem($menuItem);

		$menu = new Ui_Element_MenuItem('trocaSenha', 'Trocar senha', 'Login/Trocasenha', 'iframePrincipal');
		$menu->setVisible('PROC_CAD_TROCA_SENHA', 'ver');
		//$menu->setEvent('click', 'User/trocasenha');
		$menuItem->addSubMenu($menu);

		$menu = new Ui_Element_MenuItem('configs', 'Configuração do sistema', 'Config', 'iframePrincipal');
		$menu->setVisible('PROC_CAD_CONFIG', 'ver');
		//$menu->setEvent('click', 'Config');
		$menuItem->addSubMenu($menu);

		// Cadastro de usuario
		$menu = new Ui_Element_MenuItem('Users', 'Usuário', 'Usuario/Users', 'iframePrincipal', '');
		$menu->setVisible('PROC_CAD_USUARIO', 'ver');
		$menuItem->addSubMenu($menu);

		// Cadastro de grupos
		$menu = new Ui_Element_MenuItem('grupos', 'Grupos', 'Usuario/grupos', 'iframePrincipal', '');
		$menu->setVisible('PROC_CAD_USUARIO', 'ver');
		$menuItem->addSubMenu($menu);

		// =========== Menu Sair ==========
		$menuItem = new Ui_Element_MenuItem('logoff', 'Sair', 'Login/logout');
		$menuItem->setVisible(true, '');
		$mainMenu->addMenuItem($menuItem);

		$view = Zend_Registry::get('view');

		$view->assign('menu', $mainMenu->render());
		$view->assign('title', 'Mural das Lembrancinhas - Sistema de Vendas');
		$view->assign('usuarioLogado', Session_Control::getPropertyUserLogado('nomecompleto'));

		$view->assign('scripts', Browser_Control::getScripts());
		$view->assign('body', $view->fetch('Index/index.tpl'));
		$view->output('index.tpl');
	}

	public function aboutAction()
	{

	}
	public function sessionAction(){
//		echo date('h-i-s');
	}
}