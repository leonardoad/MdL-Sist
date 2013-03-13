<?php
class FormataDados{

	/**
	 * Formata uma valor depedendo do tipo passado para a função, caso seja passado na propriedade valor
	 * um objeto o tipo e valor sera pego do proprio objeto
	 *
	 * @param String or Object $valor
	 * @param String $tipo
	 */
	public static function formataDadosSave($valor, $tipo){

		if(is_object($valor)){
			$key = 'a_'.$tipo;
			$tipo = $valor->getTipoColuna($tipo);
			$valor = $valor->$key;
		}

		if (strcmp($tipo , 'date')==0){
			return DataHora::inverteData($valor);
		}else if (strcmp($tipo , 'numeric')==0) {
			return number_format($valor,2, '.', '');
		}else if (strcmp($tipo , 'int4')==0) {
			return number_format($valor,0, '.', '');
		}else if(DataHora::isDate($valor,'/')){
			return DataHora::inverteData($valor);
		}else if ($valor == ''){
			return null;
		}else{
			return  $valor ;
		}
	}

	/*public static function tuuuurataDados($value){
		if (DataHora::isDate($value)){
			$value = DataHora::inverteData($value);
		}else{
			$value = Browser_Control::htmlToString($value);
		}
		return $value;
	}*/



	/**
	 * Converte todos os os caracteres convertidos para html para caracteres normais para mostrar no campos de texto.
	 *
	 * Ex: <br> retorna  &lt br &gt
	 *
	 */
	/*public static function stringToForm($string) {
		if (is_array($string)) {
			foreach ($string as $key => $value) {
				$ret[$key] = FormataDados::htmlToString($value);
			}
		}else{
			$ret = FormataDados::htmlToString($string);
		}

		return $ret;
	}*/



}