<?php

namespace OCForm;

session_start();

class User{

    public function getAttribute(){return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;}

    public function getFlash(){
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }

    public function hasFlash(){
        return isset($_SESSION['flash']);
    }

    public function isAuthentificated(){
        return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
    }

    public function setAttribute($atrr, $value){
        $_SESSION[$attr] = $value;
    }

    public function setAuthentificated($authentificated = true){
        if(!is_bool($authentificated)){
            throw new \InvalidArgumentException('Oooops, Please add a boolean value');
        }
        $_SESSION['auth'] = $authentificated;
    }

    public function setFlash($value){
        $_SESSION['flash'] = $value;
    }
    
}

?>