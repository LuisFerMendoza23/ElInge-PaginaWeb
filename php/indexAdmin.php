<!DOCTYPE html>
<html lang="en">

<head>
    <title>Servicios de comida "El inge"</title>
    <link rel="stylesheet" href="style_index_A.css">
    <link rel="stylesheet" href="style.css">

    <script languague="javascript">
        function mostrar() {
            div = document.getElementById('flotante');
            div.style.display = '';
        }

        function cerrar() {
            div = document.getElementById('flotante');
            div.style.display = 'none';
        }
    </script>
</head>
<header class="HeaderAContainer">
    <nav>
        <h2>Modo administrador</h2>
    </nav>
</header>

<body>
    <div class="index_a_contenedor">
        <div class="php">
            <p><a href="javascript:mostrar();">
                <?php echo "Mostrar" ?></a>
            </p>

            <div id="flotante" style="display:none;">
                <div id="close"><a href="javascript:cerrar();">cerrar</a></div>
                <div class="registro_formulario">
                    <form action=registro.php method="post">
                        <div class="regCampos">
                            <h1>Registrar usuario</h1>
                            <input class="input" type="text" id="name" name="name" placeholder="Nombre">
                            <br><br>
                            <input class="input" type="text" id="lastname" name="lastname" placeholder="Apellido">
                            <br><br>

                            <input class="input" type="text" id="age" name="age" placeholder="Edad">
                            <br><br>
                            <input class="input" type="text" id="cellphone" name="cellphone" placeholder="Telefono">
                            <br><br>
                            <input class="input" type="text" id="email" name="email" placeholder="Correo electronico">
                            <br><br>
                            <input class="input" type="text" id="direccion" name="direccion" placeholder="Direccion">
                            <br><br>
                            <input class="input" type="text" id="user" name="user" placeholder="Usuario">
                            <br><br>
                            <input class="input" type="password" id="password" name="password" placeholder="Contrasenia">
                            <br><br>
                        </div>
                        <div class="boton_contenedor">
                            <button class="boton" type="submit">Registrar</button>
                            <br><br>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="optionsContainer">
            <div class="opcServicios">
                <h2>Opcion de Servicios:</h2>
                <ul class="ListaOpcServicios">
                    <li><a href="">Añadir un Servicio</a></li>
                    <li><a href="">Buscar Servicio</a></li>
                    <li><a href="">Editar Servicio</a></li>
                    <li><a href="">Eliminar Servicio</a></li>
                </ul>
            </div>
            <div class="opcUsers">
                <h2>Opcion de Usuarios:</h2>
                <ul class="ListaOpcUsuarios">
                    <li><a href="registro.html">Añadir Usuario</a></li>
                    <li><a href="">Editar Usuario</a></li>
                    <li><a href="">Eliminar Usuraio</a></li>
                </ul>
            </div>
            <div class="opcAgenda">
                <h2>Opcion de la Agenda:</h2>
                <ul class="ListaOpcAgenda">
                    <li><a href="">Añadir Fecha</a></li>
                    <li><a href="">Eliminar Fecha </a></li>
                </ul>
            </div>
        </div>
    </div>

</body>
<footer>
    <p>Nombre: Luis Fernando Mendoza Brambila - 4P</p>
    <p>Materias: Desarrollo Web 1 y Base de Datos 1</p>
</footer>

</html>