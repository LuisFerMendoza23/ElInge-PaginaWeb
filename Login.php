<?php

session_start();

include "cone.php";

$Correo = $_POST['Correo'];
$Clave = $_POST['Clave'];

$sql = mysqli_query($con, "SELECT Correo, Clave
FROM usuarios where Correo = '".$Correo."'
AND Clave = '".$Clave."' ");

$sql2 = mysqli_query($con, "SELECT Correo, Clave
FROM administradores where Correo = '".$Correo."'
AND Clave = '".$Clave."' ");

$Row = mysqli_num_rows($sql);
$Row2 = mysqli_num_rows($sql2);

if ($Row == 1) { 
    $_SESSION['u_correo'] = $Correo;
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