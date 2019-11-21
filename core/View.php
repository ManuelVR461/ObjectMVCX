<?php
class View{
    private static $view_path = './views/';
    public function __construct(){}
    public function render($view){
        require_once( self::$view_path.'templates/header.php');
        if($_SESSION['datalogin']['ingreso']){
            require_once( self::$view_path.'templates/nav-hor.php');
            require_once( self::$view_path.'templates/nav-vert.php');
        }
        require_once( self::$view_path.$view.'.php');
        require_once( self::$view_path.'templates/footer.php');
    }
    public function __destruct(){}
}