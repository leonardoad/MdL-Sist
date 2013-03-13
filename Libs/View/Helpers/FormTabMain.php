<?php
class Zend_View_Helper_FormTabMain extends Zend_View_Helper_FormElement{
	public function getParams($attribs){
		$params = '{';
		$sep = '';
		foreach ($attribs as $key => $val){
			if(!($key == 'id' || $key == 'tabs' || $key == 'disabled')){
				if($val){
					$params .= $sep.$key.' : '.$val;
					$sep = ', ';
				}
			}else if($key == 'disabled'){
				if($val){
					$p = '[';
					$sep2 = '';
					foreach ($val as $value){
						$p .= $sep2 . $value;
						$sep2 = ' ,';
					}
					$p .= ']';
					$params .= $sep . $key . ':' . $p;
					$sep = ' ,';
				}
			}
		}
		$params .= '}';
		return $params;
	}
    public function formTabMain($name, $value = null, $attribs = null){
    	$view = Zend_Registry::get('view');

    	$tabs = '<div id="'.$attribs['id'].'" class="tabs"><ul>';
    	foreach($attribs['tabs'] as $val){
			if($val->visible){
	    		if($val)
	    			$tabs .=  '<li><a href="#'.$val->getName().'" class="tabs">'.$val->title.'</a></li>';
			}
    	}
    	$tabs .= '</ul>';

    	foreach($attribs['tabs'] as $val){
    		if($val->visible){
	    		if($val->fields){
		    		foreach($val->fields as $comp){
		    			$view->assign($comp->getName(), $comp->render());
		    		}
	    		}
		    	if($val->template)
					$tabs .= '<div id="'.$val->getName().'">'.$view->fetch($val->template).'</div>';
				else
					$tabs .= '<div id="'.$val->getName().'">'.$view->fetch('abas/'.$val->getName().'.tpl').'</div>';

	    	}
    	}
		$tabs .= '</div>';
		$tabs .= '<script type="text/javascript">$("#'.$attribs['id'].'")';
		$tabs .= '.tabs('.$this->getParams($attribs).')'	;
		$tabs .= '</script>';
		return $tabs;
	}
}