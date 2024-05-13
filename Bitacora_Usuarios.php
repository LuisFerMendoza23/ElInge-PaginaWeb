<?php
// Incluir el archivo de conexión a la base de datos
include 'cone.php';

// Consultar la base de datos
$sql = "SELECT * FROM bitacora_usuarios";
$result = $con->query($sql);

$sql5 = "SELECT * FROM bitacora_servicios";
$result2 = $con->query($sql5);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bitácora de Usuarios</title>
    <link href="style.css" rel="stylesheet">
    <style>
        th{
            background-color: black;
            color: white;
        }
        td{
            background-color: white;
        }
    </style>
    
</head>
<header>
    <nav>
        <!-- <input type="checkbox" id="click">
        <label for="click" class="btn">
            <i class="fa-solid fa-bars"></i>
        </label> -->
        <a href="index.php"><img class="LogoIMG" src="img/logo.png" height="70" width="80"></a>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="javascript:history.back()">Regresar</a></li>
        </ul>
    </nav>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</header>
<body>

    <h2>Bitácora de Usuarios</h2>

    <table border="1">
        <tr>
            <th>id</th>
            <th>Fecha</th>
            <th>Sentencia</th>
            <th>ContraSentencia</th>
        </tr>

        <?php
        // Imprimir los datos en filas de la tabla
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["IdUsuario"] . "</td>";
                echo "<td>" . $row["fecha"] . "</td>";
                echo "<td>" . $row["sentencia"] . "</td>";
                echo "<td>" . $row["contraSentencia"] . "</td>";
                // Agrega más celdas según tu estructura de tabla
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No se encontraron resultados</td></tr>";
        }
        ?>

    </table>


    <h2>Bitácora de productos</h2>

    <table border="1">
        <tr>
            <th>id</th>
            <th>Fecha</th>
            <th>Sentencia</th>
            <th>ContraSentencia</th>
        </tr>

        <?php
        // Imprimir los datos en filas de la tabla
        if ($result2->num_rows > 0) {
            while ($row = $result2->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["IdServicio"] . "</td>";
                echo "<td>" . $row["fecha"] . "</td>";
                echo "<td>" . $row["sentencia"] . "</td>";
                echo "<td>" . $row["contraSentencia"] . "</td>";
                // Agrega más celdas según tu estructura de tabla
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No se encontraron resultados</td></tr>";
        }
        ?>

    </table>
</body>
<footer>
    <p>Nombre: Luis Fernando Mendoza Brambila - 4P</p>
    <p>Materias: Desarrollo Web 1 y Base de Datos 1</p>
</footer>
</html>