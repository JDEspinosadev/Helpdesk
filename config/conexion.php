<?php

if (session_status() == PHP_SESSION_NONE){
    session_start();
}


class Conectar {
    protected $dbh;

    protected function Conexion(){
        try{
            
        $conectar = $this->dbh = new PDO(
            "mysql:host=localhost;dbname=helpdesk",
            "root",
            "",
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ]
        );

        return $conectar;

    } catch (PDOException $e){

        print "¡Error de conexión!: " . $e->getMessage() . "<br/>";
        die();
    }
}

    public static function ruta(){
        return "http://localhost:80/Helpdesk/";
    }
}
?>