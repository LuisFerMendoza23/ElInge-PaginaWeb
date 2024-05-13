<?php
    session_start();

    function getCarritoServicios(){
        include 'cone.php';

        $idUsuario = $_SESSION['IdUsuario'];
        $sql = "SELECT productos.*, acarrito.cantidad FROM carrito
                INNER JOIN productos ON carrito.producto_id = productos.id
                WHERE carrito.usuario_id = $idUsuario";
        $result = $con->query($sql);

        $productosCarrito = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productosCarrito[] = $row;
            }
        }

        $con->close();

        return $productosCarrito;
    }

    $productosCarrito = getCarritoServicios();
?>

<!DOCTYPE html>
<html >
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
        <nav>
            <input type="checkbox" id="click">
            <label for="click" class="btn">
                <i class="fa-solid fa-bars"></i>
            </label>
            <ul>
                <li> <a href="index.php">Inicio</a></li>
                <li> <a href="servicios.php">Servicios</a></li>
                <li> <a id="loginbtn" href="login.html">Login</a></li>
                <li> <a id="carritobtn" href="carrito.php">Carrito</a></li>
                <li> <a id="salirbtn" href="salir.php">Salir</a></li>
                <li> <a href="javascript:history.back()">Regresar</a></li>
            </ul>
            <script>
                function goBack(){
                    window.history.back();
                }
            </script>
        </nav>
    </div>
</header>
<body>
    <main>
        <p class="textoejemplo">hoola este es el ejemplo de la etiqueta main</p>
    </main>
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