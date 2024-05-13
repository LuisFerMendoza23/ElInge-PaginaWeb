<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Servicios de comida "El inge"</title>
    <link href="style_index.css" rel="stylesheet">
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
            <li class="categorias"> 
                <a href="servicios.php">Servicios</a>
                <ul class="categorias-menu">
                    <li> <a href="">Generales</a></li>
                    <li> <a href="">Desayunos</a></li>
                    <li> <a href="">Comidas</a></li>
                    <li> <a href="">Cenas</a></li>
                </ul>
            </li>
            <li> <a id="loginbtn" href="login.html">Login</a></li>
            <li> <a id="carritobtn" href="carrito.php">Carrito</a></li>
            <li> <a id="salirbtn" href="salir.php">Salir</a></li>
        </ul>
    </nav>
</header>
<body>
    <main>

    </main>
    <div class="index_contenedor">
        <div class="InfoContainer">
                <div class="mision">
                    <h2>Mision:</h2>
                    <p>
                        La mision de esta empresa es brindar un servicio de 
                        comida para tus eventos, fiestas o reuniones
                        y asi puedas disfrutar del verdadero sabor 
                        de la cocina mexicana.
                    </p>
                    
                </div>
                <div class="vision">
                    <h2>Vision: </h2>
                    <p>
                        La vision de la empresa es ser de tus mejores opciones
                        de comida a contratar para cualquier evento que tengas
                    </p>
                </div>
                <div class="AcercaDe">
                    <h2>Acerca de nosotros:</h2>
                    <p>
                        Somos una micro empresa que busca satisfacer las
                        necesidades de las personas que quieran consumir alimentos 
                        deliciosos en sus fiestas y quieren darse la oportunidad 
                        a contratar de un servicio que los atienda. <br>
                        Buscamos la satisfaccion en el rostro del cliente, 
                        atendiendo siempre rapido y con una sonrisa, para que todos
                        tus invitados queden satisfechos y contentos con el gran
                        sason mexicano.
                    </p>
                </div>
        </div>
        <div class="MapContainer">
            <div class="mapa">
                <h2> Donde nos ubicamos:</h2>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3732.1979718021676!2d-103.39144422485614!3d20.7021839808667!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428ae4e98d5453d%3A0xc4fdd3929a2ecbd1!2sCentro%20de%20Ense%C3%B1anza%20T%C3%A9cnica%20Industrial%20(Plantel%20Colomos)!5e0!3m2!1ses-419!2smx!4v1694078091168!5m2!1ses-419!2smx"  class="mapaIMG"  style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    <button type="submit" class="bt_servicios" onclick="window.location.href = 'servicios.php'">Ver servicios</button>
    <!-- 
        <button type="submit" class="bt_servicios"><a href="servicios.php">Ver servicios</a></button>
    -->

</body>
<footer>
    <p>Nombre: Luis Fernando Mendoza Brambila - 4P</p>
    <p>Materias: Desarrollo Web 1 y Base de Datos 1</p>
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