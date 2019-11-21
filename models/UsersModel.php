<?php
class UsersModel extends Model {
    public function __construct(){
        parent::__construct();
    }
    public function get_user_login($user,$pwd){
        try {
            //$pwd = Model::encrypter($pwd);
            $this->sql = "SELECT u.usuario,u.nombres,u.email,u.idperfil,u.fecha,u.avatar,u.accesos,u.status "
                       . "FROM usuarios u INNER JOIN perfiles p ON p.id=u.idperfil "
                       . "AND u.usuario =:usuario AND u.pwd=:pwd LIMIT 1";
            $res = $this->cnx->prepare($this->sql);
            $res->execute([
                'usuario'=>$user,
                'pwd'=>$pwd
            ]);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $res->closeCursor();
            $this->cnx = NULL;
            return $row;
        } catch (PDOException $e) {
            echo "Error: ".$e;
            return array();
        }
        
    }
    public function __destruct(){
    }
}