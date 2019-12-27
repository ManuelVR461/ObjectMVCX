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

	public function dbg($contenido, $archivo = '', $debug = 1) {
		if ($debug > 0) {
			$no = array('\\', '/', ':', '*', '?', '"', '<', '>', '|', 'exe', 'sh', 'bat', 'cmd', 'php', 'py', 'perl', 'pl'); //caracteres prohibidos como nombre de archivo, nunca se sabe..
			$session_id = session_id();
			$id_archivo = empty($session_id) ? '' : ' ' . $session_id;
			$archivo = empty($archivo) ? 'debug_' . date('Ymd') . '.log' : $archivo.'_'.date('Ymd').'.log';
			$archivo = str_replace($no, '_', $archivo);
			$stamp = Config::APP_VERSION . ' [' . date('Y-m-d H:i:s') . $id_archivo . "] ";
			if (gettype($contenido) == 'array' || is_object($contenido)) {
				$contenido = "\n" . print_r($contenido, 1);
			} else {
				$contenido = trim($contenido);
			}
			if(is_dir(Config::LOGS_PATH)){
				$dir = Config::LOGS_PATH;
			}else{
				$dir = "../".Config::LOGS_PATH;
			}
			error_log($stamp . $contenido . "\n", 3, $dir . $archivo);
		}
	}

}