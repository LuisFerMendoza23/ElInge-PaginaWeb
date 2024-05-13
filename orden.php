<?php 
//session_start();
include "cone.php";

//consulta
$sql = "SELECT usuarios.IdUsuario, usuarios.Nombre, usuarios.Correo FROM usuarios";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$IdUsuario = $row['IdUsuario'];
$Nombre = $row['Nombre'];
$Correo = $row['Correo'];

$sql2 = "SELECT agenda.Fecha FROM agenda";
$result2 = mysqli_query($con, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$Fecha = $row2['Fecha'];
//Variables para guardar/obtener datos 

// echo 'Usuario -> Id:' . $IdUsuario;
// echo 'Usuario -> Nombre: ' . $Nombre;1   q
// echo 'Usuario -> Correo:' . $Correo;
// echo 'Agenda -> Fecha:' . $Fecha;

$Orden = mysqli_query($con, "INSERT INTO orden (IdOrden, IdUsuario, Nombre, 
Correo, Fecha, Fecha_orden) VALUES (0, '$IdUsuario', '$Nombre', '$Correo', '$Fecha', NOW()");

if ($Orden) {
    echo 'Inserción exitosa en la tabla orden.';
} else {
    echo 'Error al insertar en la tabla orden: ' . mysqli_error($con);
}
//ORDEN DETALLES

?>