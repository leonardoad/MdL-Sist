<?php
/**
 * O MENU
 *
 * @author ismael
 *
 */
class Ui_Element_MenuItem{
	private $id;
	private $title;
	private $link;
	private $img;
	private $dest;
	private $event;
	private $url;
	private $subMenu;
	private $visible = true;

	/**
	 *
	 * @param <type> $id
	 * @param <type> $title
	 * @param <type> $link
	 * @param <type> $dest
	 * @param <type> $img
	 */
	public function __construct($id, $title, $link = '#', $dest = '', $img = ''){
		$this->id = $id;
		$this->title = $title;
		$this->link = $link;
		$this->dest = $dest;
		$this->img = $img;
		$this->visible = true;
	}
	public function setEvent($event, $url){
		$this->event = $event;
		$this->url = $url;
	}
	public function addSubMenu($menu){
		$this->subMenu[] = $menu;
	}
	public function setVisible($processo, $acao){
		$this->visible = Usuario::verificaAcesso($processo, $acao);
	}
	public function render(){
		$subMenus = '';

		if($this->visible){
			if($this->subMenu){
				$menu = '<li id="'.$this->id.'" class="menuparent">';
				$menu .= '<a href="#"><div class="imgMenu">';
				if($this->img){
					$menu .= '<img src="'.$this->img.'">';
				}
				$menu .='</div><div class="textMenu">'.$this->title.'</div></a><ul>';
				foreach($this->subMenu as $subMenu){
					$subMenus .= $subMenu->render();
				}
				if($subMenus != ''){
					$menu .= $subMenus;
					$menu .= '</ul></li>';
				}else{
					$menu = '';
				}
			}else{
				if($this->link != '#' || $this->url != ''){
					$menu = '<li>';
					$menu .= '<a style="border: 1px solif #000;" name="'.$this->id.'" href="'.$this->link.'" target="'.$this->dest.'" event="'.$this->event.'" url="'.$this->url.'">';
					$menu .= '<div class="imgMenu">';
					if($this->img){
						$menu .='<img src="'.$this->img.'">';
					}
					$menu .= '</div><div class="textMenu">'.$this->title.'</div></a>';
					$menu .= '</li>';
				}
			}
		}
		return $menu;
	}
}