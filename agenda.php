<?php
session_start();
include "cone.php"; 
include "orden.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Lugar']) && isset($_POST['Fecha']) && isset($_POST['Hora'])) {
        
        $lugar = $_POST['Lugar'];
        $fecha = $_POST['Fecha'];
        $hora = $_POST['Hora'];

        $sql = "INSERT INTO agenda (Lugar, Fecha, Hora) VALUES ('$lugar', '$fecha', '$hora')";

        if (mysqli_query($con, $sql)) {
            //alerta
            echo '<script>alert("Datos insertados correctamente");</script>';
            //Insertar los elementos en la orden
            $sql_orden = "SELECT * FROM orden";
            $result_orden = mysqli_query($con, $sql_orden);

            // Recorre los registros y muestra los valores
            while ($row_orden = mysqli_fetch_assoc($result_orden)) {
                echo 'IdOrden: ' . $row_orden['IdOrden'] . '<br>';
                echo 'IdUsuario: ' . $row_orden['IdUsuario'] . '<br>';
                echo 'Nombre: ' . $row_orden['Nombre'] . '<br>';
                echo 'Correo: ' . $row_orden['Correo'] . '<br>';
                echo 'Fecha: ' . $row_orden['Fecha'] . '<br>';
                echo 'Fecha_orden: ' . $row_orden['Fecha_orden'] . '<br>';
                echo '<hr>'; // Separador entre registros
            }
            //Cambio de pagina
            //echo '<script>window.location.href = "vista_admin.php";</script>';
        } else {
            echo "Error al insertar datos: " . mysqli_error($con);
        }

        mysqli_close($con);
    } else {
        echo "Por favor, completa todos los campos del formulario.";
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