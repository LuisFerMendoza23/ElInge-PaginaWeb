<?php
// Incluir el archivo de conexión a la base de datos
include 'cone.php';

// Consultar la base de datos
$sql = "SELECT * FROM usuarios";
$result = $con->query($sql);

$sql2 = "SELECT * FROM servicios";
$result2 = $con->query($sql2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Administrador de Servicios de comida "EL INGE" </title>
    <link href="style_index.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
                    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
                    crossorigin="anonymous" referrerpolicy="no-refferer">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quattrocento:wght@700&display=swap" rel="stylesheet">
    
</head>
<header>
    <nav>
        <input type="checkbox" id="click">
        <label for="click" class="btn">
            <i class="fa-solid fa-bars"></i>
        </label>
        <a href="index.php"><img class="LogoIMG" src="img/logo.png" height="70" width="80"></a>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="usuarios.php">Usuarios</a></li>
            <li><a href="servicios.php">Servicios</a></li>
            <li><a href="fechas.php">Fechas eventos</a></li>
            <li><a href="Bitacora_Usuarios.php">Bitacora</a></li>
        </ul>
    </nav>
</header>
<body>
    <div class="index_contenedor">
        <div class="titulo">
            
        <h1>Modo Administrador</h1>
        </div>
        <div class="contenedorGeneral">
            <div class="opciones">
                <div class="btnAdmin">
                    <div class="AdminUsuarios">
                        <button class="btnAdminUsuarios" type="button"><a class="boton" href="registro.html">Agregar usuario</a></button>
                        <button class="btnAdminUsuarios" type="button"><a class="boton" href="buscar_usuarios.php">Buscar usuarios</a></button>
                    </div>
                    <div class="AdminServicios">
                        <button class="btnAdminServicios" type="button"><a class="boton" href="Ad_servicio.html">Agregar servicio</a></button>
                        <button class="btnAdminServicios" type="button"><a class="boton" href="buscar_servicios.php">Buscar servicio</a></button>
                    </div>
                    <div class="AdminAgenda">
                        <button class="btnAdminAgenda" type="button"><a class="boton" href="agenda.php">Agregar fecha</a></button>
                        <button class="btnAdminAgenda" type="button"><a class="boton" href="">Eliminar fecha</a></button>
                    </div>
                    <button class="btnBitacora" type="button">
                        <a class="boton" href="Bitacora_Usuarios.php">Mostrar bitacora usuarios</a><br><br>
                        <a class="boton" href="correo.php">Mandar a correo</a>
                    </button>
                </div>
            </div>
            <div class="info">
                <div class="tablaUsuarios">
                    <h3>Tabla de usuarios:</h3>
                    <table>
                        <tr>
                            <th>IdUsuario</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Edad</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Direccion</th>
                            <th>Usuario</th>
                            <th>Clave</th>
                        </tr>
                        <?php 
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["IdUsuario"] . "</td>";
                                    echo "<td>" . $row["Nombre"] . "</td>";
                                    echo "<td>" . $row["Apellido"] . "</td>";
                                    echo "<td>" . $row["Edad"] . "</td>";
                                    echo "<td>" . $row["Telefono"] . "</td>";
                                    echo "<td>" . $row["Correo"] . "</td>";
                                    echo "<td>" . $row["Direccion"] . "</td>";
                                    echo "<td>" . $row["Usuario"] . "</td>";
                                    echo "<td>" . $row["Clave"] . "</td>";
                                    // Agrega más celdas según tu estructura de tabla
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>No se encontraron resultados</td></tr>";
                            }
                        ?>
                    </table>
                </div>
                <div class="tablaServicios">
                    <h3>Tabla de Servicios:</h3>
                    <table>
                       <tr>
                            <th>IdServicio</th>
                            <th>Nombre S.</th>
                            <th>Categoria S.</th>
                            <th>Descripcion S.</th>
                            <th>Precio S.</th>
                            <th>Imagen S.</th>
                        </tr>
                        <?php 
                            if ($result2->num_rows > 0) {
                                while ($row = $result2->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["IdServicio"] . "</td>";
                                    echo "<td>" . $row["nombreS"] . "</td>";
                                    echo "<td>" . $row["categoS"] . "</td>";
                                    echo "<td>" . $row["descriS"] . "</td>";
                                    echo "<td>" . $row["precioS"] . "</td>";
                                    echo "<td>" . $row["imagenS"] . "</td>";
                            
                                    // Agrega más celdas según tu estructura de tabla
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>No se encontraron resultados</td></tr>";
                            }
                        ?>

                    </table>
                </div>
            </div>
        </div>
        
    </div>
</body>
<footer>
    <p>Nombre: Luis Fernando Mendoza Brambila - 4P</p>
    <p>Materias: Desarrollo Web 1 y Base de Datos 1</p>
</footer>
</html>