<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link rel="stylesheet" href="style_servicios.css">
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
                <li > <a href="index.php">Inicio</a></li>
                <li > <a href="servicios.php">Servicios</a></li>
                <li > <a href="login.html">Login</a></li>
                <li > <a href="salir.php">Salir</a></li>
            </ul>
        </nav>
    </div>
</header>
<body>
    <div class="container">
        <div class="Desc_container">
            <div class="desc_cont_img">
                <!-- AQUI VA LA IMAGEN -->
                <img src="img/taquiza.jpg" class="ServicioDescImg">
            </div>
            <div class="desc_cont_info">
                <div class="servicio_titulo">
                    <!-- AQUI VA EL TITULO -->
                    <h3>***SERVICIO TITULO**</h3>
                </div>
                <div class="servicio_desc">
                    <!-- AQUI VA LA DESCRIPCION -->
                    <h3>***SERVICIO DESCRIPCION***</h3>
                    <p>**aaaaaaaaaaaaaaaaaaaaaaaaaaa**</p>
                    <p>**aaaaaaaaaaaaaaaaaaaaaaaaaaa**</p>
                    <p>**aaaaaaaaaaaaaaaaaaaaaaaaaaa**</p>
                    <p>**aaaaaaaaaaaaaaaaaaaaaaaaaaa**</p>
                    <p>**aaaaaaaaaaaaaaaaaaaaaaaaaaa**</p>
                    <p>**aaaaaaaaaaaaaaaaaaaaaaaaaaa**</p>
                    <p>**aaaaaaaaaaaaaaaaaaaaaaaaaaa**</p>
                    <p>**aaaaaaaaaaaaaaaaaaaaaaaaaaa**</p>
                    <p>**aaaaaaaaaaaaaaaaaaaaaaaaaaa**</p>
                    <p>**aaaaaaaaaaaaaaaaaaaaaaaaaaa**</p>
                    
                </div>
                <div class="servicio_precio">
                    <!-- AQUI VA EL PRECIO -->
                    <P class="precio"><b>$##</b></P>
                </div>
                <div class="servicio_boton">
                    <button class="boton">Agregar al carrito</button>
                </div>
            </div>
        </div>
        <div class="cont_otro_serv">
            <h2>Recomendaciones de servicios: </h2>
            <div class="servicios_recomendados">
                <div class="servicio_otro">
                    <!-- OTRO SERVICIO RANDOM -->
                    <div class="serv_otro_img">
                        <!-- AQUI VA LA IMAGEN -->
                        <img src="img/t_vapor.jpg" class="ServicioOtroImg">
                    </div>
                    <div class="serv_otro_titulo">
                        <!-- AQUI VA EL TITULO -->
                        <h3>Servicio de tacos al vapor</h3>
                    </div>
                    <div class="serv_otro_precio">
                        <!-- AQUI VA EL PRECIO -->
                        <P class="precio"><b>$9 cada taco</b></P>
                    </div>
                </div>
            </div>
            
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
<?php 
    if(isset($_SESSION["tipoSesion"])) {
        if($_SESSION["tipoSesion"] == "usuario"){ ?>
            <script>
                document.getElementById("loginbtn").style.display = 'none';
            </script>

        <?php
        } elseif($_SESSION["tipoSesion"] == "admin"){ ?>
            <script>
                document.getElementById("loginbtn").style.display = 'none';
            </script>
        <?php
        }
    }
    ?>
</html>