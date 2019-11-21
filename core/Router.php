<?php
class Router{
    public $route;

    public function __construct($route){

        $session_options= array('use_only_cookies'=>1,'read_and_close'=>true,'session.auto_start'=>1);
        if(!isset($_SESSION))  session_start($session_options);
        if(!isset($_SESSION['datalogin']['ingreso']))  $_SESSION['datalogin']['ingreso']=false;

        if ( $_SESSION['datalogin']['ingreso']) {

            //si esta autenticado

            $this->route = (isset($_GET['url']))?$_GET['url']:'Home';
            $controller = new View;
            if($this->route !='logout'){
                
                $controller->render($this->route);
            }else{
                
                $user_session = new SessionController;
                $user_session->logout();
                header('Location: ./');
            }
            
        }else{

            if(!isset($_POST['user']) && !isset($_POST['pwd'])){
                $login_form = new View;
                $login_form->render('login');

            }else{

                $user_session = new SessionController;
                $session = $user_session->login($_POST['user'],$_POST['pwd']);
                if(empty($session)){
                    $login_form = new View;
                    $login_form->render('login');
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
        //unset($this);
    }
}