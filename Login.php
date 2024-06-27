<?php

session_start();

include "cone.php";

$Correo = $_POST['Correo'];
$Clave = $_POST['Clave'];

$sql = mysqli_query($con, "SELECT IdUsuario, Correo, Clave, Nombre 
FROM usuarios WHERE Correo = '$Correo' AND Clave = '$Clave'");

if (!$sql) {
    die("Error en la consulta para usuarios: " . mysqli_error($con));
}

$sql2 = mysqli_query($con, "SELECT Correo, Clave
FROM administradores where Correo = '".$Correo."'
AND Clave = '".$Clave."' ");
if (!$sql2) {
    die("Error en la consulta para administradores: " . mysqli_error($con));
}

$Row = mysqli_num_rows($sql);
$Row2 = mysqli_num_rows($sql2);

if ($Row == 1) { 
    $row = mysqli_fetch_assoc($sql);
    $_SESSION['IdUsuario'] = $row['IdUsuario'];
    $_SESSION['Correo'] = $Correo;
    $_SESSION['Nombre'] = $row['Nombre'];
    $_SESSION["tipoSesion"] = "usuario";
    echo "Bienvenido";
    $pagina = "index.php";
} else if ($Row2 == 1) { 
    //ADMINISTRADOR
    $_SESSION["tipoSesion"] = "admin";
    echo "Bienvenido";
    $pagina = "vista_admin.php";
    
} else {
    $mensaje = "La contraseña o correo son incorrectos";
    $pagina = "login.php";
}

header("location: ". $pagina);
exit();
?>