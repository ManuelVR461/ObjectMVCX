<?php
class Config{
	

    const APP_NAME="ObjectMVCX"; //Nombre del Proyecto
    const APP_TITLE="Simple Framework MVC"; //titulo del Proyecto
    const DRIVER_DB = "PDO"; //Driver de conexion con base de Datos //PDO,MYSQL,POSTGRESS,SQLSERVER,SQLITE
    const DB_NAME="ObjectMVCX"
    const USER = "root"; //Usuario de Base de Datos
    const PASS = ""; //Password de Base de Datos
    const SECRET_KEY='CentralOnline@2019'; //Clave Secreta de Encryptcion
    const SECRET_IV='123456'; //Clave Publica de Desencryptacion

    const DEBUG_GN=1;//1:activado,0:Desactivado Log de errores Generales
    const DEBUG_DB=1;//1:activado,0:Desactivado Log de Errores Base de Datos

    const SERVER ="localhost";
    const CHARSET = "utf8";
    const URL = "http://".self::SERVER."/".APP_NAME."/";

    const SGBD = "mysql:host=".self::SERVER.";dbname=".self::DB.";charset=".self::CHARSET;
    const METHOD="AES-256-CBC";
    
    
    public function __construct(){
        date_default_timezone_set('America/Santiago');
        
    }
    
}