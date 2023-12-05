<?php
include_once "Conexion_BBDD.php";
$conn = conectarBaseDeDatos();

$nombre_restaurante = $_POST['nombre_restaurante'];
$correo_restaurante = $_POST['correo_restaurante'];
$password = $_POST['password'];

// Utilizar consultas preparadas para prevenir la inyección SQL
$sql = "INSERT INTO restaurante (nombre_restaurante, correo_restaurante, password_hash) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

// Verificar si la preparación fue exitosa
if ($stmt) {
    // Enlazar parámetros
    $stmt->bind_param("sss", $nombre_restaurante, $correo_restaurante, $password_hash);

    // Hash de la contraseña
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Ejecutar la consulta preparada
    if ($stmt->execute()) {
        echo "Registro exitoso";
        header("Location: ../login.php");
    } else {
        echo "Error al ejecutar la consulta: " . $stmt->error;
    }

    // Cerrar la consulta preparada
    $stmt->close();
} else {
    echo "Error en la preparación de la consulta: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>