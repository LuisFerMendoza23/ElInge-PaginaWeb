<?PHP
    include 'cone.php';

    //Consulta hacia la tabla de agenda
    $sql = "SELECT * FROM agenda";
    //Obtengo todos los datos que tengo en la tabla
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
            <h3>Tabla de fechas registradas para eventos: </h3>
            <table>
                <tr>
                    <th>IdAgenda</th>
                    <th>Lugar</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                </tr>
                <?php
                    if($result->num_rows > 0){ //Si la consulta\tabla tiene algo
                        //Mientras haya resultados en la tabla
                        while($row = $result->fetch_assoc()){
                            echo "<tr>";
                            echo "<td>" . $row["IdAgenda"] . "</td>";
                            echo "<td>" . $row["Lugar"] . "</td>";
                            echo "<td>" . $row["Fecha"] . "</td>";
                            echo "<td>" . $row["Hora"] . "</td>";
                            echo "<tr>";
                        }
                    }
                    else {
                        echo "<tr><td colspan='4'>No se encontraron resultados</td></tr>";
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>