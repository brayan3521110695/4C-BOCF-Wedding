<?php 
    class Conexion{
        static public function conectar(){
            $link = new PDO("mysql:host=localhost;port=3306;dbname=4c-BOCF-wedding",  "root", "");
    
            $link->exec("set names utf8");
    
            return $link;
        }
    }
    
?>