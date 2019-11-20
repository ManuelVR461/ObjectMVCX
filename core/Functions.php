<?php

class Functions{
	public function __construct(){

	}

	/**
	* Funcion que valida que una fecha dada sea correcta
	*
	* @param String $fecha Fecha en formato aaaa-mm-dd
	* @return Boolean
	*/
	public static function validaDate($fecha){
		$d = $m = $a = '';
		list($d, $m, $a) = explode('-', $fecha);
		if(empty($d) || empty($m) || empty($a) || strlen($a)!= 4)return false;
		return checkdate($m, $d, $a);
	}

}