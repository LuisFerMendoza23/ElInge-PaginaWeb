<?php

include "cone.php";

$nombre = $_POST['name_service'];
$categoria = $_POST['category'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['price'];
$imagen = $_POST['image'];

$directorio = "img";
$rutaimg = $directorio.'/'.$imagen;


$sql = mysqli_query($con, "INSERT INTO servicios (IdServicio, nombreS, categoS, descriS,
precioS, imagenS) VALUES (0, '$nombre', '$categoria',
'$descripcion', '$precio', '$rutaimg')");

if($sql){
    echo '<script>alert("Servicio agregadoW correctamente");</script>';
    header("location: vista_admin.php");
} else {
    echo "Error" .$sql ."<br>" . mysqli_error($con);
}
mysqli_close($con);
?>