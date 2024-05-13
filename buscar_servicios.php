<?php
    session_start();
    include "cone.php";
    $arreglo = array();

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buscar'])) {
            $nombreS = $_POST['nombreS'];
            $sql = "SELECT * FROM servicios WHERE nombreS COLLATE utf8mb4_general_ci = '$nombreS'";
            $result = $con->query($sql); //Realiza una busqueda a la base de datos con los parametros de $sql


            if ($result->num_rows > 0) { //Si se ecuentran resultados
                $arreglo = $result->fetch_assoc();
                $_SESSION['DatosServicios'] = $arreglo;
                // Habilitar los campos para edición
                $editable = true;
            } else {
                echo '<script>alert("No se encontró el producto");</script>';
            }
        }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
        $arreglo = $_SESSION['DatosServicios'];
        if (isset($_SESSION['DatosServicios'])) {
                $EliminarServicio = $arreglo['IdServicio']; //variable de la base de datos, guardada en $arreglo
                $sql = "DELETE FROM servicios WHERE IdServicio = '$EliminarServicio'";
                $result = mysqli_query($con, $sql);
                // echo $arreglo['id'];
                
                if($result){
                    echo '<script>alert("Servicio eliminado correctamente");</script>';
                    echo '<script>window.location.href = "vista_admin.php";</script>';
                    $_SESSION['DatosServicios'] = null;

                }
                else{
                    echo '<script>alert("' . $error_message . '");</script>';
                    echo '<script>window.location.href = "vista_admin.php";</script>';
                }
            mysqli_close($con);
        }
        else{
            echo '<script>alert("Producto no encontrado");</script>';
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
        // Obtener los datos actualizados del formulario, las variables son las del form
        $nuevoNombre = $_POST['nombreS'];
        $nuevaCategoria = $_POST['categoS'];
        $nuevaDescripcion = $_POST['descriS'];
        $nuevoPrecio = $_POST['precioS'];
        $nuevaImagen = $_POST['imageS'];
    
        // Obtener la información actualizada del servicio desde la sesión
        $datosActuales = $_SESSION['DatosServicios'];
    
        // Actualizar los datos del servicio con los nuevos valores
        $datosActuales['nombreS'] = $nuevoNombre;
        $datosActuales['categoS'] = $nuevaCategoria;
        $datosActuales['descriS'] = $nuevaDescripcion;
        $datosActuales['precioS'] = $nuevoPrecio;
        $datosActuales['imagenS'] = $nuevaImagen;
    
        // Actualizar estos datos en la base de datos
        $idServicio = $datosActuales['IdServicio'];
        $sqlUpdate = "UPDATE servicios SET 
                      nombreS = '$nuevoNombre', 
                      categoS = '$nuevaCategoria', 
                      descriS = '$nuevaDescripcion', 
                      precioS = '$nuevoPrecio', 
                      imagenS = '$nuevaImagen' 
                      WHERE IdServicio = '$idServicio'";
        
        $resultadoUpdate = $con->query($sqlUpdate);
    
        if ($resultadoUpdate) {
            // Si la actualización fue exitosa, actualizar la información en la sesión
            $_SESSION['DatosServicios'] = $datosActuales;
            echo '<script>alert("Servicio actualizado correctamente");</script>';
            echo '<script>window.location.href = "vista_admin.php";</script>';
        } else {
            echo '<script>alert("Error al actualizar el servicio");</script>';
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link href="style_Admin.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
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
                <li><a href="javascript:history.back()">Regresar</a></li>
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
    <div class="administrar_servicios_contenedor">
        <div class="form_buscar_serv">
            <h2> Buscar/Eliminar/Editar Productos</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <div class="regCampos">
                <input type="text" id="nombreS" name="nombreS" placeholder="Nombre del servicio" class="productosAdmin" 
                <?php if (isset($editable)) echo 'value="' . $arreglo['nombreS'] . '"'; ?> > <br>

                <input type="text" id="categoS" name="categoS" placeholder="Categoria del servicio" class="productosAdmin"
                <?php if (isset($editable)) echo 'value="' . $arreglo['categoS'] . '"'; ?> > <br>

                <input type="text" id="descriS" name="descriS" placeholder="Descripcion del servicio" class="productosAdmin" 
                <?php if (isset($editable)) echo 'value="' . $arreglo['descriS'] . '"'; ?> > <br>

                <input type="text" id="precioS" name="precioS" placeholder="Precio del servicio" class="productosAdmin" 
                <?php if (isset($editable)) echo 'value="' . $arreglo['precioS'] . '"'; ?> > <br>

                <input type="file" id="imageS" name="imageS" accept="image/*" placeholder="Sinopsis" class="productosAdmin"  
                <?php if (isset($editable)) echo 'value="' . $arreglo['imagenS'] . '"'; ?> > <br>
            </div>
            <div class="botones_contenedor">
                <button id="btnbuscar" type="submit" name="buscar">Buscar Servicio</button>
                <button id="btnEliminar" type="submit" name="eliminar">Eliminar Servicio</button>
                <button id="btnEditar" type="submit" name="editar">Editar</button>
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

<?php
if (isset($arreglo)) {
    ?>
    <script>
        document.getElementById("nombreS").value = "<?php echo $arreglo['nombreS']; ?>";
        document.getElementById("categoS").value = "<?php echo $arreglo['categoS']; ?>";
        document.getElementById("descriS").value = "<?php echo $arreglo['descriS']; ?>";        
        document.getElementById("precioS").value = "<?php echo $arreglo['precioS']; ?>";
        document.getElementById("imageS").value = "<?php echo $arreglo['imagenS']; ?>";
    </script>
    <?php
} else {

}
?>

</html>
