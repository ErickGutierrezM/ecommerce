<?php

class Conexion {
  static public function conectar(){
        $link  = new PDO("mysql:host=localhost; dbname=andamio8_ecommerce", "andamio8_admin", "AES%2021#F", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8") );
    
        return $link;
    }
}