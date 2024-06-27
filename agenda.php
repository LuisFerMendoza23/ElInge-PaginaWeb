<?php
session_start();
include "cone.php"; 

//Capturar IdServicio de URL y guardar en sesion
if (isset($_GET['idservicio'])) {
    $_SESSION['IdServicio'] = $_GET['idservicio'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Lugar']) && isset($_POST['Fecha']) && isset($_POST['Hora'])) {
        
        $lugar = mysqli_real_escape_string($con, $_POST['Lugar']);
        $fecha = mysqli_real_escape_string($con, $_POST['Fecha']);
        $hora = mysqli_real_escape_string($con, $_POST['Hora']);

        // Insertar la nueva agenda en la tabla `agenda`
        $sql_agenda = "INSERT INTO agenda (Lugar, Fecha, Hora) VALUES ('$lugar', '$fecha', '$hora')";
        $result_agenda = mysqli_query($con, $sql_agenda);
        if ($result_agenda) {
            echo '<script>alert("Datos insertados correctamente");</script>';
            // Obtener el último ID insertado
            $last_id = mysqli_insert_id($con);

            // Consultar los datos recién insertados
            $sql_select = "SELECT * FROM agenda WHERE IdAgenda = $last_id";
            $result_select = mysqli_query($con, $sql_select);

            if ($result_select) {
                $row_agenda = mysqli_fetch_assoc($result_select);

                // Mostrar los datos en la consola del navegador
                echo '<script>';
                echo 'console.log("Datos insertados en agenda:");';
                echo 'console.log("Lugar: ' . $row_agenda['Lugar'] . '");';
                echo 'console.log("Fecha: ' . $row_agenda['Fecha'] . '");';
                echo 'console.log("Hora: ' . $row_agenda['Hora'] . '");';
                echo '</script>';

                if(isset($_SESSION['IdUsuario'])) {
                    //Obtener los datos del usuario desde la base de datos
                    $idusuario = $_SESSION['IdUsuario'];
                    $sql_usuario = "SELECT Nombre, Correo FROM usuarios WHERE IdUsuario = '$idusuario'";
                    $result_usuario = mysqli_query($con, $sql_usuario);
                    
                    if(mysqli_num_rows($result_usuario) > 0) {
                        $row_usuario = mysqli_fetch_assoc($result_usuario);
                        $nombre = $row_usuario['Nombre'];
                        $correo = $row_usuario['Correo'];
                        $fechaOrden = date('Y-m-d H:i:s');
                        
                        // Insertar la nueva orden en la tabla `orden`
                        $sql_orden = "INSERT INTO orden (IdUsuario, Nombre, Correo, Fecha, Fecha_orden) VALUES ('$idusuario', '$nombre', '$correo', '$fecha', '$fechaOrden')";
                        $result_orden = mysqli_query($con, $sql_orden);
                    
                        if($result_orden) {
                            echo '<script>alert("Datos insertados correctamente en la tabla orden.");</script>';
                            $last_id_orden = mysqli_insert_id($con);

                            $sql_select_orden = "SELECT * FROM orden WHERE IdOrden = $last_id_orden";
                            $result_select_orden = mysqli_query($con, $sql_select_orden);

                            if ($result_select_orden) {
                                $row_orden = mysqli_fetch_assoc($result_select_orden);

                                echo '<script>';
                                echo 'console.log("Datos insertados en orden:");';
                                echo 'console.log("IdOrden: ' . $row_orden['IdOrden'] . '");';
                                echo 'console.log("IdUsuario: ' . $row_orden['IdUsuario'] . '");';
                                echo 'console.log("Nombre: ' . $row_orden['Nombre'] . '");';
                                echo 'console.log("Correo: ' . $row_orden['Correo'] . '");';
                                echo 'console.log("Fecha: ' . $row_orden['Fecha'] . '");';
                                echo 'console.log("Fecha_orden: ' . $row_orden['Fecha_orden'] . '");';
                                echo '</script>';

                                // Validar que IdServicio esté presente en la sesión
                                if(isset($_SESSION['IdServicio'])) {
                                    $idservicio = $_SESSION['IdServicio'];
                                    
                                    $sql_servicios = "SELECT nombreS, descriS, precioS FROM servicios WHERE IdServicio = $idservicio";
                                    $result_servicios = mysqli_query($con, $sql_servicios);

                                    if($result_servicios && mysqli_num_rows($result_servicios) > 0) {
                                        while ($row_servicio = mysqli_fetch_assoc($result_servicios)) {
                                            $nombres = $row_servicio['nombreS'];
                                            $descriS = $row_servicio['descriS'];
                                            $precioS = $row_servicio['precioS'];

                                            $sql_orden_detalles = "INSERT INTO orden_detalles (IdOrden, nombreS, descriS, precioS, Lugar, Hora, IdServicio) VALUES ('$last_id_orden', '$nombres', '$descriS', '$precioS', '$lugar', '$hora', '$idservicio')";
                                            $result_orden_detalles = mysqli_query($con, $sql_orden_detalles);

                                            if($result_orden_detalles) {
                                                echo '<script>alert("Datos insertados correctamente en la tabla orden_detalles.");</script>';
                                                $last_id_orden_detalles = mysqli_insert_id($con);
                                                $sql_select_orden_detalles = "SELECT * FROM orden_detalles WHERE IdOrdenDetalles = $last_id_orden_detalles";
                                                $result_select_orden_detalles = mysqli_query($con, $sql_select_orden_detalles);

                                                if ($result_select_orden_detalles) {
                                                    $row_orden_detalles = mysqli_fetch_assoc($result_select_orden_detalles);

                                                    echo '<script>';
                                                    echo 'console.log("Datos insertados en orden_detalles:");';
                                                    echo 'console.log("IdOrdenDetalles: ' . $row_orden_detalles['IdOrdenDetalles'] . '");';
                                                    echo 'console.log("IdOrden: ' . $row_orden_detalles['IdOrden'] . '");';
                                                    echo 'console.log("nombreS: ' . $row_orden_detalles['nombreS'] . '");';
                                                    echo 'console.log("descriS: ' . $row_orden_detalles['descriS'] . '");';
                                                    echo 'console.log("precioS: ' . $row_orden_detalles['precioS'] . '");';
                                                    echo 'console.log("Lugar: ' . $row_orden_detalles['Lugar'] . '");';
                                                    echo 'console.log("Hora: ' . $row_orden_detalles['Hora'] . '");';
                                                    echo 'console.log("IdServicio: ' . $row_orden_detalles['IdServicio'] . '");';
                                                    echo '</script>';
                                                } else {
                                                    echo '<script>alert("Error al obtener los datos insertados en la tabla orden_detalles: ' . mysqli_error($con) . '");</script>';
                                                }
                                            } else {
                                                echo '<script>alert("Error al insertar datos en la tabla orden_detalles: ' . mysqli_error($con) . '");</script>';
                                            }
                                        }
                                    } else {
                                        echo '<script>alert("Error al obtener los datos de la tabla servicios: ' . mysqli_error($con) . '");</script>';
                                    }
                                } else {
                                    echo '<script>alert("IdServicio no proporcionado.");</script>';
                                }

                            } else {
                                echo '<script>alert("Error al obtener los datos insertados en la tabla orden: ' . mysqli_error($con) . '");</script>';
                            }
                        } else {
                            echo '<script>alert("Error al insertar datos en la tabla orden: ' . mysqli_error($con) . '");</script>';
                        }
                    } else {
                        echo '<script>alert("Error al obtener los datos del usuario: ' . mysqli_error($con) . '");</script>';
                    }
                } else {
                    echo '<script>alert("Error no se encontro la sesion del usuario.");</script>';
                }
                // Redirigir a servicios.php
                header("Location: servicios.php");
                exit();
                
            } else {
                echo '<script>alert("Error al insertar datos en la tabla agenda: ' . mysqli_error($con) .
            

            mysqli_close($con);
        }    
        }
}
}
?>

<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <link href="style_Admin.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
       
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
                           integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
                           crossorigin="anonymous" referrerpolicy="no-refferer">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quattrocento:wght@700&display=swap" rel="stylesheet">
</head>
<header class="HeaderContainer">
    <nav>
        <input type="checkbox" id="click">
        <label for="click" class="btn">
            <i class="fa-solid fa-bars"></i>
        </label>
        <a href="index.php"><img class="LogoIMG" src="img/logo.png" height="70" width="80"></a>
        <ul>
            <li> <a href="index.php">Inicio</a></li>
            <li> <a href="servicios.php">Servicios</a></li>
            <li> <a href="login.html">Login</a></li>
            <li> <a href="salir.php">Salir</a></li>
            <li><a href="javascript:history.back()">Regresar</a></li>
        </ul>
        <script>
            function goBack() {
                window.history.back();
            }
        </script>
    </nav>
</header>
<body>
    <div class="agenda_contenedor">
        <div class="agenda_formulario">
            <form action="" method="post" class="form">
                <div class="regCampos">
                    <h1 class="formL_tittle">Agregar fecha</h1>
                    <input class="input" type="text" id="Lugar" name="Lugar" placeholder="Lugar del evento" required>
                    <br><br>
                    <input class="input" type="date" id="Fecha" name="Fecha" placeholder="Fecha del evento"  required>
                    <input class="input" type="time" id="Hora" name="Hora" placeholder="Hora del evento" required>
                    <br><br>
                </div>
                <div class="boton_contenedor">
                    <button class="boton"type="submit">Agregar fecha </button>
                    <br><br>
                </div>
            </form>
        </div>
    </div>
</body>
<footer>
    <section>
        <p>Nombre: Luis Fernando Mendoza Brambila</p>
        <p>Grupo: 4P</p>
        <p>Materias: Desarrollo Web 1 y Base de Datos 1</p>
    </section>
</footer>

</html>