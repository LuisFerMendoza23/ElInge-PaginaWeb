<?php

include "cone.php";

$nombre = $_POST['name'];
$apellido = $_POST['lastname'];
$edad = $_POST['age'];
$telefono = $_POST['cellphone'];
$correo = $_POST['email'];
$direccion = $_POST['direccion'];
$usuario = $_POST['user'];
$clave = $_POST['password'];

$sql = mysqli_query($con, "INSERT INTO usuarios (IdUsuario, Nombre, Apellido, Edad,
Telefono, Correo, Direccion, Usuario, Clave) VALUES (0, '$nombre', '$apellido',
'$edad', '$telefono', '$correo', '$direccion', '$usuario', '$clave')");

echo $sql;

if($sql){
    echo "usuario agregado";
    header("location: vista_admin.php");
} else {
    echo "Error" .$sql ."<br>" . mysqli_error($con);
}
mysqli_close($con);
?>