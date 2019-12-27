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


    /** Extrae las llaves de un arreglo como una string separado por coma.
	* @param Array $data		Arreglo de Datos.
	* @return String        Cadena separada por coma
    */
    public function getKeysArray($data){
        return implode(',',array_keys($data));
    }

    /** combina los arrays de datos y where para las sentencias preparadas
	* @param Array $data		Arreglo de Datos.
	* @return array        arrays combinados
    */
    public function combineArrays($data,$where){
        return array_merge($data,$where);
    }


    /** Extrae las llaves de un arreglo como una string separado por coma y : para sentencias preparadas.
	* @param Array $data		Arreglo de Datos.
	* @return String        Cadena separada por coma y dos puntos
    */
    public function getKeysArrayPDO($data){
        $campos = implode(',',array_keys($data));
        $campos = str_replace(",",",:",$campos);
        return ":".$campos;
    }

    /** actualiza los datos del arregle con :llave para sentencias preparadas.
	* @param Array $data		Arreglo de Datos.
	* @return Array        Arreglo con :llaves
    */
    public function getFormatDataPDO($data){
        foreach ($data as $key => $value) {
            $dataout[":".$key]=$value;
        }
        return $dataout;
    }

    /** Estrae las llaves de un arreglo formateandola llave=:llave para actualizaciones 
    * con Sentencias preparadas
	* @param Array $data		Arreglo de Datos.
	* @return String Cadena con llave=:llave,
    */
    public function getUpdateWhereDataPDO($data){
        foreach ($data as $key => $value) {
            $part[]=$key."=:".$key;
        }
        return implode(',',array_values($part));
    }

    /** Relaciona el campo de la tabla con el formulario
	* @param Array $data	Datos extraidos de la consulta sql
	* @return Array $combine_array
	*/
    protected function relationSchemaFormData($data,$schema){
        $formText = $schema;
        $array_flip = array_flip($formText);
        foreach ($array_flip as $key => $value) {
            if(array_key_exists($value,$data)){
                $combine_array[$key]=$data[$value];
            }
        }
        return $combine_array;
    }

    /** Ejecuta una consulta y devuelve UN SOLO resultado.
	* @param String $sql		Texto de la consulta.
	* @return Array $result
	*
	*/
	public function select($sql,$where = array()){
        $ti = microtime(true);
        $res = $this->cnx->prepare($sql);
        $res->execute($where);
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $res->closeCursor();
        $tf = microtime(true);
		self::_log($ti,$tf,$sql,$row);
		return $row;
    }

    /** Ejecuta una consulta y devuelve TODOS los resultados.
	* @param String $sql		Texto de la consulta.
	* @return Array $result
	*
	*/
	public function selectAll($sql,$where = array()){
        $ti = microtime(true);
        $res = $this->cnx->prepare($sql);
        $res->execute($where);
        $row = $res->fetchALL(PDO::FETCH_ASSOC);
        $res->closeCursor();
		$tf = microtime(true);
		self::_log($ti,$tf,$sql,$row);
		return $row;
    }

    /** reaiza una insercion y decuelve el ultimo id generado
	* @param String $sql		Texto de la consulta.
	* @return Int $lastid Ultimo id generado
	*
	*/
	public function insert($sql,$data){
        try {
            $ti = microtime(true);
            $res = $this->cnx->prepare($sql);
            $res->execute($data);
            $res->closeCursor();
            $lastid = $this->cnx->lastInsertId();
            $tf = microtime(true);
            self::_log($ti,$tf,$sql,"Id: ".$lastid);
            return $lastid;
        } catch(PDOExecption $e) {
            self::_log($ti,$tf,$sql,$sql,$e->getMessage());
            return false;
        }
    }

    /** actualiza un campo y devuelve el numero de filas afectadas
	* @param String $sql		Texto de la consulta.
	* @return Array $result
	*
	*/
	public function update($sql,$where = array()){
        $ti = microtime(true);
        $res = $this->cnx->prepare($sql);
        $res->execute($where);
        $rowcount = $res->rowCount();
        $res->closeCursor();
        $tf = microtime(true);
		self::_log($ti,$tf,$sql,"actualizados ". $rowcount);
		return $rowcount;
    }


    /** elimina un campo y devuelve el numero de filas afectadas
	* @param String $sql		Texto de la consulta.
	* @return Array $result
	*
	*/
	public function delete($sql,$where = array()){
        $ti = microtime(true);
        $res = $this->cnx->prepare($sql);
        $res->execute($where);
        $rowcount = $res->rowCount();
        $res->closeCursor();
        $tf = microtime(true);
		self::_log($ti,$tf,$sql,"Eliminados ". $rowcount);
		return $rowcount;
    }
    
    /**
	* Graba log con datos de tiempo de ejecución de consulta
	* @param string	$consulta	sentencia SQL ejecutada
	* @param arry	$resultado	resultado de la sentencia ejecutada
	* @param int	$ti			tiempo en microsegundos antes de ejecutar la consulta
	* @param int	$tf			tiempo en microsegundos después de ejecutar la consulta
	*/
	private static function _log($ti=0,$tf=0,$consulta='',$resultado=null){
        $funtions = new Functions;
		$sep = '||';
		$str = parent::URL.$sep.round($tf-$ti,2).$sep.$consulta.$sep.json_encode($resultado);
		$funtions->dbg($str,'debug_db_',parent::DEBUG_DB);
    }
    
}