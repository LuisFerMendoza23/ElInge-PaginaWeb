<?php

include "cone.php";

$sql3 = "
CREATE TRIGGER bitacora_usuarios;
            AFTER INSERT ON usuarios
            FOR EACH ROW 
        BEGIN
          insert into bitacora_usuarios (Id, fecha, sentencia, contraSentencia) values(
            new.id, now(), CONCAT('INSERT INTO usuarios (Id, Nombre, Apellido, Edad, Telefono, Correo, Direccion, Usuario, Clave) VALUES(
                ',NEW.ID,'           

        ";
?>