<?php
class Router{
    public $router = array();
    public $controller;
    public $method;
    public $via="nav";

    public function __construct(){
        $functions = new Functions;

        $session_options= array('use_only_cookies'=>1,'read_and_close'=>true,'session.auto_start'=>1);
        if(!isset($_SESSION))  session_start($session_options);
        if(!isset($_SESSION['datalogin']['ingreso']))  $_SESSION['datalogin']['ingreso']=false;

        if ( $_SESSION['datalogin']['ingreso']) {

            //si esta autenticado

            $url = (isset($_GET['url']))?$_GET['url']:'Home';
            $this->router = explode('/',$url);

            $functions->dbg("Router: ".json_encode($this->router),"Router");

            if(isset($this->router[0])){
                $this->controller = $this->router[0];
            }

            if(isset($this->router[1])){
                if($this->router[1]!=''){
                    $this->method = $this->router[1];
                }
            }

            if(isset($this->router[2])){
                if($this->router[2]!=''){
                    $this->via = $this->router[2];
                }
            }
            
            $views = new View($this->controller,$this->method,$this->via);
                        
            if($this->router[0] !='logout'){                
                $views->render();
            }else{
                $user_session = new SessionController;
                $user_session->logout();
                header('Location: ./');
            }
            
        }else{
            $functions->dbg("Router: 51 ingreso ". $_SESSION['datalogin']['ingreso'],"Router");
            if(!isset($_POST['user']) && !isset($_POST['pwd'])){
                $login_form = new View('login');
                $login_form->render();

            }else{

                $user_session = new SessionController;
                $session = $user_session->login($_POST['user'],$_POST['pwd']);
                if(empty($session)){
                    $login_form = new View('login');
                    $login_form->render();
                    header('Location: ./?error=El usuario '.$_POST['user'].' y el password son incorrectos');
                }else{
                    $_SESSION['datalogin'] = $session;
                    //echo json_encode((object) $session);
                    header('Location: ./');
                }
            }
            
        }
    }


    public function __destruct(){
     
    }
}