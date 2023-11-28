<?php
// Archivo eliminar_reserva.php
include_once "Conexion_BBDD.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el id de reserva desde la solicitud POST
    $idReserva = $_POST["id_reserva"];

    // Actualizar la columna 'estado' a 3 en la base de datos
    $conn = conectarBaseDeDatos();
    $sql = "UPDATE reservas SET estado = 3 WHERE id_reserva = $idReserva";

    if ($conn->query($sql) === TRUE) {
        // La actualización fue exitosa
        echo "OK";
    } else {
        // La actualización falló
        echo "Error al actualizar la reserva: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

} else {
    // La solicitud no es POST, manejar según sea necesario
    echo "Método no permitido";
}
?>
