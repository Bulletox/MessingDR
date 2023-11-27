<?php
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

// Obtener la hora actual en el formato de la base de datos
$hora_actual = date("H:i:s");

// Consulta SQL para obtener las reservas del día en curso y después de la hora actual
// $sql = "SELECT usuario.nombre, reservas.num_personas, reservas.fecha, reservas.hora 
//         FROM reservas 
//         JOIN usuario ON reservas.id_usuario = usuario.id 
//         WHERE reservas.fecha = CURDATE() AND reservas.hora >= '$hora_actual'";
$sql = "SELECT usuario.nombre, reservas.num_personas, reservas.fecha, reservas.hora 
FROM reservas 
JOIN usuario ON reservas.id_usuario = usuario.id 
WHERE usuario.nombre = 'testjavier'";

$result = $conn->query($sql);

// Mostrar los resultados en una tabla HTML
if ($result->num_rows > 0) {
    echo "<table border='1'>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Personas</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                </tr>
            </thead>
            <tbody>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["nombre"] . "</td>
                <td>" . $row["num_personas"] . "</td>
                <td>" . $row["fecha"] . "</td>
                <td>" . $row["hora"] . "</td>
              </tr>";
    }

    echo "</tbody></table>";
} else {
    echo "No hay reservas para el día de hoy después de la hora actual.";
}
echo "El php funciona";
// Cerrar la conexión
$conn->close();
?>
