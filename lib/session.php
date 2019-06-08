<?php 
// Session class
class Session{
    public static function init(){
        session_start();
    }

    public static function set($key, $val){
        $_SESSION[$key] = $val;
    } 

    public static function get($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }else{
            return false;
        }
    } 

    public static function checkSession(){
        self::init(); //start sessions
        if (self::get("adminlogin") == false) { //in 'adminlogin.php' -> Session::set("adminlogin", true); wordt de waarde op true gezet nadat we correct inloggen. We willen dit reversen bij een logout
            self::destroy();
            header("Location: login.php");
        }
    }

    //als we incorrecte data ingeven in de login wordt de login refreshed met een boodschap van foute data
    //we includen deze method ook in de header zodat niet-ingelogde persoon nooit iets kan zien van admin
    public static function checkLogin(){
        self::init();
        if (self::get("adminlogin") == true) {
            header("Location: dashboard.php");
        }
    }

    // hiermee wordt je teruggestuurd naar de login page
    public static function destroy(){
        session_destroy();
        header("Location:../index.php");
    }

    //test -indien het werkt commentaar weg
    public static function destroyUser(){
        session_destroy();
        header("Location:index.php");
    }

}


?>