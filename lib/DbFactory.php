<?php

class DbFactory{

    const HOST = "localhost";
    const DB_NAME = "tp_news_oc";
    const USERNAME = "root";
    const PASSWORD = "";

    public static function getMySqlConnectionWithPDO(){
        $pdo = new PDO("mysql:host=".self::HOST."; dbname=".self::DB_NAME,self::USERNAME,self::PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function getMySqlConnectionWithMySQLI(){
        return new MySQLi('localhost', 'root', '', 'news');
    }
}

?>