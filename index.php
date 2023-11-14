<?php

$mysqli = new mysqli('localhost', 'root', 'jacinto');
$sql = "SELECT id FROM usuarios";

if ($mysqli->connect_errno){
    echo "error: Fallo al conectarse a Mysql";
    echo "Error: " . $mysqli->connect_errno . $mysqli-> connect_error. "\n";
    exit;
}else{
    echo "la conexion ha funcionado \n";
}

$resultado = $mysqli_query($mysqli, $sql);
$num_filas = mysqli_num_rows($resultados);

if ($num_fulas>0){
    echo "<thead><tr><th>Nombre</th><th>Personas</th><th>Zona</th><th>Fecha</th><th>Hora</th><th>Asistencia</th></tr></thead>"
    while($row = mysqli_fetch_assoc($resultado)){
        echo "id: " .$resultado("id");
    }
    
} else{
    echo "No hay filas";
}

$mysqli->close();
?>