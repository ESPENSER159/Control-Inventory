<?php

    include("conexion.php");

    $nombrePlano = $_GET["nombrePlano"];

    $insertPlano = "INSERT INTO piso (piso, width, height) VALUES ('$nombrePlano', 20, 20);";

    $crearTable = "CREATE TABLE `$nombrePlano` (
        `id_piso` int(3),
        `posicion` varchar(255),
        `cu` varchar(255),
        `serial` varchar(255)
    );";

    $resultado = mysqli_query($conectar, $insertPlano);

    if($resultado){
        echo '<script>';
        //echo 'alert("Se agrego el plano");';
        echo 'window.location="/Inventory/index.php?nombrePlano='.$nombrePlano.'";';
        echo '</script>';
    } else{
        echo '<script>';
        echo 'alert("No se pudo agregar");';
        echo 'window.location="/";';
        echo '</script>';
    }

?>