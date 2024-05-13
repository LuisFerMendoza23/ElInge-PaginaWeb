<?php

$servername = "localhost";
$database = "registros";
$username = "root";
$password = "";

$con = mysqli_connect($servername, $username, $password, $database);
$con->set_charset("utf8");

if(!$con){
    die("Fallo la conexion " . mysqli_connect_error());
} else {
    // echo "Conexion Exitosa <br>";
}

?>