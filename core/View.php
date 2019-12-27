<?php

class View extends Config{

    protected $controller;
    protected $method;
    protected $params;
    protected $via;

    public function __construct($controller="Home",$method=null,$via="nav"){

        $this->controller=$controller;
        $this->method=$method;
        $this->via=$via;
    }

    public function render(){
        $functions = new Functions;
        $functions->dbg("via: ".json_encode($this->via),"view");

        if($this->via=="nav"){
            $this->renderHeader();
            $this->renderContent();
            $this->renderFooter();
        }else{
            $controller = $this->controller."Controller";
            if(file_exists(self::CONTROLLER_PATH.$controller.'.php')){
                $ViewController = new $controller();
                if(isset($this->method)){
                    if(method_exists($ViewController,$this->method)){
                        $ViewController->{$this->method}();
                    }
                }
            }
        }
    }

    private function renderHeader(){
        require_once( self::VIEW_PATH.'templates/header.php');
        if($_SESSION['datalogin']['ingreso']){
            require_once( self::VIEW_PATH.'templates/nav-hor.php');
            require_once( self::VIEW_PATH.'templates/nav-vert.php');
        }
    }

    private function renderFooter(){
        require_once( self::VIEW_PATH.'templates/footer.php');
    }

    public function renderContent(){
        $functions = new Functions;
        $controller = $this->controller."Controller";
        $view = strtolower($this->controller);
        
        if(file_exists(self::VIEW_PATH.$view.'.php')){
            $functions->dbg("existe view: ".self::VIEW_PATH.$view.'.php',"View");
            if(file_exists(self::CONTROLLER_PATH.$controller.'.php')){
                $functions->dbg("28 existe controller: ".self::CONTROLLER_PATH.$controller.'.php',"View");
                $ViewController = new $controller();
                $functions->dbg("30 comprobar si existe metodo:  ".$this->method.'.php',"View");
                if(isset($this->method)){
                    $functions->dbg("38 existe metodo: ".$this->method,"View");
                    if(method_exists($ViewController,$this->method)){

                        $functions->dbg("43 existe controlador y metodo entonces cargo el objeto ","View");
                        $ViewController->{$this->method}();

                    }else{
                        echo "<br><br><br><h1>Error no existe el metodo</h1>";
                    }

                }else{
                    $functions->dbg("51 no existe metodo: ".$this->method.'.php',"View");
                    require_once( self::VIEW_PATH.$view.'.php');
                }



            }else{
                 $functions->dbg("55 no existe controller: ".self::CONTROLLER_PATH.$controller.'.php',"View");
                 require_once(self::VIEW_PATH.$view.'.php');
            }


        }else{
            require_once( self::VIEW_PATH.'404.php');
        }
    }

    public function viewList($control_list,$datos=array()){
        $functions = new Functions;
        if(file_exists(self::LIST_PATH.$control_list.'List.php')){
            $uri_list = self::LIST_PATH.$control_list."List.php";
            if(is_file($uri_list)){
                ob_start();
                include $uri_list;
                $table = ob_get_clean();
            }
            return $table;
        }else{
            return "<h1>No Existe una Lista Asociada a este controlador!</h1>";
        }
    }

    public function __get( string $var ){
        return $this->$var;
    }

}