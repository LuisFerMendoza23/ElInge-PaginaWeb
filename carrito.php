<?php
session_start();
include "cone.php"; 

if (isset($_SESSION['IdUsuario'])) {
    $idusuario = $_SESSION['IdUsuario'];
    $username = $_SESSION['Nombre'];
} else {
    echo "No hay variables de sesión definidas.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <link href="style_carrito.css" rel="stylesheet">
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
        <nav class="nav_carrito">
            <input type="checkbox" id="click">
            <label for="click" class="btn">
                <i class="fa-solid fa-bars"></i>
            </label>
            <a href="index.php"><img class="LogoIMG" src="img/logo.png" height="70" width="80"></a>
            <ul class="menu_carrito">
            
                <div class="menu_carrito">
                    <li> <a href="index.php">Inicio</a></li>
                    <li> <a href="servicios.php">Servicios</a></li>
                    <li> <a id="loginbtn" href="login.html">Login</a></li>
                    <li> <a id="carritobtn" href="carrito.php">Carrito</a></li>
                    <li> <a id="salirbtn" href="salir.php">Salir</a></li>
                    <li> <a href="javascript:history.back()">Regresar</a></li>
                </div>
            </ul>
            <ul>
                <div class="menu_user">
                    <?php 
                    if(isset($_SESSION['Nombre'])){
                        $username = $_SESSION['Nombre'];
                        echo '<li> Usuario: ' . htmlspecialchars($username) . '</li>';
                    } 
                    ?>
                </div>
            </ul>
        </nav>
    </div>
</header>
<body>
    <main>
        <section class="cart_container">
            <?php
                // Consulta para obtener los detalles de los servicios en el carrito del usuario
                $sql = "SELECT od.IdOrdenDetalles, od.nombreS, od.descriS, od.precioS, od.Lugar, od.Hora, s.imagenS 
                        FROM orden_detalles od 
                        JOIN orden o ON od.IdOrden = o.IdOrden
                        JOIN servicios s ON od.IdServicio = s.IdServicio
                        WHERE o.IdUsuario = ?";
                
                if ($stmt = $con->prepare($sql)) {
                    $stmt->bind_param("i", $idusuario);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '
                            <div class="servicio_cont">
                                <div class="servicio_data">
                                    <section class="name_img">
                                        <div class="servicio_titulo">
                                            <h3>' . htmlspecialchars($row["nombreS"]) . '</h3>
                                        </div>
                                        <div class="servicio_img">
                                            <img src="' . htmlspecialchars($row["imagenS"]) . '" class="imagen_servicio" alt="Imagen del servicio">
                                        </div>
                                    </section>
                                    <section class="desc_price">
                                        <div class="categoria_servicio">
                                            <p class="categoria_servicio2"><b>Lugar:</b> ' . htmlspecialchars($row["Lugar"]) . '</p>
                                            <p class="categoria_servicio2"><b>Hora:</b> ' . htmlspecialchars($row["Hora"]) . '</p>
                                        </div>
                                        <div class="servicio_desc">
                                            <b>Descripcion: </b>
                                            <p>' . htmlspecialchars($row["descriS"]) . '</p>
                                        </div>
                                        <div class="servicio_precio">
                                            <b>Precio: </b>
                                            <p class="precio">$' . htmlspecialchars($row["precioS"]) . '</p>
                                        </div>
                                        <form method="POST" action="eliminar_servicio.php">
                                            <input type="hidden" name="IdOrdenDetalles" value="' . htmlspecialchars($row["IdOrdenDetalles"]) . '">
                                            <button type="submit" class="btn_eliminar">Eliminar</button>
                                        </form>
                                    </section>
                                </div>
                            </div>';
                        }
                    } else {
                        echo '<p>No hay servicios en el carrito.</p>';
                    }
                    
                    $stmt->close();
                } else {
                    echo "Error al preparar la consulta: " . $con->error;
                }
            ?>

            <a href="correo.php"><button class="addToCart_Button">Completar Compra</button></a>
        </section>
    </main>
</body>
<footer>
    <div>
        <p>Nombre: Luis Fernando Mendoza Brambila</p>
        <p>Grupo: 4P</p>
        <p>Materias: Desarrollo Web 1 y Base de Datos 1</p>
    </div>
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