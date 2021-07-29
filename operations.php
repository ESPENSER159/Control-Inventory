<?php 
$position = "SELECT * FROM `piso`";
        
$posiciones = mysqli_query($conectar, $position);

$siDatos = mysqli_fetch_assoc($posiciones);


// Redireccionar a el plano donde se crearon las posiciones.
function redirect() {
    $url = str_split($_SERVER["REQUEST_URI"]);

    $newUrl = array();
    for ($i=0; $i < count($url); $i++) { 
        echo '<script>';
        echo 'console.log("Letra > '. $url[$i] .'");';
        echo '</script>';
        
        if($url[$i] != "&"){
            array_push($newUrl, $url[$i]);
        }else{
            break;
        }
    }

    $urlConvert = implode($newUrl);
    
    echo '<script>';
    echo 'console.log("Completo > '. $urlConvert .'");';
    echo 'window.location="'. $urlConvert .'";';
    echo '</script>';
}


// Eliminar Plano
if(isset($_GET['deletePlano'])){
    $nameDelPlano = $_GET['deletePlano'];

    // Eliminar todas las torres y monitores
    $deleteTorreMonitor = "DELETE equipo, monitor FROM (equipo, monitor) inner join piso on equipo.id_piso = piso.id_piso AND monitor.id_piso = piso.id_piso where piso='$nameDelPlano';";

    // Eliminar todas las posiciones
    $deletePositions = "DELETE posicion FROM posicion inner join piso on posicion.id_piso = piso.id_piso where piso='$nameDelPlano';";

    // Eliminar el plano
    $deletePiso = "DELETE FROM piso WHERE piso ='$nameDelPlano';";

    // Ejecutar consultas
    $resultadoDelTorresMonitores = mysqli_query($conectar, $deleteTorreMonitor);
    $resultadoDelPositions = mysqli_query($conectar, $deletePositions);
    $resultadoDelPiso = mysqli_query($conectar, $deletePiso);


    if($resultadoDelTorresMonitores && $resultadoDelPositions && $resultadoDelPiso){
        echo '<script>';
        echo 'window.location="/";';
        echo 'console.log("Se elimino el plano: '.$nameDelPlano.'")';
        echo '</script>';

    } else{
        echo '<script>';
        echo 'alert("No se pudo eliminar el plano: '.$nameDelPlano.'");';
        echo 'window.location="/";';
        echo '</script>';
    }
}


// Agregar solo una posición
if(isset($_GET['nombrePlano'])){
    $nombre = $_GET['nombrePlano'];

    if(isset($_GET['onePosition'])){

        $namePosition = $_GET['onePosition'];

        $consultAllPositions = "SELECT * FROM posicion;";
        $showAllPositions = mysqli_query($conectar, $consultAllPositions);

        $changeID = "SELECT id_pos FROM posicion WHERE posicion='$namePosition' LIMIT 1";

        while($row = mysqli_fetch_assoc($showAllPositions)) {
            if(strtolower($namePosition) == strtolower($row['posicion'])){
                while($row2 = mysqli_fetch_assoc($showAllPositions)) {
            
                    $lastID = $row2['id_pos'];
                    echo '<script>';
                    echo 'console.log("'. $posi .'");';
                    echo '</script>';
                }
            
                $IDtoNumber = intval($lastID) + 1;
                $IDtoLetter = strval($IDtoNumber);
                $changeID = $IDtoLetter;
            }
        }

        // SQL Para agregar posiciones a la Base de Datos.
        // Crear posicion en Tabla Posicion
        $insertPosicion = "INSERT INTO posicion (posicion, id_piso) VALUES ('$namePosition', (SELECT id_piso FROM piso WHERE piso='$nombre'));";

        // Crear valores de CPU asignados a la posicion
        $insertValuesCPU = "INSERT INTO equipo (serial_equipo, placa_equipo, proveedor_e, tipo_e, id_piso, id_campaña, id_pos) VALUES ('', '', '', 'CPU', (SELECT id_piso FROM piso WHERE piso='$nombre'), (SELECT id_campaña FROM campaña WHERE campaña='SIN CAMPAÑA'), ($changeID));";

        // Crear valores de Monitor asignados a la posicion
        $insertValuesMonitor = "INSERT INTO monitor (serial_m, placa_m, proveedor_m, id_piso, id_pos, id_campaña) VALUES ('', '', '', (SELECT id_piso FROM piso WHERE piso='$nombre'), ($changeID), (SELECT id_campaña FROM campaña WHERE campaña='SIN CAMPAÑA'));";
        
        $result1 = mysqli_query($conectar, $insertPosicion);
        $result2 = mysqli_query($conectar, $insertValuesCPU);
        $result3 = mysqli_query($conectar, $insertValuesMonitor);

        if($result1 && $result2 && $result3) {
            
            redirect();

        } else {
            echo '<script>';
            echo 'console.log("No se pudo agregar");';
            echo 'alert("Algo fallo durante la insersión de los datos");';
            echo 'window.location="/";';
            echo '</script>';
        }
    }
}

// Agregar multiples posiciones
if(isset($_GET['nombrePlano'])){
    $namePlano = $_GET['nombrePlano'];

    if(isset($_GET['multiPositionInitial'])){
        $nameNomen = $_GET['nomen'];
        $namePositionInitial = $_GET['multiPositionInitial'];
        $namePositionFinal = $_GET['multiPositionFinal'];

        
        for ($i=$namePositionInitial; $i <= $namePositionFinal; $i++) { 
            $namePosition = $nameNomen . $i;
            
            $consultAllPositions = "SELECT * FROM posicion;";
            $showAllPositions = mysqli_query($conectar, $consultAllPositions);

            $changeID = "SELECT id_pos FROM posicion WHERE posicion='$namePosition' LIMIT 1";

            /*
            while($row = mysqli_fetch_assoc($showAllPositions)) {
                if(strtolower($namePosition) == strtolower($row['posicion'])){
                    while($row2 = mysqli_fetch_assoc($showAllPositions)) {
                        
                        $lastID = $row2['id_pos'];
                        echo '<script>';
                        echo 'console.log("'. $posi .'");';
                        echo '</script>';
                    }
                
                    $IDtoNumber = intval($lastID) + 1;
                    $IDtoLetter = strval($IDtoNumber);
                    $changeID = $IDtoLetter;
                }
            }
            */

            // SQL Para agregar posiciones a la Base de Datos.
            // Crear posicion en Tabla Posicion
            $insertPosicion = "INSERT INTO posicion (posicion, id_piso) VALUES ('$namePosition', (SELECT id_piso FROM piso WHERE piso='$nombre'));";

            // Crear valores de CPU asignados a la posicion
            $insertValuesCPU = "INSERT INTO equipo (serial_equipo, placa_equipo, proveedor_e, tipo_e, id_piso, id_campaña, id_pos) VALUES ('', '', '', 'CPU', (SELECT id_piso FROM piso WHERE piso='$nombre'), (SELECT id_campaña FROM campaña WHERE campaña='SIN CAMPAÑA'), ($changeID));";

            // Crear valores de Monitor asignados a la posicion
            $insertValuesMonitor = "INSERT INTO monitor (serial_m, placa_m, proveedor_m, id_piso, id_pos, id_campaña) VALUES ('', '', '', (SELECT id_piso FROM piso WHERE piso='$nombre'), ($changeID), (SELECT id_campaña FROM campaña WHERE campaña='SIN CAMPAÑA'));";

            $result1 = mysqli_query($conectar, $insertPosicion);
            $result2 = mysqli_query($conectar, $insertValuesCPU);
            $result3 = mysqli_query($conectar, $insertValuesMonitor);

            if($result1 && $result2 && $result3) {

                redirect();
    
            } else {
                echo '<script>';
                echo 'console.log("No se pudo agregar");';
                echo 'alert("Algo fallo durante la insersión de los datos");';
                echo 'window.location="/";';
                echo '</script>';
            }
        }
    }
}


// Eliminar Posición
if(isset($_GET['nombrePlano'])){
    $namePlano = $_GET['nombrePlano'];

    if(isset($_GET['delOnePosition'])){
        $namePosition = $_GET['delOnePosition'];

        // Eliminar todas las torres y monitores
        $deleteTorreMonitor = "DELETE equipo, monitor FROM (equipo, monitor) inner join posicion on equipo.id_pos = posicion.id_pos AND monitor.id_pos = posicion.id_pos where posicion='$namePosition';";

        $eliminarPosicion = "DELETE FROM posicion WHERE posicion='$namePosition';";
        
        // Ejecutar consultas
        $resultadoDelTorresMonitores = mysqli_query($conectar, $deleteTorreMonitor);
        $resultado = mysqli_query($conectar, $eliminarPosicion);

        if($resultado && $resultadoDelTorresMonitores){
            
            redirect();
            
        } else{
            echo '<script>';
            echo 'console.log("No se pudo eliminar la posición");';
            echo 'alert("No se pudo eliminar la posición");';
            echo 'window.location="/";';
            echo '</script>';
        }
    }
}


// Validar si existe algun Plano y Cargar el primer plano.
if(isset($_GET['nombrePlano'])){
    $namePlano = $_GET['nombrePlano'];

    include("loadPlano.php");

} elseif (empty($siDatos)) {
            echo '<script>';
            echo 'console.log("La base esta vacia");';
            echo '</script>';
            ?>
            <div class="noPlano">
                <p>
                    No hay ningún plano creado
                </p>
            </div>
            
<?php } else {

    $namePlano = $siDatos["piso"];

    include("loadPlano.php");
            
} ?>