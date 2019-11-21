<?php
class SessionController{
    private $session;
    public function __construct(){
        $this->session = new UsersModel;
    }
    public function login($user,$pwd){
        $data = $this->session->get_user_login($user,$pwd);
        
        if(!empty($data)){
            if($data['status']=="D"){
                echo "Usuario Bloqueado";
            }else{
                return array("usuario"=>$data['usuario'],
                             "nombres"=>$data['nombres'],
                             "email"=>$data['email'],
                             "avatar"=>$data['avatar'],
                             "cargo"=>$data['idperfil'],
                             "accesos"=>$data['accesos'],
                             "fechaingreso"=>$data['fecha'],
                             "ingreso"=>TRUE);
            }
        }else{
            echo "datos ya existentes ";
            print_r($data);
        }
        return $data;
    }
    public function logout(){
        session_start();
        session_destroy();
    }
    public function __destruct(){
         
    }
}