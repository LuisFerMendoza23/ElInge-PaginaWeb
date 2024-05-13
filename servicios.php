<?php
    session_start();
    include "cone.php";
    
    $arreglo = array();
    // Realizar consulta a la base de datos para obtener los servicios
    $sql = "SELECT * FROM servicios"; // Ajusta esta consulta según la estructura de tu base de datos
    $result = mysqli_query($con, $sql);

    // if ($result->num_rows > 0) {
    //     // Recorrer los resultados y crear divs de servicio dinámicamente
    //     while($row = $result->fetch_assoc()) {
    //         // Obtener la información de cada servicio
    //         $nombre = $row["nombreS"];
    //         $categoria = $row["categoS"];
    //         $descripcion = $row["descriS"];
    //         $precio = $row["precioS"];
    //         $imagen = $row["imagenS"];
?>

<!DOCTYPE html>
<html >
<head>
    <link href="style_servicios.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
                           integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
                           crossorigin="anonymous" referrerpolicy="no-refferer">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quattrocento:wght@700&display=swap" rel="stylesheet">
</head>
<header class="HeaderContainer">
    <div class="cont_header">
        <nav>
            <input type="checkbox" id="click">
            <label for="click" class="btn">
                <i class="fa-solid fa-bars"></i>
            </label>
            <a href="index.php"><img class="LogoIMG" src="img/logo.png" height="70" width="80"></a>
            <ul>
                <li> <a href="index.php">Inicio</a></li>
                <li> <a href="servicios.php">Servicios</a></li>
                <li> <a id="loginbtn" href="login.html">Login</a></li>
                <li> <a id="carritobtn" href="carrito.php">Carrito</a></li>
                <li> <a id="salirbtn" href="salir.php">Salir</a></li>
            </ul>
        <script>
            function goBack() {
                window.history.back();
            }
        </script>
        </nav>
    </div>
</header>
<body>
    <h1 class="serv_tittle">Servicios que puedes contratar:</h1>
    <div class="serv_contenedor">
        
            <?php
                // Verificar si la consulta tuvo éxito y hay resultados
            if ($result && mysqli_num_rows($result) > 0) {
                // Iterar sobre cada fila de servicios
                 while ($row = mysqli_fetch_assoc($result)) {
                
                    // Acceder a los datos de cada servicio
                    $nombreServicio = $row["nombreS"];
                    $categoria = $row["categoS"];
                    $descripcion = $row["descriS"];
                    $precio = $row["precioS"];
                    $imagen = $row["imagenS"];

                    echo '<div class="servicio">';
                        echo '<div class="servicio_img">';
                        echo '<img src="' . $imagen . '" class="imagen_servicio" alt="Imagen del servicio">';
                        echo '</div>';
                        echo '<div class="servicio_titulo">';
                        echo '<h3>' . $nombreServicio . '</h3>';
                        echo '</div>';
                        echo '<div class="categoria_servicio">';
                        echo '<p class="categoria_servicio"><b>' . $categoria . '</b></p>';
                        echo '</div>';
                        echo '<div class="servicio_desc">';
                        echo '<p>' . $descripcion . '</p>';
                        echo '</div>';
                        echo '<div class="servicio_precio">';
                        echo '<p class="precio"><b>$' .$precio . '</b></p>';
                        echo '</div>';
                        echo '<div class="servicio_boton">';
                        echo '<a href="agenda.php"><button class="boton">Agregar al carrito</button></a>';
                        //echo '<button class="boton">Agregar al carrito</button>';
                        echo '</div>';
                    echo '</div>';
                }
            } else {
                // En caso de no encontrar servicios
                echo "<p>No se encontraron servicios.</p>";
            }

            // Cerrar la conexión después de usarla
            mysqli_close($con);
            ?>
    </div>
    <div class="contenedor_botones">
        <div class="cont_bt_agenda">
            <button type="submit" class="btn_agenda">Ver agenda </button>
            <a class="boton_correo" href="correo.php">Mandar a correo</a>
    </div>
</body>
<footer>
    <section>
        <p>Nombre: Luis Fernando Mendoza Brambila</p>
        <p>Grupo: 4P</p>
        <p>Materias: Desarrollo Web 1 y Base de Datos 1</p>
    </section>
</footer>


<?php
$tipoSesion = isset($_SESSION["tipoSesion"]) ? $_SESSION["tipoSesion"] : null;

    if ($tipoSesion == "usuario") { ?>
        <script>
            document.getElementById("loginbtn").style.display = 'none';
            document.getElementById("carritobtn").style.display = 'inline';
        </script>
    <?php } elseif ($tipoSesion == "admin") { ?>
        <script>
            document.getElementById("loginbtn").style.display = 'none';
        </script>
    <?php } elseif ($tipoSesion != "admin" && $tipoSesion != "usuario") { ?>
        <script>
            document.getElementById("carritobtn").style.display = 'none';
            document.getElementById("salirbtn").style.display = 'none';
        </script>
    <?php } ?>
</html>