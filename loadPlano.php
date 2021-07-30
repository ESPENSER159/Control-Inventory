<?php

$plano = "SELECT piso, posicion FROM piso INNER JOIN posicion ON piso.id_piso = posicion.id_piso WHERE piso='{$namePlano}'";
$pisosQuery = "SELECT * FROM piso;";

$positions = mysqli_query($conectar, $plano);
$pisosQueryResult = mysqli_query($conectar, $pisosQuery);
?>
<div class="titlePlano"><?php echo $namePlano ?></div>

<div class="setPositions">

<script>
    let positions = [];
    let planos = [];
</script>

<?php
while($row3 = mysqli_fetch_assoc($pisosQueryResult)) {
    echo '<script>';
    echo 'planos.push("'.$row3["piso"].'");';
    echo '</script>';
}

$autoincrement = 0;
while($row = mysqli_fetch_assoc($positions)){
    ?><div class="position tooltipPosition"> <?php echo $row["posicion"];
    $autoincrement++;
    ?>

    <script>
        positions.push("<?php echo $row["posicion"];?>");
    </script>

    <div class="showToolTip <?php echo "toolTipNum".$autoincrement;?>">
        <svg x="0" y="0" viewBox="0 0 512 512" >
            <g>
                <path xmlns="http://www.w3.org/2000/svg" d="m188 492c0 11.046875-8.953125 20-20 20h-88c-44.113281 0-80-35.886719-80-80v-352c0-44.113281 35.886719-80 80-80h245.890625c44.109375 0 80 35.886719 80 80v191c0 11.046875-8.957031 20-20 20-11.046875 0-20-8.953125-20-20v-191c0-22.054688-17.945313-40-40-40h-245.890625c-22.054688 0-40 17.945312-40 40v352c0 22.054688 17.945312 40 40 40h88c11.046875 0 20 8.953125 20 20zm117.890625-372h-206c-11.046875 0-20 8.953125-20 20s8.953125 20 20 20h206c11.042969 0 20-8.953125 20-20s-8.957031-20-20-20zm20 100c0-11.046875-8.957031-20-20-20h-206c-11.046875 0-20 8.953125-20 20s8.953125 20 20 20h206c11.042969 0 20-8.953125 20-20zm-226 60c-11.046875 0-20 8.953125-20 20s8.953125 20 20 20h105.109375c11.046875 0 20-8.953125 20-20s-8.953125-20-20-20zm355.472656 146.496094c-.703125 1.003906-3.113281 4.414062-4.609375 6.300781-6.699218 8.425781-22.378906 28.148437-44.195312 45.558594-27.972656 22.324219-56.757813 33.644531-85.558594 33.644531s-57.585938-11.320312-85.558594-33.644531c-21.816406-17.410157-37.496094-37.136719-44.191406-45.558594-1.5-1.886719-3.910156-5.300781-4.613281-6.300781-4.847657-6.898438-4.847657-16.097656 0-22.996094.703125-1 3.113281-4.414062 4.613281-6.300781 6.695312-8.421875 22.375-28.144531 44.191406-45.554688 27.972656-22.324219 56.757813-33.644531 85.558594-33.644531s57.585938 11.320312 85.558594 33.644531c21.816406 17.410157 37.496094 37.136719 44.191406 45.558594 1.5 1.886719 3.910156 5.300781 4.613281 6.300781 4.847657 6.898438 4.847657 16.09375 0 22.992188zm-41.71875-11.496094c-31.800781-37.832031-62.9375-57-92.644531-57-29.703125 0-60.84375 19.164062-92.644531 57 31.800781 37.832031 62.9375 57 92.644531 57s60.84375-19.164062 92.644531-57zm-91.644531-38c-20.988281 0-38 17.011719-38 38s17.011719 38 38 38 38-17.011719 38-38-17.011719-38-38-38zm0 0" fill="#ffffff"/>
            </g>
        </svg>
    </div>

    <span class="tooltipBoxPosition <?php echo "tooltipBoxPosition".$autoincrement;?>">

        <?php
        $consultPC = "SELECT * FROM (equipo, monitor, piso) inner join posicion on equipo.id_pos = posicion.id_pos AND monitor.id_pos = posicion.id_pos AND piso.id_piso = posicion.id_piso where posicion='{$row['posicion']}' AND piso='{$namePlano}';";

        $cuSerial = mysqli_query($conectar, $consultPC);
        $cont = 0;
        while($row2 = mysqli_fetch_assoc($cuSerial)){

            if(strlen($row2["placa_equipo"]) != 0) {
                ?>
                <div class="logoEdit">Edit</div>

                <p class="titleType">Torre</p>
                <p>CU:</p>
                <div class="contentInputsValues">
                    <input id="<?php if($row2['placa_equipo'] == 'VACIO'){echo 'VACIO-Torre-cu-'.$autoincrement;}else{echo $row2['placa_equipo'];}; ?>" class="inputsCUSerial" title="cu" type="text" name="TorreCU" value="<?php echo $row2["placa_equipo"];?>" readonly>

                    <div class="buttonCopy" onclick="showNotification('<?php if($row2['placa_equipo'] == 'VACIO'){echo 'VACIO-Torre-cu-'.$autoincrement;}else{echo $row2['placa_equipo'];}; ?>')">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M314.25,85.4h-227c-21.3,0-38.6,17.3-38.6,38.6v325.7c0,21.3,17.3,38.6,38.6,38.6h227c21.3,0,38.6-17.3,38.6-38.6V124
                                    C352.75,102.7,335.45,85.4,314.25,85.4z M325.75,449.6c0,6.4-5.2,11.6-11.6,11.6h-227c-6.4,0-11.6-5.2-11.6-11.6V124
                                    c0-6.4,5.2-11.6,11.6-11.6h227c6.4,0,11.6,5.2,11.6,11.6V449.6z"/>
                                <path d="M401.05,0h-227c-21.3,0-38.6,17.3-38.6,38.6c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5c0-6.4,5.2-11.6,11.6-11.6h227
                                    c6.4,0,11.6,5.2,11.6,11.6v325.7c0,6.4-5.2,11.6-11.6,11.6c-7.5,0-13.5,6-13.5,13.5s6,13.5,13.5,13.5c21.3,0,38.6-17.3,38.6-38.6
                                    V38.6C439.65,17.3,422.35,0,401.05,0z"/>
                            </g>
                        </svg>
                    </div>

                </div>
                <p>Serial:</p>
                <div class="contentInputsValues">
                    <input id="<?php if($row2['serial_equipo'] == 'VACIO'){echo 'VACIO-Torre-Serial-'.$autoincrement;}else{echo $row2['serial_equipo'];}; ?>" class="inputsCUSerial" title="serial" type="text" name="TorreCU" value="<?php echo $row2["serial_equipo"];?>" readonly>

                    <div class="buttonCopy" onclick="showNotification('<?php if($row2['serial_equipo'] == 'VACIO'){echo 'VACIO-Torre-Serial-'.$autoincrement;}else{echo $row2['serial_equipo'];}; ?>')">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M314.25,85.4h-227c-21.3,0-38.6,17.3-38.6,38.6v325.7c0,21.3,17.3,38.6,38.6,38.6h227c21.3,0,38.6-17.3,38.6-38.6V124
                                    C352.75,102.7,335.45,85.4,314.25,85.4z M325.75,449.6c0,6.4-5.2,11.6-11.6,11.6h-227c-6.4,0-11.6-5.2-11.6-11.6V124
                                    c0-6.4,5.2-11.6,11.6-11.6h227c6.4,0,11.6,5.2,11.6,11.6V449.6z"/>
                                <path d="M401.05,0h-227c-21.3,0-38.6,17.3-38.6,38.6c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5c0-6.4,5.2-11.6,11.6-11.6h227
                                    c6.4,0,11.6,5.2,11.6,11.6v325.7c0,6.4-5.2,11.6-11.6,11.6c-7.5,0-13.5,6-13.5,13.5s6,13.5,13.5,13.5c21.3,0,38.6-17.3,38.6-38.6
                                    V38.6C439.65,17.3,422.35,0,401.05,0z"/>
                            </g>
                        </svg>
                    </div>

                </div>
                <br><br>

                <p class="titleType">Monitor</p>
                <p>CU:</p>
                <div class="contentInputsValues">
                    <input id="<?php if($row2['placa_m'] == 'VACIO'){echo 'VACIO-Moni-cu-'.$autoincrement;}else{echo $row2['placa_m'];}; ?>" class="inputsCUSerial" title="cu" type="text" name="TorreCU" value="<?php echo $row2["placa_m"];?>" readonly>

                    <div class="buttonCopy" onclick="showNotification('<?php if($row2['placa_m'] == 'VACIO'){echo 'VACIO-Moni-cu-'.$autoincrement;}else{echo $row2['placa_m'];}; ?>')">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M314.25,85.4h-227c-21.3,0-38.6,17.3-38.6,38.6v325.7c0,21.3,17.3,38.6,38.6,38.6h227c21.3,0,38.6-17.3,38.6-38.6V124
                                    C352.75,102.7,335.45,85.4,314.25,85.4z M325.75,449.6c0,6.4-5.2,11.6-11.6,11.6h-227c-6.4,0-11.6-5.2-11.6-11.6V124
                                    c0-6.4,5.2-11.6,11.6-11.6h227c6.4,0,11.6,5.2,11.6,11.6V449.6z"/>
                                <path d="M401.05,0h-227c-21.3,0-38.6,17.3-38.6,38.6c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5c0-6.4,5.2-11.6,11.6-11.6h227
                                    c6.4,0,11.6,5.2,11.6,11.6v325.7c0,6.4-5.2,11.6-11.6,11.6c-7.5,0-13.5,6-13.5,13.5s6,13.5,13.5,13.5c21.3,0,38.6-17.3,38.6-38.6
                                    V38.6C439.65,17.3,422.35,0,401.05,0z"/>
                            </g>
                        </svg>
                    </div>

                </div>
                
                <p>Serial:</p>
                <div class="contentInputsValues">
                    <input id="<?php if($row2['serial_m'] == 'VACIO'){echo 'VACIO-Moni-Serial-'.$autoincrement;}else{echo $row2['serial_m'];}; ?>" class="inputsCUSerial" title="serial" type="text" name="TorreCU" value="<?php echo $row2["serial_m"];?>" readonly>

                    <div class="buttonCopy" onclick="showNotification('<?php if($row2['serial_m'] == 'VACIO'){echo 'VACIO-Moni-Serial-'.$autoincrement;}else{echo $row2['serial_m'];}; ?>')">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M314.25,85.4h-227c-21.3,0-38.6,17.3-38.6,38.6v325.7c0,21.3,17.3,38.6,38.6,38.6h227c21.3,0,38.6-17.3,38.6-38.6V124
                                    C352.75,102.7,335.45,85.4,314.25,85.4z M325.75,449.6c0,6.4-5.2,11.6-11.6,11.6h-227c-6.4,0-11.6-5.2-11.6-11.6V124
                                    c0-6.4,5.2-11.6,11.6-11.6h227c6.4,0,11.6,5.2,11.6,11.6V449.6z"/>
                                <path d="M401.05,0h-227c-21.3,0-38.6,17.3-38.6,38.6c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5c0-6.4,5.2-11.6,11.6-11.6h227
                                    c6.4,0,11.6,5.2,11.6,11.6v325.7c0,6.4-5.2,11.6-11.6,11.6c-7.5,0-13.5,6-13.5,13.5s6,13.5,13.5,13.5c21.3,0,38.6-17.3,38.6-38.6
                                    V38.6C439.65,17.3,422.35,0,401.05,0z"/>
                            </g>
                        </svg>
                    </div>

                </div>

                <input type="submit" class="myButton modifyPositionValues" value="Guardar">

                <br><br>
            <?php } else {?>
                <div>Posicion Vacia</div>
            <? } ?>
        <?php } ?>
    <?php } ?>
    </span>
    </div>
    <?php
        echo "<script type='text/javascript'>";

        echo "const icono".$autoincrement." = document.querySelector('.toolTipNum".$autoincrement."');";

        echo "const tooltip".$autoincrement." = document.querySelector('.tooltipBoxPosition".$autoincrement."');";

        echo "icono".$autoincrement.".addEventListener('click', () =>{
                tooltip".$autoincrement.".classList.add('activo');
            });";

        echo "let timer".$autoincrement.";";

        echo "icono".$autoincrement.".addEventListener('mouseleave', () =>{
                timer".$autoincrement." = setTimeout(() => {
                    tooltip".$autoincrement.".classList.remove('activo');
                }, 500);
            });";


        echo "tooltip".$autoincrement.".addEventListener('mouseenter', () => clearTimeout(timer".$autoincrement."));";

        echo "tooltip".$autoincrement.".addEventListener('mouseleave', () => {
                timer".$autoincrement." = setTimeout(() => {
                    tooltip".$autoincrement.".classList.remove('activ')
                }, 1000);
            });";

        echo "</script>";
        ?>
<?php }; ?>
</div>