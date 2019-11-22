<?php

class View extends Config{

    private $controller;
    private $method;
    private $params;

    public function __construct($controller="Home",$method=null){
        $this->controller=$controller;
        $this->method=$method;
    }

    public function render(){
        $controller = $this->controller."Controller";
        $view = strtolower($this->controller);
        
        require_once( self::VIEW_PATH.'templates/header.php');

        if($_SESSION['datalogin']['ingreso']){
            require_once( self::VIEW_PATH.'templates/nav-hor.php');
            require_once( self::VIEW_PATH.'templates/nav-vert.php');
        }


        if(file_exists(self::VIEW_PATH.$view.'.php')){
            
            if(file_exists(self::CONTROLLER_PATH.$controller.'.php')){
                $ViewController = new $controller;
                if(isset($this->method)){
                    if(method_exists($ViewController,$this->method)){
                        $ViewController->{$this->method}();
                    }else{
                        echo "<br><br><br><h1>Error no existe el metodo</h1>";
                    }
                }

            }

            require_once( self::VIEW_PATH.$view.'.php');
        }else{
            require_once( self::VIEW_PATH.'404.php');
        }

        require_once( self::VIEW_PATH.'templates/footer.php');
    }

    public function getNameController(){
        return $this->controller;
    }

    public function __destruct(){}
}