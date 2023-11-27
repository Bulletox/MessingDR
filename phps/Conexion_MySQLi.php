<?php
// MySQLi
function limpiar_datos($dato)
{
    if ($dato !== null) {
        $dato = htmlspecialchars($dato);
        $dato = stripslashes($dato);
        $dato = trim($dato);
    }
    return $dato;
}

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
try {
    // Procesamiento del formulario que se ha enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validación y limpieza de los datos del formulario
        $nombre = limpiar_datos($_POST["nombre"]);
        $correo = limpiar_datos($_POST["email"]);
        $fecha = limpiar_datos($_POST["fecha"]);
        $hora = limpiar_datos($_POST["hora"]);
        
        $num_personas = limpiar_datos($_POST["cantidad"]);

        // Creado y ejecutado la query para la inserción de los datos en la tabla "Usuario"
        $sqlUsuario = "INSERT INTO usuario (nombre, correo) VALUES (?, ?)";
        $stmtUsuario = $conn->prepare($sqlUsuario);

        // Vinculación de los datos para la tabla "Usuario"
        $stmtUsuario->bind_param("ss", $nombre, $correo);


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
        $sqlReservas = "INSERT INTO reservas (fecha, num_personas, estado, id_usuario, hora) VALUES (?, ?, ?, ?, ?)";
        $stmtReservas = $conn->prepare($sqlReservas);

        // Vinculación de los datos para la tabla "Reservas"
        $stmtReservas->bind_param("siiis", $fecha, $num_personas, $estado, $id_usuario, $hora);

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

} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}

header("Location: ../index.html");
?>
