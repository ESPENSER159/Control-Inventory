<?php

    $user = "root";
    $pass = "toor";
    $server = "localhost";
    $db = "inventario";
    $conectar = mysqli_connect($server, $user, $pass, $db);

    if(!$conectar){
        echo '<script>';
        echo 'console.log("Error en conectar a la base de datos");';
        echo '</script>';
    } else{
        echo '<script>';
        echo 'console.log("Conectado");';
        echo '</script>';
    }

?>