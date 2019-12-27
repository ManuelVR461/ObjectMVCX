<?php
require_once './Config.php';
require_once './Functions.php';

$newFunctions = new Functions;

if(!empty($_POST)){
	$data = $_POST['tipo']=='json' ? json_decode($_POST['data'],true) : $_POST['data'];
	$newFunctions->dbg($data,$_POST['archivo']."_".date('Ymd').".log",Config::DEBUG_GN);
	exit($data);
}