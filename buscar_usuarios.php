<?php
    session_start();
    include "cone.php";
    
    $arreglo = array();
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buscar'])) {
            $Correo = $_POST['Correo'];


            $sql = "SELECT * FROM usuarios WHERE Correo COLLATE utf8_unicode_ci = '$Correo'";
            $result = $con->query($sql);


            if ($result->num_rows > 0) {
                $arreglo = $result->fetch_assoc();
                $_SESSION['DatosUsuarios'] = $arreglo;
                // Habilitar los campos para edición
                $editable = true;
            } else {
                echo '<script>alert("No se encontró el usuario");</script>';
            }
        }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
        $arreglo = $_SESSION['DatosUsuarios'];
        if (isset($_SESSION['DatosUsuarios'])) {
                $EliminarUsuario = $arreglo['IdUsuario'];
                $sql = "DELETE FROM usuarios WHERE IdUsuario = '$EliminarUsuario'";
                $result = mysqli_query($con, $sql);
                // echo $arreglo['id'];
                
                if($result){
                    echo '<script>alert("Usuario eliminado correctamente");</script>';
                    echo '<script>window.location.href = "vista_admin.php";</script>';
                    $_SESSION['DatosUsuarios'] = null;

                }
                else{
                    echo '<script>alert("' . $error_message . '");</script>';
                    echo '<script>window.location.href = "vista_admin.php";</script>';
                }
            mysqli_close($con);
        }
        else{
            echo '<script>alert("Usuario no encontrado");</script>';
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
        // Obtener los datos actualizados del formulario
        $nuevoNombre = $_POST['Nombre'];
        $nuevoApellido = $_POST['Apellido'];
        $nuevaEdad = $_POST['Edad'];
        $nuevoTelefono = $_POST['Telefono'];
        $nuevoCorreo = $_POST['Correo'];
        $nuevaDireccion = $_POST['Direccion'];
        $nuevoUsuario = $_POST['Usuario'];
        $nuevaClave = $_POST['Clave'];
    
        // Obtener la información actualizada del servicio desde la sesión
        $datosActuales = $_SESSION['DatosUsuarios'];
    
        // Actualizar los datos del servicio con los nuevos valores
        $datosActuales['Nombre'] = $nuevoNombre;
        $datosActuales['Apellido'] = $nuevoApellido;
        $datosActuales['Edad'] = $nuevaEdad;
        $datosActuales['Telefono'] = $nuevoTelefono;
        $datosActuales['Correo'] = $nuevoCorreo;
        $datosActuales['Direccion'] = $nuevaDireccion;
        $datosActuales['Usuario'] = $nuevoUsuario;
        $datosActuales['Clave'] = $nuevaClave;
    
        // Actualizar estos datos en la base de datos
        $idUsuario = $datosActuales['IdUsuario'];
        $sqlUpdate = "UPDATE usuarios SET 
                      Nombre = '$nuevoNombre', 
                      Apellido = '$nuevoApellido', 
                      Edad = '$nuevaEdad', 
                      Telefono = '$nuevoTelefono',
                      Correo = '$nuevoCorreo', 
                      Direccion = '$nuevaDireccion', 
                      Usuario = '$nuevoUsuario',  
                      Clave = '$nuevaClave' 
                      WHERE IdUsuario = '$idUsuario'";
        
        $resultadoUpdate = $con->query($sqlUpdate);
    
        if ($resultadoUpdate) {
            // Si la actualización fue exitosa, actualizar la información en la sesión
            $_SESSION['DatosUsuarios'] = $datosActuales;
            echo '<script>alert("Usuario actualizado correctamente");</script>';
            echo '<script>window.location.href = "vista_admin.php";</script>';
        } else {
            echo '<script>alert("Error al actualizar el usuario");</script>';
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
            <h2>Buscar/Eliminar/Editar Usuarios</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" >
            <div class="regCampos">
                <input type="text" id="Correo" name="Correo" placeholder="Correo" class="productosAdmin" 
                <?php if (isset($editable)) echo 'value="' . $arreglo['Correo'] . '"'; ?> > <br>

                <input type="text" id="Nombre" name="Nombre" placeholder="Nombre " class="productosAdmin" 
                <?php if (isset($editable)) echo 'value="' . $arreglo['Nombre'] . '"'; ?> > <br>

                <input type="text" id="Apellido" name="Apellido" placeholder="Apellido " class="productosAdmin"
                <?php if (isset($editable)) echo 'value="' . $arreglo['Apellido'] . '"'; ?> > <br>

                <input type="text" id="Edad" name="Edad" placeholder="Edad" class="productosAdmin" 
                <?php if (isset($editable)) echo 'value="' . $arreglo['Edad'] . '"'; ?> > <br>

                <input type="text" id="Telefono" name="Telefono" placeholder="Telefono" class="productosAdmin" 
                <?php if (isset($editable)) echo 'value="' . $arreglo['Telefono'] . '"'; ?> > <br>

                <input type="text" id="Direccion" name="Direccion" placeholder="Direccion" class="productosAdmin" 
                <?php if (isset($editable)) echo 'value="' . $arreglo['Direccion'] . '"'; ?> > <br>

                <input type="text" id="Usuario" name="Usuario" placeholder="Usuario" class="productosAdmin" 
                <?php if (isset($editable)) echo 'value="' . $arreglo['Usuario'] . '"'; ?> > <br>

                <input type="text" id="Clave" name="Clave" placeholder="Clave" class="productosAdmin" 
                <?php if (isset($editable)) echo 'value="' . $arreglo['Clave'] . '"'; ?> > <br>
                
            </div>
            <div class="botones_contenedor">
                <button id="btnbuscar" type="submit" name="buscar">Buscar Usuario</button>
                <button id="btnEliminar" type="submit" name="eliminar">Eliminar Usuario</button>
                <button id="btnEditar" type="submit" name="editar">Editar Usuario</button>
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
        document.getElementById("Nombre").value = "<?php echo $arreglo['Nombre']; ?>";
        document.getElementById("Apellido").value = "<?php echo $arreglo['Apellido']; ?>";
        document.getElementById("Edad").value = "<?php echo $arreglo['Edad']; ?>";        
        document.getElementById("Telefono").value = "<?php echo $arreglo['Telefono']; ?>";
        document.getElementById("Correo").value = "<?php echo $arreglo['Correo']; ?>";
        document.getElementById("Direccion").value = "<?php echo $arreglo['Direccion']; ?>";        
        document.getElementById("Usuario").value = "<?php echo $arreglo['Usuario']; ?>";
        document.getElementById("Clave").value = "<?php echo $arreglo['Clave']; ?>";
    </script>
    <?php
} else {

}
?>

</html>