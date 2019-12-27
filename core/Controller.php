  
<?php
class Controller extends Config{
    protected $functions;

    public function __construct(){
        parent::__construct();
        $this->functions = new Functions; 
    }
    
    public function __set( string $var, $val ){
        $this->$var = $val;
    }
    
    public function __get( string $var ){
        return $this->$var;
    }
    
    // public function __toString(){
    //     return "nombre del controller";
    // }
    
    function is_post(){
        $this->functions->dbg("datos post ".json_encode($_SERVER["REQUEST_METHOD"]),"Controller");
        return ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST) && !empty($_POST));
    }
    function is_get(){
        $this->functions->dbg("datos post ".json_encode($_SERVER["REQUEST_METHOD"]),"Controller");
        return ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET) && !empty($_GET));
    }

}