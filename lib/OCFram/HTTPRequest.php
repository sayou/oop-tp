<?php

namespace OCFream;

class HTTPRequest{

    public function cookieDate($key){
        return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
    }

    public function cookieExists($key){
        return isset($_COOKIE[$key]);
    }

    public function getData($key){
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }

    public function getExiste($key){
        return isset($_GET[$key]);
    }

    public function method(){
        return $_SERVER['REQUEST_METHOD'];
    }

    public function postData($string){
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }

    public function postExists($string){
        return isset($_POST[$key]);
    }

    public function requestURI(){
        return $_SERVER['REQUEST_URI'];
    }
}

?>