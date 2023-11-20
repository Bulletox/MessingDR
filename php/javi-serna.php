<?php
$conn = mysqli_connect("localhost", "root", "test", "phpsamples");

$affectedRow = 0;

$xml = simplexml_load_file("javi-serna.xml") or die("Error: no puedo crear objetos");

foreach ($xml->children() as $row) {
    $id_usuario = $row->id_usuario;
    $nombre = $row->nombre;
    $apellidos = $row->apellidos;
    $correo = $row->correo;
    $telefono = $row->telefono;
    $id_reserva = $row->id_reserva;
    $fecha_reserva = $row->fecha_reserva;
    $num_personas = $row->num_personas;
    $estado = $row->estado;
    
    $sql = "INSERT INTO javi-serna(id_usuario,nombre,apellidos,correo,telefono,id_reserva,fecha_reserva,num_personas,estado) VALUES ('" . $id_usuario . "','" . $nombre . "','" . $apellidos . "','" . $correo . "','" . $telefono . "','" . $od_reserva . "','" . $fecha_reserva . "','" . $num_reserva . "','" . $estado . "')";
    
    $result = mysqli_query($conn, $sql);
    
    if (! empty($result)) {
        $affectedRow ++;
    } else {
        $error_message = mysqli_error($conn) . "n";
    }
}
?>
<?php
if ($affectedRow > 0) {
    $message = $affectedRow . " campos insertados";
} else {
    $message = "no han entrado campos!";
}

?>