/**
 * Biblioteca de funções para manipulação do Browser
 * 
 * @author Ismael Sleifer Web Designer <ismaelsleifer@gmail.com>
 * @copyright Ismael Sleifer
 */

// #################### variaveis globais ##########################

var pressedKey = false;

// #################################################################

/**
 * Retorna um valor para o z-index sendo este retornado o z-index mais alto
 */
function getMaxZindex(){
    retorno = parseInt( new Date().getTime()/1000 ) ;
    return retorno;
}
function marcaObrig(){
	$('*[obrig]').css('borderRight', '2px solid #c10005');
}

function desmarcaCheckedGrid(){
	var chks = $('input[id *= "chklstTodos"]');
	$.each(chks, function(i, obj){
		obj.checked = false;
	});
}

function setConfirm(title, text, w, h, obj, event){
	$('#alert').html(text);
	$('#alert').dialog({
		title: title,
		resizable: false,
		modal: true,
		height: h,
		width: w,
		position: 'center',
		buttons: {
			Ok: function(){
				msg = obj.attr('msg');
				$(this).dialog('close');
				obj.removeAttr('msg');
				ajaxRequest(obj, event);
				obj.attr('msg', msg);
				return false;
			},
			Cancelar: function() {
				$(this).dialog('close');
				return false;
			}
		}
	});
}

function setAlert(title, text, w, h){
	$('#alert').html(text);
	$('#alert').dialog({
		title: title,
		resizable: false,
		modal: true,
		height: h,
		width: w,
		position: 'center',
		buttons: {
			Ok: function(){
				$(this).dialog('close');
				return false;
			}
		}
	});
}

function addToolTip(obj){
    var pos = $('#'+obj.id).position();
    var html = '';
    if($('#'+obj.id+'_msg').html() == null){
    	html = '<div id="'+obj.id+'_msg" onClick="$('+"'"+'#'+obj.id+'_msg'+"'"+').remove()"' + 
    		   'style="z-index:1000;position:absolute;top:'+(pos.y+20)+';left:'+(pos.x)+';margin-top:5px;' +
    		   'padding:2px;border:1px solid #CD0A0A;font-size: 11px;background:#FEF1EC">'+obj.val+'<spam >' + 
    		   '<font color="red">X</font></spam></div>';    	
        $('#'+obj.id).after(html);
    }else{
        $('#'+obj.id+'_msg').html(obj.val);
    }
}
function setDataForm(obj){
    var idForm = '';
    if (obj.idForm != ''){
        idForm = '#' + obj.idForm;
    }
    $.each(obj.fieldValues, function(y, values){
    	if(values.type != ''){
    		var tipo = values.type;
    	}else{
    		var tipo = $(idForm + ' #' + values.idField).attr('type');
    	}
        switch (tipo) {
            case "text":
            case "textarea":
            case "hidden":
            case "password":
                $(idForm + ' #' + values.idField).val(values.fieldValue);
                break;
            case "checkbox":
                if($(idForm + ' #' + values.idField).attr('value') ==  values.fieldValue){
                    $(idForm + ' #' + values.idField).attr('checked', 'checked');
                }
                else{
                    $(idForm + ' #' + values.idField).removeAttr('checked');
                }
                break;
            case "select-one":
                $(idForm + ' #' + values.idField).find('option[value='+values.fieldValue+']').attr('selected', 'selected');
                break;
            case "select":
            	var option = '';
            	$.each(values.fieldValue, function(i, val){
            		option += '<option value="' + val.key + '" label="' + val.value + '">' + val.value + '</option>';
            	});
            	$('#' + values.idField).html(option);
            	break;
            default:
                break;
        }
    });	
}
function validaForm(obj){
	eval('json = ' + obj.json+';');
	var ret = '';
	 $.each(json, function(i, o){
		 label = 'campo "' + $('label[for="' + i +'"]').html()+'" ';
		 if(o.isEmpty != undefined){
			 ret += 'O ' + label + 'deve ser informado. <br />';
		 }else if(o.notAlnum != undefined){
			 ret += 'O ' + label + 'não pode conter valores alfanuméricos. <br />';
		 }else if(o.stringLengthTooLong != undefined){
			 ret += 'O número de caracteres excedido para o ' + label + '.<br />';
		 }else if(o.stringLengthTooShort != undefined){
			 ret +='O número de caracteres e muito curto para o ' + label + '.<br />';
		 }
		 $('#'+i).css('outline', '1px solid red');

	 });
	 setAlert('Verificar campos', ret, 300, 180);
}
$(document).ready(function(p){

	/**
	 * inseri em todos as paginas html uma div e calcula a posição do mouse para
	 * inserir a imagem loader ao lado do mouse nas requisições ajax
	 */
	$('body').append('<div id="ajaxStart" style="display:none;"></div>');	
	$(document).mousemove(function(p){
		$('#ajaxStart').css('left', p.pageX + 15);
		$('#ajaxStart').css('top', p.pageY);
		$('#ajaxStart').css('zIndex', getMaxZindex());
	});
	/**
	 * função que verifica o tamanho maximo de caracteres no textarea
	 */
	$('#descricao').live('keydown',function(e){
		var tam = $(this).attr('maxlength');
		var tecl = e.keyCode;
		if(tecl != 8 && tecl != 37 && tecl != 38 && tecl != 39 && tecl != 40 && tecl != 46){
			if(tam < ($(this).val().length + 1)){
				return false;
			}
		}
	});
	
	/**
	 * cancela todos os submits dos fomulario
	 */
 $('form').live('submit', function(){
	 return false;
 });
	
	marcaObrig();

	/**
	 * função usada nos grids para marcar e desmarcar todos os checkbox
	 */
	$('input[id *= "chklstTodos"]').live('click', function(){
		var col = $('input[col='+$(this).attr('col')+']');
		if($(this).attr('checked')){
			$.each(col, function(i, obj){
				obj.checked = true;
			});
		}else{
			$.each(col, function(i, obj){
				obj.checked = false;
			});
		}
	});
});

/**
 * converte os dados do formulario para nome/valor no foramto json ex: {'nome' :
 * 'Ismael Sleifer'}
 */
function serializeDataFormJson(id){
	var data = '{';
	var sep = '';
	var campo = '';
	var campos = $('#'+id).serialize().split('&');
	for(i = 0; i < campos.length; i++){
		campo = campos[i].split('=');
		data += sep + "'" + campo[0] + "':'" + campo[1] + "'";
		sep = ', ';
	}
	data += '}';
	return data;
}

function returnRequest(data){
	if(data == null){
		return false;
	}
    $.each(data.actions, function(i, obj){
        if (obj.action == 'ALERT'){
            setAlert(obj.title, obj.msg, obj.width, obj.height);
        }else if (obj.action == 'COMMAND'){
            eval(obj.command);
        }else if (obj.action == 'SHOW'){
            $('#' + obj.id).show(obj.speed);
        }else if (obj.action == 'HIDE'){
            $('#' + obj.id).hide(obj.speed);
        }else if(obj.action == 'REMOVE'){
        	$('#' + obj.id).remove();
        }else if (obj.action == 'CSS'){
        }else if(obj.action == 'REMOVEWINDOW'){
        	$('#' + obj.id).dialog("close");
        }else if (obj.action == 'CSS'){
            $('#' + obj.id).css(obj.prop,obj.val);
        }else if (obj.action == 'HTML'){
            $('#' + obj.id).html(obj.val);
        }else if (obj.action == 'SETBROWSERURL'){
            window.location = obj.val;
        }else if(obj.action == 'UPDATEGRID'){
        	$('#' + obj.id).flexReload();
        }else if(obj.action == 'ADDDATAGRID'){
            eval('var data = '+unescape(obj.data));
        	$('#' + obj.id).flexAddData(data);
        }else if(obj.action == 'SETATTRIB'){
        	$(obj.cond).attr(obj.attrib, obj.val);
        }else if(obj.action == 'MSG'){
        	addToolTip(obj);
        }else if(obj.action == 'ADDSCRIPT'){
        	var script = $('script[src*='+obj.script+']');   	
        	$('body').append(obj.script);
	    }else if(obj.action == 'EXECUTEAJAXREQUEST'){
	    	ajaxRequest($('#' + obj.id), obj.event);
	    }else if (obj.action == 'SETDATAFORM'){
	    	setDataForm(obj);
        } else if(obj.action == 'NEWWINDOW'){
        	$('body').append(obj.html);
        } else if (obj.action == 'VALIDAFORM'){
        	validaForm(obj);
        }else if (obj.action == 'REMOVEATTR'){
        	$('#' +obj.id).removeAttr(obj.attr);
        }else if (obj.action == 'NEWTAB'){
        	window.open(obj.url,'_blank')
        }
    });
    marcaObrig();	
};

function ajaxRequest(obj, event){
	form = '';
	if(obj.attr('validaObrig')){
        var flag = '';
        $('*[obrig]').each(function(){
	        if($(this).val() == ''){
	        	$(this).css('outline', '1px solid red');
	            flag = true;
	        }else{
	            $(this).css('outline', '');
	        }
        });
	    if(flag){
	    	setAlert('Campos Obrigatórios', 'Os campos em vermelho devem ser preenchidos', 200, 140);
	        return false;
	    }
	}
	if(obj.attr('msg')){
		setConfirm('Excluir', obj.attr('msg'), 200, 140, obj, event);
		return false;
	}
	id = obj.attr('id');
	$.each($('form'), function(i, objForm){
		if($('#' + objForm.id + ' #' + id).attr('name') != undefined){
			form = objForm.id;
			if(obj.attr('url')){
				url = obj.attr('url');
			}else{
				url = $('#' + form).attr('action');
			}
		}
	});
	
	params = '&'+obj.attr('params');
    if(params == '&undefined'){
        params = '';
    }
    
    params += '&ajax=true';
    
	if(event == 'change' || event == 'blur' || event == 'focus' || event == 'focusout'){
		params += '&controlValue='+obj.attr('value');
	}

	if(obj.attr('act')){
		controlName = obj.attr('act');
	}else{
		controlName = obj.attr('name');
	}
    
    sendFormFields = obj.attr('sendFormFields');
    formName = form;
    functionResultName = obj.attr('functionResultName');

	senha = '';
	       
    if(functionResultName == undefined || functionResultName == ''){
        functionResultName = 'returnRequest';
    }
    if(sendFormFields){
        params += '&' + $('#'+formName).serialize();
    }
    
	$('input[type="password"]').each(function(){
		if($(this).val() != '' && $(this).attr('cript') != undefined){
			p = params.split('&');
			params = '';
			sep = '';
			for(i = 0; i < p.length; i++){
				name = p[i].split('=');
				if($(this).attr('id') != name[0]){
					params += sep+p[i];
				}
				sep = '&';
			}
			params += '&'+$(this).attr('id')+'='+$.md5($(this).val());
		}
	});
    
    $('#'+ id).ajaxStart(function(){$('#ajaxStart').show();});

    
    //alert(cBaseUrl);
    $.ajax({
        type: 'POST',
        url: cBaseUrl + url + '/' + controlName + event,
        data: params,
        dataType: 'json',
        success: function(returnData){
            eval(functionResultName+'(returnData);');
            $('#ajaxStart').hide();
        }
    });
    
}

$('*[event*="blur"]').live('blur',function(){ajaxRequest($(this), 'blur');});
$('*[event*="change"]').live('change',function(){ajaxRequest($(this), 'change');});
$('*[event*="click"]').live('click',function(e){ajaxRequest($(this), 'click');});
$('*[event*="dblclik"]').live('dblclick',function(){ajaxRequest($(this), 'dblclick');});
$('*[event*="focus"]').live('focus',function(){ajaxRequest($(this), 'focus');});
$('*[event*="hover"]').live('hover',function(){ajaxRequest($(this), 'hover');});
$('*[event*="out"]').live('focusout',function(){ajaxRequest($(this), 'focusout');});
$('*[event*="keydown"]').live('keydown',function(){ajaxRequest($(this), 'keydown');});
$('*[event*="keypress"]').live('keypress',function(){ajaxRequest($(this), 'keypress');});
$('*[event*="keyup"]').live('keyup',function(){ajaxRequest($(this), 'keyup');});
$('*[event*="mousedown"]').live('mousedown',function(){ajaxRequest($(this), 'mousedown');});
$('*[event*="mousemove"]').live('mousemove',function(){ajaxRequest($(this), 'mousemove');});
$('*[event*="mouseout"]').live('mouseout',function(){ajaxRequest($(this), 'mouseout');});
$('*[event*="mouseover"]').live('mouseover',function(){ajaxRequest($(this), 'mouseover');});
$('*[event*="mouseup"]').live('mouseup',function(){ajaxRequest($(this), 'mouseup');});
$('*[event*="resize"]').live('resize',function(){ajaxRequest($(this), 'resize');});
$('*[event*="scroll"]').live('scroll',function(){ajaxRequest($(this), 'scroll');});
$('*[event*="select"]').live('select',function(){ajaxRequest($(this), 'select');});
$('*[event*="submit"]').live('submit',function(){ajaxRequest($(this), 'submit');});
$('*[event*="unload"]').live('unload',function(){ajaxRequest($(this), 'unload');});
$('*[updateGrid]').live('click',function(){eval('data = {"actions": [{"action":"UPDATEGRID", "id":"' + $(this).attr('updateGrid') + '"}]}');returnRequest(data);});

/**
 * padrão da função
 * 
 * letra,id,evento ex: 's,btnsalvar,click'
 */
function hotKeys(e, obj){
	var keys = new Array();
	keys['TAB'] 	= '9';
	keys['ENTER'] 	= '13';
	keys['SHIFT'] 	= '16';
	keys['CTRL'] 	= '17';
	
	var atalhos = obj.attr('hotkeys').split('|');
	var params = '';
	
	$.each(atalhos, function(i, atalho){
		
		params = atalho.split(',');
		comb = params[0].split('+');
		
		if(comb.length == 2){
			tecla = jQuery.trim(comb[1].toUpperCase());
			val = tecla.charCodeAt(0);
			
			if(e.keyCode == keys[jQuery.trim(comb[0]).toUpperCase()]){
				pressedKey = true;
				return false;
			}

			if (e.keyCode == val && pressedKey == true) {
				// Aqui vai o código e chamadas de funções para o ctrl+s
				ajaxRequest($('#' + jQuery.trim(params[1])), jQuery.trim(params[2]));
				return false;
			}
			
		}else{
			tecla = jQuery.trim(comb[0].toUpperCase());
			val = tecla.charCodeAt(0);

			if(!isNaN(tecla.charCodeAt(1))){
				val = '';
			}
			if($('#' + jQuery.trim(params[1])).attr('id') != undefined){
				if (e.keyCode == val && pressedKey == false) {
					// Aqui vai o código e chamadas de funções para o ctrl+s
					ajaxRequest($('#' + jQuery.trim(params[1])), jQuery.trim(params[2]));
					return false;
				}else if(e.keyCode == keys[tecla]){
					ajaxRequest($('#' + jQuery.trim(params[1])), jQuery.trim(params[2]));
					return false;
				}
			}else{
				alert('O id "' + params[1] + '" passado não foi encontrado.');
			}
		}
	});
}
/**
 * usado o keydown e o keyup pois alguns navegadores no keydown o keycode do
 * enter não existe (ex: IE).
 * 
 * e feito este if para não haver mais de uma requisição ajax no firefox
 */
$('*[hotkeys]').live('keydown',function(e){
	if(e.keyCode != 13){
		hotKeys(e, $(this));
	}
	if(pressedKey){
		return false;
	}
});
$('*[hotkeys]').live('keyup',function(e){
	if(e.keyCode == 13){
		hotKeys(e, $(this));
	}
	if(pressedKey){
		return false;
	}
	return false;
});


$('*[hotkeys]').live('keyup',function(e){
    // Quando uma tecla for liberada verifica se o CTRL para notificar
	// que CTRL não está pressionado
	if (e.keyCode == 9 || e.keyCode == 13 || e.keyCode == 16 || e.keyCode == 17){
		pressedKey = false;
	}
});