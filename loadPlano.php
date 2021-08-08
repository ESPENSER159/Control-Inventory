<?php
///////////////////////////////////
// Crear tabla segun tamaño deseado
function createTable($width, $height) {
?>
    <style>
        #positions {
            width: <?php echo ($width * 100).'px' ?>;
            height: <?php echo ($height * 100).'px' ?>;
        }
    </style>
<?php
    for ($fila=1; $fila <= $height; $fila++) {
?>
    <tr id="<?php echo 'F'.$fila ?>">
<?php
        for ($columna=1; $columna <= $width; $columna++) { 
?>
            <td id="<?php echo 'C'.$columna.'-F'.$fila ?>" class="position">
<?php
                echo 'C: '.$columna;
                echo '<br>';
                echo 'F: '.$fila
?>
            </td>
<?php
        }
?>
    </tr>
<?php
    }
}
///////////////////////////////////
?>

<?php
///////////////////////////////////
// Realizar consulta del piso y su tamaño
$plano = "SELECT piso, posicion FROM piso INNER JOIN posicion ON piso.id_piso = posicion.id_piso WHERE piso='{$namePlano}'";
$pisosQuery = "SELECT width, height FROM piso WHERE piso='{$namePlano}'";

$positions = mysqli_query($conectar, $plano);
$pisosQueryResult = mysqli_query($conectar, $pisosQuery);
?>
<div class="titlePlano"><?php echo $namePlano ?></div>

<?php
$largo = 0;
$alto = 0;

while($row = mysqli_fetch_assoc($pisosQueryResult)) {
    $largo = $row["width"];
    $alto = $row["height"];
}
///////////////////////////////////
?>
</div>


<?php
///////////////////////////////////
//Mostrar tabla creada
?>
<section id="positions">
    <table>
<?php
        createTable($largo, $alto);
?>
    </table>
</section>
<?php
///////////////////////////////////
?>