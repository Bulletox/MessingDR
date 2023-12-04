<?php
session_start();

// Conexión a la base de datos
include_once "Conexion_BBDD.php";
$conexion = conectarBaseDeDatos();
// Recibir datos del formulario
//$restaurante = $_POST['restaurante'];
$username = $_POST['username'];
$password = $_POST['password'];


// Consulta SQL para obtener el hash de la contraseña
$consulta = "SELECT password_hash FROM restaurante WHERE correo_restaurante = '$username'";
$resultado = $conexion->query($consulta);

if ($resultado->num_rows == 1) {
    $fila = $resultado->fetch_assoc();
    $hashAlmacenado = $fila['password_hash'];

    // Verificar la contraseña con password_verify
    if (password_verify($password, $hashAlmacenado)) {
        // Inicio de sesión exitoso
        //$_SESSION['username'] = $username;
        $_SESSION['username'] = "$username";
        header("Location: ../indexPC.php"); // Redirecciona a la página de inicio
    } else {
        // Inicio de sesión fallido
        echo "Usuario o contraseña incorrectos.1";
    }
} else {
    // Usuario no encontrado
    echo "Usuario o contraseña incorrectos.2";
}

$conexion->close();
?>
