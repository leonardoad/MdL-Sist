<?php
class Zend_View_Helper_FormDate extends Zend_View_Helper_FormElement{
	public function formDate($name, $value = null, $attribs = null){
		$info = $this->_getInfo($name, $value, $attribs);
        extract($info); // name, value, attribs, options, listsep, disable

        $mask = $attribs['mask'];
//        print_r(); die();
        unset($attribs['mask']);


        // build the element
        $disabled = '';
        if ($disable) {
            // disabled
            $disabled = ' disabled="disabled"';
        }

        // XHTML or HTML end tag?
        $endTag = ' />';
        if (($this->view instanceof Zend_View_Abstract) && !$this->view->doctype()->isXhtml()) {
            $endTag= '>';
        }
//		print_r($mask);
//		die();
	    unset($attribs['id']);
		$sep = '';
		$params = '{';
        foreach ($attribs as $key => $val){
        	if ($key == 'buttonText' && $val == ''){
        		$val = $name;
        	}
        	if($val){
				$params .= $sep.$key." : '".$val."'";
				$sep = ', ';
			}
//			unset($attribs[$key]); Por deste unset ???????
        }
        $params .= '}';

        $xhtml = '<div id="formDate-'.$id.'"><input type="text"'
                . ' name="' . $this->view->escape($name) . '"'
                . ' id="' . $this->view->escape($id) . '"'
                . ' value="' . $this->view->escape($value) . '"'
                . $disabled
                . ' style="float:left"'
                . $this->_htmlAttribs($attribs)
                . $endTag
                . '<script type="text/javascript">$("#'.$id.'")'
                . '.datepicker('.$params.'); '
                . '</script></div>';
        $xhtml .= "<script type='text/javascript'>$('#".$id."').setMask({mask: '$mask', autoTab: false})</script>";

        return $xhtml;
	}
}