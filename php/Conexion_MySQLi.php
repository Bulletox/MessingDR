<?php
// MySQLi
$servername = "localhost";
$user = "mymessing97";
$password = "VNfHYGt3";
$dbname = "messingsql";

// Establecer conexión
$conn = new mysqli($servername, $user, $password, $dbname);

// Verificación de la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesamiento del formulario que se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validación y limpieza de los datos del formulario
    $nombre = limpiar_datos($_POST["nombre"]);
    $correo = limpiar_datos($_POST["email"]);
    $telefono = limpiar_datos($_POST["telefono"]);
    $fecha = limpiar_datos($_POST["fecha"]);
    $num_personas = limpiar_datos($_POST["cantidad"]);

    // Creado y ejecutado la query para la inserción de los datos en la tabla "Usuario"
    $sqlUsuario = "INSERT INTO Usuario (nombre, correo, telefono) VALUES (?, ?, ?)";
    $stmtUsuario = $conn->prepare($sqlUsuario);

    // Vinculación de los datos para la tabla "Usuario"
    $stmtUsuario->bind_param("sss", $nombre, $correo, $telefono);

    // Ejecutar la consulta para la tabla "Usuario"
    if (!$stmtUsuario->execute()) {
        echo "Error al insertar en la tabla Usuario: " . $stmtUsuario->error;
        $conn->close();
        exit;
    }

    // Obtener el ID del usuario recién insertado
    $id_usuario = $stmtUsuario->insert_id;

    // Definir un estado predeterminado (ajústalo según tus necesidades)
    $estado = ($num_personas > 10) ? 2 : 1;

    // Creado y ejecutado la query para la inserción de los datos en la tabla "Reservas"
    $sqlReservas = "INSERT INTO Reservas (fecha, num_personas, estado, id_usuario) VALUES (?, ?, ?, ?)";
    $stmtReservas = $conn->prepare($sqlReservas);

    // Vinculación de los datos para la tabla "Reservas"
    $stmtReservas->bind_param("siii", $fecha, $num_personas, $estado, $id_usuario);

    // Ejecutar la consulta para la tabla "Reservas"
    if ($stmtReservas->execute()) {
        echo "Reserva exitosa";
    } else {
        echo "Error al insertar en la tabla Reservas: " . $stmtReservas->error;
    }
}

// Cerrar conexión
$conn->close();

// Declaración de la función para limpiar datos
function limpiar_datos($dato)
{
    $dato = htmlspecialchars($dato);
    $dato = stripslashes($dato);
    $dato = trim($dato);
    return $dato;
}
?>
