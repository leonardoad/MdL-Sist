<?php
class Ui_Element_MainMenu{
	private $id;
	private $position;
	private $menuItem;
	private $velocidade;
	private $wSubmenu;

	public function __construct($id = 'menu', $position = 'h'){
		$this->id = $id;
		$this->position = $position;
		$this->menuItem = array();
		Browser_Control::setScript('js', 'Menu', 'Menu/pluginMenu.js');
		if($this->position == 'v'){
			Browser_Control::setScript('css', 'MenuV', 'Menu/Vertical.css');
		}else{
			Browser_Control::setScript('css', 'MenuH', 'Menu/Horizontal.css');
		}
	}
	public function setParams($wSubmenu, $velocidade = ''){
		$this->wSubmenu = $wSubmenu;
		$this->velocidade = $velocidade;
	}
	public function addMenuItem($item){
		$this->menuItem[] = $item;
	}
	public function render(){
		$sep = '';
		$params = '{';
		if($this->velocidade){
			$params .= 'velocidade:'.$this->velocidade;
			$sep = ', ';
		}
		if($this->wSubmenu){
			$params .= $sep.'wSubmenu:'.$this->wSubmenu;
		}
		$params .= '}';
		$menu = '<form id="menu-'.$this->id.'" name="menu-'.$this->id.'">';
		$menu .= '<div id="menu-'.$this->id.'"><ul id="primary-nav" class="menu'.strtoupper($this->position).'">';
		foreach($this->menuItem as $item){
			$menu .= $item->render();
		}
		$menu .= '</ul></div></form>';
		$menu .= '<script type="text/javascript">$("#menu-'.$this->id.'").menu('.$params.')</script>';
		$this->id = '';
		$this->position = '';
		return $menu;
	}
}