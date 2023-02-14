<?php 
    function conectar(){
        $con = new mysqli("localhost", "root", "", "infobdn");
        if (!$con) {
        echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
        exit;}
        $con->set_charset('utf8');
        return $con;
    }
?>