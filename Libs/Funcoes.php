<?php
class Funcoes
{
	/**
	 * Exporta uma relatorio para o excel
	 * o parametro passado deve ser uma tabela com os dados
	 */
	public static function exportToExcel($data){
		header('Content-type: application/vnd.ms-excel; charset=utf-8');
		header('Content-type: application/force-download');
		header('Content-Disposition: attachment; filename=relatorio.xls');
		header('Pragma: no-cache');
		echo $data;
		exit;
	}
	function LogSystem($Msg){

	}
}