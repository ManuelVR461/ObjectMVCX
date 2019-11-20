<?php
class Model extends Config {
    protected $cnx;
    protected $sql;
    protected $rows = array();
        
    public function __construct(){
        parent::__construct();
        $this->cnx = $this->conexion();
    }
    /**
     * Metodo protegido para la abrir la base de datos
     *
     * @return void
     */
    protected function conexion(){
        try {
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => FALSE,
            ];
            return new PDO(parent::SGBD,parent::USER,parent::PASS,$options);
        } catch (PDOException $e) {
            echo "Error: ".$e;
            die();
        }
    }
    /**
     * encrypter
     * Funcion para Encryptar las claves de Accesos
     * 
     * @param  mixed $string
     * @return void
     */
    protected static function encrypter($string){
        $output=FALSE;
        $key=hash('sha256', parent::SECRET_KEY);
        $iv=substr(hash('sha256', parent::SECRET_IV), 0, 16);
        $output=openssl_encrypt($string, parent::METHOD, $key, 0, $iv);
        $output=base64_encode($output);
        return $output;
    }
    
    /**
     * decryption
     * Funcion para Desencryptar las claves de accesos
     * @param  mixed $string
     *
     * @return void
     */
    protected static function decryption($string){
        $key=hash('sha256', parent::SECRET_KEY);
        $iv=substr(hash('sha256', parent::SECRET_IV), 0, 16);
        $output=openssl_decrypt(base64_decode($string), parent::METHOD, $key, 0, $iv);
        return $output;
    }
}