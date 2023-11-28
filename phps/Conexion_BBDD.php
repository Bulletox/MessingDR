<?php
function conectarBaseDeDatos() {
    $servername = "localhost";
    $user = "mymessing97";
    $password = "VNfHYGt3";
    $dbname = "messingsql";

    // Crear la conexión
    $conn = new mysqli($servername, $user, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    return $conn;
}

?>
