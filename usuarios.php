<?php
// Incluir el archivo de conexión a la base de datos
include 'cone.php';

// Consultar la base de datos
$sql = "SELECT * FROM usuarios";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
    <div class="index_contenedor">
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
    </div>
</body>
</html>