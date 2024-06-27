<?php
session_start();
include "cone.php"; 

if (isset($_POST['IdOrdenDetalles'])) {
    $idOrdenDetalle = $_POST['IdOrdenDetalles'];

    // Consulta para eliminar el servicio del carrito
    $sql = "DELETE FROM orden_detalles WHERE IdOrdenDetalles = ?";

    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("i", $idOrdenDetalle);
        if ($stmt->execute()) {
            // Redirigir de nuevo al carrito después de eliminar el servicio
            header("Location: carrito.php");
            exit();
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $con->error;
    }
} else {
    echo "No se recibió el IdOrdenDetalles.";
}
?>